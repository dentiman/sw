<?php

namespace AppBundle\Controller\Presets;

use AppBundle\Entity\Presets\Columns;
use AppBundle\Entity\User;

use AppBundle\Form\ColumnsLayoutsType;
use AppBundle\Form\FiltersCheckboxesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ColumnsController extends Controller
{

    /**
     * @Route("/presets/columns", name="presets_columns")
     * @Route("/presets/columns/edit/{id}", name="presets_columns_edit")
     * @Route("/presets/columns/new", name="presets_columns_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function indexAction(Request $request,Columns $columns=null)
    {

        $user = $this->getUser();
        $em  = $this->get('doctrine.orm.entity_manager');
        $qb = $em->getRepository('AppBundle:Presets\Columns')
            ->createQueryBuilder('f')
            ->select('f.id, f.name')
            ->where('f.userId = :user')
            ->setParameter('user', $this->getUser()->getId())
            ->orderBy('f.createdAt', 'DESC');


        $route = $request->get('_route');

        if($route == 'presets_columns_new') {
            $columns = new Columns();
        } elseif (!$columns) {
            if (!$columns = $em->getRepository('AppBundle:Presets\Columns')->find($user->getColumnsId())) {
                $columns = new Columns();
            }
        }



        $form = $this->createFormBuilder($columns,['attr'=>['ajax-container'=>'columns-form-container']])
            ->setAction($this->generateUrl('presets_columns'))
            ->add('name', TextType::class)
            ->add('data', FiltersCheckboxesType::class,['filter_manager' => $this->container->get('app.service.filters_manager')])
          //  ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $columns->setUserId($user->getId());
            $em->persist($columns);
            $em->flush();

        }

        $save_as_form = $this->get('form.factory')
            ->createNamedBuilder('save_columns', FormType::class, [])
            ->add('name', TextType::class,array('label' => 'Save as:','horizontal_label_class'=>'col-sm-10',))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm()
            ->createView();

        $query = $qb; //for pagination


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render(
            'presets/columns/index.html.twig',
            [
                'pagination' => $pagination,
                'form' => $form->createView(),
                'save_as_form' => $save_as_form,
            ]
        );
    }



    /**
     * @Route("/presets/columns/delete/{id}",requirements={"id": "\d+"}, name="presets_columns_delete")
     * @Method("DELETE")
     * @Security("columns.isAuthor(user)")
     */
    public function deleteAction(Request $request,  Columns $columns)
    {
        $form = $this->createDeleteForm($columns->getId());
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($columns);
                $entityManager->flush();


            }

        return $this->redirectToRoute('presets_columns');
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
            ->setAction($this->generateUrl('presets_columns_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->getForm();
    }


    /**
     * @Route("/presets/columns/setlayout", name="presets_set_columns_id")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function setChartLayout(Request $request) {

        if($layout = $request->query->getInt('chview', false)) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            if($user instanceof User) {
                $user->setColumnsId($layout);
                $em->persist($user);
                $em->flush();
            }
        }

        return new JsonResponse(['status' => 'ok']);
    }

}
