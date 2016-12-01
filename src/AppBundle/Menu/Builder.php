<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'homepage'));

        $menu->addChild('screener', array('route' => 'screener'));

        $menu->addChild('presets', array('route' => 'presets_charts'));


        return $menu;
    }


    public function NavbarsMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'subnavbar' => true,
        ));

        $menu->addChild("table", array('uri' => "javascript:screener.setLayout('table')",'label'=>false, 'icon' => 'list-ul'));
        $menu->addChild('tickers', array('uri' => "javascript:screener.setLayout('ticker')",'label'=>false,'icon' => 'th'));
        $menu->addChild('chartl', array('uri' => "javascript:screener.setLayout('charts')",'label'=>false,'icon' => 'bar-chart-o'));

        $em = $this->container->get('doctrine')->getManager();

        if (null !== $token = $this->container->get('security.token_storage')->getToken()) {

            if (is_object($user = $token->getUser())) {

                if($user->isPremium()) {

                    $dropdown = $menu->addChild('user', array('uri' => '#template','label'=>false,'icon' => 'user', 'dropdown' => true,
                        'caret' => true));

                    $charts = $em->getRepository('AppBundle:Presets\Charts')->findBy(['userId'=>$user->getId()]);

                    foreach ($charts as $chart) {
                        $dropdown->addChild($chart->getName(), array('uri' => "javascript:screener.setLayout('".$chart->getId()."')"));
                    }
                }
            }
        }

        return $menu;
    }


    public function presetsMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Charts', array('route' => 'presets_charts'));
        return $menu;
    }



}
