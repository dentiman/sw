<?php

namespace AppBundle\Controller\Presets;

use AppBundle\Entity\Presets\Charts;
use AppBundle\Entity\User;
use AppBundle\Form\ChartsLayoutsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ChartsController extends Controller
{
    /**
     * @Route("/presets/charts", name="presets_charts")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function indexAction(Request $request)
    {
        $em  = $this->get('doctrine.orm.entity_manager');
        $qb = $em->getRepository('AppBundle:Presets\Charts')
        ->createQueryBuilder('c')
        ->select('c.id, c.name')
            ->where('c.userId = :user')
            ->setParameter('user', $this->getUser()->getId())
            ->orderBy('c.createdAt', 'DESC');

        $query = $qb; //for pagination

        if (count($qb->getQuery()->getScalarResult())==0) {
            return $this->redirectToRoute('presets_charts_new');
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('presets/charts/index.html.twig',['pagination' => $pagination]);
    }

    /**
     * @Route("/presets/charts/edit/{id}",requirements={"id": "\d+"}, name="presets_charts_edit")
     * @Route("/presets/charts/new", name="presets_charts_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function EditAction(Request $request, Charts $charts=null)
    {
        $user = $this->getUser();

        if ($charts != null && !$charts->isAuthor($user)) {

            throw $this->createAccessDeniedException('Layout can only be edited by their authors.');
        }


        if( !$charts ) { //set default charts object
            $em = $this->getDoctrine()->getManager();
            if($defaultCharts = $em->getRepository(Charts::class)->find(1)){
                $charts = clone $defaultCharts;
            } else {
                $charts = new Charts();
            }
        }


        $form = $this->createForm(
            ChartsLayoutsType::class,
            $charts,
            ['filter_manager' => $this->container->get('app.service.filters_manager')]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(!$user->isPremium()) {

                return $this->redirectToRoute('premium');
            }

            $charts->setUserId($user->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($charts);
            $em->flush();

            $this->addFlash('success', 'post.updated_successfully');

            return $this->redirectToRoute('presets_charts');
        }

        return $this->render('presets/charts/edit.html.twig',[
            'form'=>$form->createView()
            ]);
    }


    /**
     * @Route("/presets/charts/delete/{id}",requirements={"id": "\d+"}, name="presets_charts_delete")
     * @Method("DELETE")
     * @Security("charts.isAuthor(user)")
     */
    public function deleteAction(Request $request,  Charts $charts)
    {
        $form = $this->createDeleteForm($charts->getId());
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($charts);
                $entityManager->flush();

                $this->addFlash('success', 'post.deleted_successfully');
            }

        return $this->redirectToRoute('presets_charts');
    }


    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function _deleteFormAction($id) {
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('presets/_form.html.twig',[
            'form'=>$deleteForm->createView(),
            'button_label' => 'delete',
            'button_css' => 'btn btn-xs btn-danger',
            'show_confirmation' => true
        ]);
    }

    /**
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null,array('attr' => array('data-confirmation' => '1')))
            ->setAction($this->generateUrl('presets_charts_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->getForm();
    }


    /**
     * @Route("/presets/charts/setlayout", name="presets_set_chart_id")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function setChartLayout(Request $request) {

        if($layout = $request->query->getInt('chview', false)) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            if($user instanceof User) {
                $user->setChartsId($layout);
                $em->persist($user);
                $em->flush();
            }
        }

        return new JsonResponse(['status' => 'ok']);
    }

}
