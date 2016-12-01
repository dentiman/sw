<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Presets\Filters;
use AppBundle\Entity\User;
use AppBundle\Form\ChartsLayoutsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ScreenerFiltersType;


class ScreenerController extends Controller
{
    /**
     * @Route("/screener", name="screener")
     */
    public function indexAction()
    {
        $filter_save_form = $this->createFormBuilder()
            ->add('name', TextType::class,array('label' => 'Filter name','horizontal_label_class'=>'col-sm-10',))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $filters = new Filters();

        $form = $this->createForm(
            ScreenerFiltersType::class,
            null,
            ['filter_manager' => $this->container->get('app.service.filters_manager')]
        );

        return $this->render('screener/screener.html.twig', array(
            'form' => $form->createView(),
            'filter_save_form' => $filter_save_form->createView()

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

            $result = $researcher->getAllResult($form->getData()->getFilters());

            return $this->render('screener/result_ticker.html.twig', array(
                'result' => $result
            ));

        } else {

            $result = $researcher->setDisplayView($screenerLayout)
                ->getPaginationResult($form->getData()->getFilters(), $request->query->getInt('page', 1));

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
