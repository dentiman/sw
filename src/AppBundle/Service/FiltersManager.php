<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 22.10.16
 * Time: 15:00
 */

namespace AppBundle\Service;


use AppBundle\Form\Choices\FilterChoices;
use Doctrine\ORM\EntityManager;


/**
 * Class FiltersManager
 * @package AppBundle\Service
 */
class FiltersManager
{
    const FILTER_BASIC_TYPE = 1;

    const FILTER_FORMULA_TYPE = 2;

    const FILTER_QUERY_TYPE = 3;


    const OPERATOR_RANGE = 1;

    const OPERATOR_SINGLE = 2;

    const OPERATOR_MULTI = 3;

    const OPERATOR_DATE_RANGE = 4;

    const OPERATOR_IN = 5;

    const OPERATOR_NOT_IN = 6;

    const OPERATOR_CUSTOM = 7;

    const OPERATOR_PREMARKET = 8;

    const ORDER_BY = 9;

    const PAGE_ROWS = 10;

    const CURRENT_PAGE = 11;

    const KEY_LEVELS_TYPE = 12;

    /**
     * @var array
     */
    protected $columnsForQuery = ['coun','price','chp','ch','vol','e','sec','ind','avvo','atr'];


    /**
     * FiltersManager constructor.
     * @param EntityManager $em
     * @param string $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);

        $rows = $em->getRepository($class)->createQueryBuilder('f')
            ->select('f.id, f.filterType, f.operator, f.valueType, f.entity, f.formula')
            ->getQuery()
            ->getResult();

        $A = [];
        foreach ($rows as $row) {
            $A[$row['id']] = $row;
        }

        $this->filterInfo = $A;

    }


    /**
     * Array of field for form builder
     * @return array
     */
    public function getFiltersFormFields()
    {

        $qb = $this->repository->createQueryBuilder('f');

        $rows = $qb
            ->select('f.id, f.filterType, f.operator, f.choices, f.filterGroup')
            ->add('where', $qb->expr()->gt('f.operator', 0))
            ->addOrderBy('f.filterGroup', 'ASC')
            ->addOrderBy('f.order1', 'ASC')
            ->getQuery()
            ->getResult();

        $A = [];
        foreach ($rows as $row) {
            $A[$row['filterGroup']][] = $row;
        }

        return $A;
    }


    public function getFiltersById()
    {

        $builder = $this->repository->createQueryBuilder('f');

        $rows = $builder
            ->select('f.id, f.filterType, f.operator, f.valueType, f.entity')
//            ->where('f.filterType = :filter_type')
//            ->setParameter('filter_type', 0)
            ->getQuery()
            ->getResult();

        $A = [];
        foreach ($rows as $row) {
            $A[$row['id']] = $row;

        }

        return $A;
    }


    /**
     * Array of field for columns settings form
     * @return array
     */
    public function getColumnsFormFields()
    {

        $builder = $this->repository->createQueryBuilder('f');

        return $builder
            ->where('f.filterType = :filter_type')
            ->setParameter('filter_type', 0)
            ->getQuery()
            ->getResult();

    }




    public function getColumnsArray()
    {
        $builder = $this->repository->createQueryBuilder('f');

        return $builder
            ->where('f.filterType = :filter_type')
            ->setParameter('filter_type', 0)
            ->getQuery()
            ->getResult();

    }

    public function getScreenQuery($formData = null, array $tickers = [])
    {

        $qb = $this->em->createQueryBuilder()->select('l.ticker');

        foreach ($this->columnsForQuery as $column) {
            $qb->addSelect($this->field($column));
        }


        $qb->from('AppBundle:Feed\MainLevel1', 'l')
            ->leftJoin('AppBundle:Feed\MainBasicData', 'b', 'WITH', 'l.ticker=b.ticker')
            ->leftJoin('AppBundle:Feed\MainWeek', 'w', 'WITH', 'l.ticker=w.ticker')
            ->leftJoin('AppBundle:Feed\MainEarnings', 'e', 'WITH', 'l.ticker=e.ticker')
            ->leftJoin('AppBundle:Feed\MainMinutePrev', 'm', 'WITH', 'l.ticker=m.ticker')
            ->leftJoin('AppBundle:Feed\MainPremarket', 'p', 'WITH', 'l.ticker=p.ticker');



        // set defaults -------------------
        $qb->orderBy('l.chp', 'DESC');

        //-------set WHERE -----------------------------------
        if($formData !== null) {
            foreach ($formData as $filterID => $value) {

            //Range----
            switch ($this->filterInfo[$filterID]['operator']) {

                case self::OPERATOR_RANGE:


                    if ($value['min'] != null && $value['max'] == null) {

                        $qb->andWhere($qb->expr()->gte($this->field($filterID), ':' . $filterID))
                            ->setParameter($filterID, $value['min']);
                    } elseif ($value['min'] == null && $value['max'] != null) {

                        $qb->andWhere($qb->expr()->lte($this->field($filterID), ':' . $filterID))
                            ->setParameter($filterID, $value['max']);
                    } elseif ($value['min'] != null && $value['max'] != null) {

                        $qb->andWhere($qb->expr()->between($this->field($filterID), ':' . $filterID . 'min',
                            ':' . $filterID . 'max'))
                            ->setParameter($filterID . 'min', $value['min'])
                            ->setParameter($filterID . 'max', $value['max']);
                    }

                    break;


                case self::OPERATOR_SINGLE:

                    if ($value != null) {
                        $value = explode('|', $value);

                        if (count($value) > 1) {

                            if ($value[0] == 'l') {

                                $qb->andWhere($qb->expr()->lte($this->field($filterID), ':' . $filterID))
                                    ->setParameter($filterID, $value[1] * 1);
                            } elseif ($value[0] == 'm') {
                                $qb->andWhere($qb->expr()->gte($this->field($filterID), ':' . $filterID))
                                    ->setParameter($filterID, $value[1] * 1);
                            }

                        } else {
                            $qb->andWhere($qb->expr()->eq($this->field($filterID), ':' . $filterID))
                                ->setParameter($filterID, $value[0]);
                        }

                    }
                    break;

                case self::OPERATOR_MULTI:

                    if ($value != null && count($value) > 0) {

                        $qb->andWhere($qb->expr()->in($this->field($filterID), ':' . $filterID))
                            ->setParameter($filterID, $value);
                    }
                    break;

                case self::OPERATOR_DATE_RANGE:
                    break;


                case self::OPERATOR_IN:

                    if ($value != null) {

                        $value = array_diff(explode(' ', str_replace(',', ' ', $value)), array(''));

                        $qb->andWhere($qb->expr()->in($this->field($filterID), ':' . $filterID))
                            ->setParameter($filterID, $value);

                    }
                    break;

                case self::OPERATOR_NOT_IN:

                    if ($value != null) {

                        $value = array_diff(explode(' ', str_replace(',', ' ', $value)), array(''));

                        $qb->andWhere($qb->expr()->notIn($this->field($filterID), ':' . $filterID))
                            ->setParameter($filterID, $value);

                    }
                    break;

                case self::OPERATOR_CUSTOM:

                    if ($value != null) {

                        if($filterID == 'earnf') {

                            if($value == 1) {
                                $qb->andWhere($qb->expr()->eq($this->field('earn'),':earnToday'))
                                   ->setParameter(':earnToday', new \DateTime(date('Y-m-d')));
                            } elseif ($value == 2) {
                                $qb->andWhere($qb->expr()->orX(
                                    $qb->expr()->andX($qb->expr()->eq($this->field('earn'),':earnToday'),"e.earnTime = 'bmo'"),
                                    $qb->expr()->andX($qb->expr()->eq($this->field('earn'),':earnYesterday'),"e.earnTime = 'amc'")
                                ))->setParameter(':earnToday', new \DateTime(date('Y-m-d')))
                                  ->setParameter(':earnYesterday', new \DateTime(date('Y-m-d', time() - 60 * 60 * 24)));
                            } elseif ($value == 3) {
                                $qb->andWhere($qb->expr()->eq($this->field('earn'),':earnYesterday'))
                                    ->setParameter(':earnYesterday', new \DateTime(date('Y-m-d', time() - 60 * 60 * 24)));
                            } elseif ($value == 4) {
                                $qb->andWhere($qb->expr()->eq($this->field('earn'),':earnTomorrow'))
                                    ->setParameter(':earnTomorrow', new \DateTime(date('Y-m-d', time() + 60 * 60 * 24)));
                            }

                        } else {
                            $qb->andWhere(FilterChoices::OPERATOR_CUSTOM_VALUES[$filterID][$value]);
                        }
                    }
                    break;

                case self::OPERATOR_PREMARKET:

                    //premarket on
                    break;

                case self::ORDER_BY:

                    if ($value['order'] != null) {

                        if($this->isFormulaType($value['order'])) {

                            $qb->addSelect($this->filterInfo[$value['order']]['formula'].' AS '.$value['order']);

                        } else {
                            $value['order'] = $this->field($value['order']);
                        }


                        if($value['asc'] != null) {
                            $qb->orderBy($value['order'], 'ASC');
                        } else {
                            $qb->orderBy($value['order'], 'DESC');
                        }

                    } elseif ($value['asc'] != null) {
                        $qb->orderBy('l.chp', 'ASC');
                    }

                    break;

                case self::CURRENT_PAGE:

                    if ($value != null) {

                        $qb->setFirstResult(0);

                    }
                    break;

                case self::PAGE_ROWS:

//                    if ($value != null) {
//                        $qb->setMaxResults($value);
//                    }
                    break;

                case self::KEY_LEVELS_TYPE:
                    // Добавляем филтр по ценовым уровням
                    if ($value != null && count($value) > 0) {

                        if (!isset($formData['keyrange']) || $formData['keyrange'] == null) {
                            $formData['keyrange'] = '0,0';
                        }

                        $formData['keyrange'] = explode(',',$formData['keyrange']);

                        if (!isset($formData['keyfilter']) || $formData['keyfilter'] == null) {
                            $formData['keyfilter'] = 'price';
                        }

                        $keylev = array(

                            1 => $qb->expr()->orX(
                                'mod('.$this->field($formData['keyfilter']).',1)<='.($formData['keyrange'][1]*0.01),
                                'mod('.$this->field($formData['keyfilter']).',1)>='.(1-$formData['keyrange'][0]*0.01)
                                ),
                            2=>  $qb->expr()->between(
                                'mod('.$this->field($formData['keyfilter']).',1)',
                                (0.50-$formData['keyrange'][0]*0.01),
                                (0.50+$formData['keyrange'][1]*0.01)
                            ),
                            3=>  $qb->expr()->between(
                                'mod('.$this->field($formData['keyfilter']).',1)',
                                (0.25-$formData['keyrange'][0]*0.01),
                                (0.25+$formData['keyrange'][1]*0.01)
                            ),
                            4 => $qb->expr()->orX(
                                'mod('.$this->field($formData['keyfilter']).',0.1)<='.($formData['keyrange'][1]*0.01),
                                'mod('.$this->field($formData['keyfilter']).',0.1)>='.(0.1-$formData['keyrange'][0]*0.01)
                            ),
                            5=>  $qb->expr()->between(
                                'mod('.$this->field($formData['keyfilter']).',0.1)',
                                (0.05-$formData['keyrange'][0]*0.01),
                                (0.05+$formData['keyrange'][1]*0.01)
                            ),

                        );

                        $orX = $qb->expr()->orX();
                        foreach ($value as $keylev_val) {
                             $orX->add($keylev[$keylev_val]);
                        }

                        $qb->andWhere($orX);
                    }

                    break;

            }
        }
        }

        if(count($tickers)) {
            $qb->andWhere($qb->expr()->in($this->field('ticker'), ':ticker'))
                ->setParameter('ticker', $tickers);
        }

        return $qb;
    }


    /**
     * @param array $columnsForQuery
     */
    public function addColumnsForQuery($columnsForQuery)
    {
        $this->columnsForQuery = array_merge($this->columnsForQuery,$columnsForQuery);
    }

    private function isFormulaType($id)
    {
        if ($this->filterInfo[$id]['formula'] != '0') {
            return true;
        } else {
            return false;
        }
    }


    private function field($id)
    {

        if ($this->isFormulaType($id)) {
            return $this->filterInfo[$id]['formula'];
        }

        return $this->filterInfo[$id]['entity'] . '.' . $id;
    }





}