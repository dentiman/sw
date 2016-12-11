<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Presets\Filters;
use AppBundle\Entity\User;
use AppBundle\Form\ChartsLayoutsType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ScreenerFiltersType;


class ScreenerController extends Controller
{
    /**
     * @Route("/screener", name="screener")
     * @Route("/screener/{slug}", name="screener_id")
     */
    public function indexAction(Request $request, Filters $filters = null)
    {
        $user = $this->getUser();
        $filters_presets = false;
        $filters_edit_form =false;
        $filters_save_form=false;


        $em = $this->getDoctrine();

        //create forms for logined users:
        if($user instanceof User) {

            $filters_presets = $em->getRepository('AppBundle:Presets\Filters')
                ->createQueryBuilder('f')
                ->where('f.userId = :user')
                ->setParameter('user', $user->getId())
                ->orderBy('f.createdAt', 'DESC');


            $filters_edit_form = $this->get('form.factory')
                ->createNamedBuilder('current_filter', FormType::class, [])
                ->add('name', EntityType::class, array(
                    'class' => 'AppBundle\Entity\Presets\Filters',
                    'query_builder' => $filters_presets,
                    'choice_value' => 'slug',
                    'data'=>$filters,
                    'required'    => false,
                    'placeholder' => 'Presets:',
                ))
                ->add('save', SubmitType::class, array('label' => 'Save'))
                ->getForm()
                ->createView();


            $filters_save_form = $this->get('form.factory')
                ->createNamedBuilder('new_filter', FormType::class, [])
                ->add('name', TextType::class,array('label' => 'Save as:','horizontal_label_class'=>'col-sm-10',))
                ->add('save', SubmitType::class, array('label' => 'Save'))
                ->getForm()
                ->createView();


        }


        $form = $this->createForm(
            ScreenerFiltersType::class,
            $filters,
            ['filter_manager' => $this->container->get('app.service.filters_manager')]
        );

        return $this->render('screener/screener.html.twig', array(
            'form' => $form->createView(),
            'filters_save_form' => $filters_save_form,
            'filters_edit_form' =>$filters_edit_form

        ));


    }

    /**
     * @Route("/screener/form", name="screener_form_default")
     * @Route("/screener/form/{slug}", name="screener_form")
     */
    public function filtersFormAction(Request $request, Filters $filters = null)
    {

        $form = $this->createForm(
            ScreenerFiltersType::class,
            $filters,
            ['filter_manager' => $this->container->get('app.service.filters_manager')]
        );

        return $this->render('screener/screener_form.html.twig', array(
            'form' => $form->createView(),
        ));

    }


    /**
     * @Route("/search", name="search")
     */
    public function quotesAction(Request $request)
    {
        $filterManager = $this->container->get('app.service.filters_manager');
        $researcher = $this->container->get('app.service.researcher');


        $screenerLayout = $request->cookies->get('chview');


        $form = $this->createForm(
            ScreenerFiltersType::class,
            null,
            ['filter_manager' => $filterManager]
        );
        $form->handleRequest($request);



        if ($screenerLayout == 'ticker') {

            $result = $researcher->getAllResult($form->getData()->getFiltersData());

            return $this->render('screener/result_ticker.html.twig', array(
                'result' => $result
            ));

        } else {

            $result = $researcher->setDisplayView($screenerLayout)
                ->getPaginationResult($form->getData()->getFiltersData(), $request->query->getInt('page', 1));

            if ($screenerLayout == 'table') {

                return $this->render('screener/result_table.html.twig', array(
                    'pagination' => $result,
                ));

            } else {

                return $this->render('screener/result_charts.html.twig', array(
                    'pagination' => $result,
                    'charts' => $researcher->getChartsPresets(),
                    'test' => []

                ));

            }
        }
    }


}
