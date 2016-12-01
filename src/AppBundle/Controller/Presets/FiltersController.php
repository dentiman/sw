<?php

namespace AppBundle\Controller\Presets;

use AppBundle\Entity\Presets\Filters;
use AppBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class FiltersController extends Controller
{


    /**
     * @Route("/presets/filters/edit/{id}",requirements={"id": "\d+"}, name="presets_filters_edit")
     * @Route("/presets/filters/new", name="presets_filters_new")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function EditAction(Request $request, Filters $filters=null)
    {
        $user = $this->getUser();

        if ($filters != null && !$filters->isAuthor($user)) {

            throw $this->createAccessDeniedException('Filters can only be edited by their authors.');
        }

        if( !$filters ) { //set default filters object
                $filters = new Filters();
        }


        $form = $this->createForm(
            FiltersLayoutsType::class,
            $filters,
            ['filter_manager' => $this->container->get('app.service.filters_manager')]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(!$user->isPremium()) {

                return $this->redirectToRoute('premium');
            }

            $filters->setUserId($user->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($filters);
            $em->flush();

            $this->addFlash('success', 'post.updated_successfully');

            return $this->redirectToRoute('presets_filters');
        }
        return $this->render('presets/filters/edit.html.twig',[
            'form'=>$form->createView()
            ]);
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

                $this->addFlash('success', 'post.deleted_successfully');
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
            'show_confirmation' => true
        ]);
    }

    /**
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('presets_filters_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->getForm();
    }


    /**
     * @Route("/presets/filters/setlayout", name="presets_set_chart_id")
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
