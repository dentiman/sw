<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 17.11.16
 * Time: 8:42
 */

namespace AppBundle\Service;



use AppBundle\Entity\Presets\Charts;

use AppBundle\Entity\Presets\Columns;
use FOS\UserBundle\Model\User;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Researcher
{

    /**
     * @var FiltersManager
     */
    protected $fm;

    /**
     * @var string
     */
    protected $displayView;

    /**
     * @var array
     */
    protected $chartsPresets = false;


    public function __construct(FiltersManager $filtersManager,$pagination,TokenStorageInterface $tokenStorage)
    {
        $this->fm = $filtersManager;

        $this->pagination = $pagination;

        $this->user =  $tokenStorage->getToken()->getUser();

        $this->displayView = 'charts';
    }


    public function getPaginationResult( $formData ,$page)
    {
        //set num of rows
        if(isset($formData['row']) && $formData['row'] != null) {
            $limit = $formData['row'];
        } else {
            $limit = 50;
        }

        // set order field
        if(isset($formData['order']['order']) && $formData['order']['order'] != null) {
            $sortFieldParameterName = $formData['order']['order'];
        } else {
            $sortFieldParameterName = 'chp';
        }

        // set order diraction
        if(isset($formData['order']['asc']) && $formData['order']['asc'] != null) {
            $sortDirectionParameterName = $formData['order']['asc'];
        } else {
            $sortDirectionParameterName = '';
        }

        $query = $this->fm->getScreenQuery($formData);

        return  $this->pagination->paginate(
            $query,
            $page,
            $limit,
            array('sortFieldParameterName'=>$sortFieldParameterName,'sortDirectionParameterName' =>$sortDirectionParameterName)
        );

    }

    public function getAllResult( $formData)
    {
        return  $this->fm->getScreenQuery($formData)->getQuery()->getResult();
    }



    /**
     * @param string $displayView ('table' or 'charts')
     * @return Researcher
     */
    public function setDisplayView($displayView)
    {
        $this->displayView = $displayView;

            if($displayView == 'table') {

                $this->fm->addColumnsForQuery(['atr','price','chp','ch','vol','e','sec','mc']) ;

            } else {

                $this->setChartsPresets();
                $this->fm->addColumnsForQuery($this->chartsPresets['columns']);
            }

        return $this;
    }


    /** for twig render
     * @return array
     */
    public function getChartsPresets() {

        if($this->chartsPresets == false) {
            $this->setChartsPresets();
        }
        return $this->chartsPresets;
    }


    private function setChartsPresets() {

        if($this->isUserPremium()){

            if(!$Charts = $this->fm->em->getRepository(Charts::class)->find($this->user->getChartsId())) {
                $Charts = $this->fm->em->getRepository(Charts::class)->find(1);
            }
        } else {
            $Charts = $this->fm->em->getRepository(Charts::class)->find(1);
        }

        if(!$Charts) {
            throw new \Exception('Default chart not found!');
        }

        $this->chartsPresets = $Charts->getSerializeData();
    }


    private function isUserPremium(){

        if($this->user instanceof User) {
          return  $this->user->isPremium();
        }
        return false;
    }

}