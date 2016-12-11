<?php

namespace AppBundle\Controller\Presets;

use AppBundle\Entity\Presets\Filters;
use AppBundle\Entity\User;

use AppBundle\Form\ScreenerFiltersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class FiltersController extends Controller
{

    /**
     * @Route("/presets/filters", name="presets_filters")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function indexAction(Request $request)
    {
        $em  = $this->get('doctrine.orm.entity_manager');
        $qb = $em->getRepository('AppBundle:Presets\Filters')
            ->createQueryBuilder('f')
            ->select('f.id, f.name')
            ->where('f.userId = :user')
            ->setParameter('user', $this->getUser()->getId())
            ->orderBy('f.createdAt', 'DESC');

        $query = $qb; //for pagination


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('presets/filters/index.html.twig',['pagination' => $pagination]);
    }


    /**
     * @Route("/presets/filters/edit/{slug}", name="presets_filters_edit")
     * @Route("/presets/filters/new", name="presets_filters_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function EditAction(Request $request, Filters $filters = null)
    {
        $user = $this->getUser();

        if ($filters != null && !$filters->isAuthor($user)) {

            throw $this->createAccessDeniedException('Filters can only be edited by their authors.');
        }

        if( !$filters ) { //set default filters object
                $filters = new Filters();
        }


        $form = $this->createForm(
            ScreenerFiltersType::class,
            $filters,
            ['filter_manager' => $this->container->get('app.service.filters_manager')]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(!$user->isPremium()) {
                return new JsonResponse(['alert'=>['message'=>'Filters can only be edited in Premium account','type'=>'warning']]);
            }

            $em = $this->getDoctrine()->getManager();


            $filters->setUserId($user->getId());


            $em->persist($filters);
            $em->flush();

            return new JsonResponse(['slug'=>$filters->getSlug(),'name'=> $filters->getName(),
                'alert'=>['message'=>'Filter "'.$filters->getName().'" has been successfully saved.','type'=>'success']]);

        } else {
            return new JsonResponse( ['alert'=>['message'=>'Error!!!','type'=>'danger']]);
        }

    }


    /**
     * @Route("/presets/filters/delete/{id}",requirements={"id": "\d+"}, name="presets_filters_delete")
     * @Method("DELETE")
     * @Security("filters.isAuthor(user)")
     */
    public function deleteAction(Request $request,  Filters $filters)
    {
        $form = $this->createDeleteForm($filters->getId());
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($filters);
                $entityManager->flush();


            }

        return $this->redirectToRoute('presets_filters');
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
            'show_confirmation' => false,
            'ajax_container' => '#modal-content'
        ]);
    }

    /**
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null,array('attr' => array('ajax-container' => '#modal-content')))
            ->setAction($this->generateUrl('presets_filters_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->getForm();
    }


    /**
     * @Route("/presets/filters/setlayout", name="presets_set_filters_id")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function setChartLayout(Request $request) {

        if($layout = $request->query->getInt('chview', false)) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            if($user instanceof User) {
                $user->setFiltersId($layout);
                $em->persist($user);
                $em->flush();
            }
        }

        return new JsonResponse(['status' => 'ok']);
    }

}
