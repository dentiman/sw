<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filters
 *
 * @ORM\Table(name="filters")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FiltersRepository")
 */
class Filters
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255, unique=true)
     * @ORM\Id
     */
    private $id;


    /**
     * @var int
     *
     * @ORM\Column(name="filter_group", type="integer")
     */
    private $filterGroup;

    /**
     * @var int
     *
     * @ORM\Column(name="filter_type", type="integer")
     */
    private $filterType;

    /**
     * @var string
     *
     * @ORM\Column(name="formula", type="string", length=255)
     */
    private $formula;

    /**
     * @var int
     *
     * @ORM\Column(name="operator", type="integer")
     */
    private $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="value_type", type="string", length=255, nullable=false)
     */
    private $valueType;

    /**
     * @var int
     *
     * @ORM\Column(name="order1", type="integer")
     */
    private $order1;


    /**
     * @var string
     *
     * @ORM\Column(name="choices", type="string", length=255, nullable=false)
     */
    private $choices;



    /**
     * @var string
     *
     * @ORM\Column(name="entity", type="string", length=255, nullable=false)
     */
    private $entity;



    /**
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param string $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }



    /**
     * @return string
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param string $choices
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;
    }


    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Filters
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Set filterGroup
     *
     * @param integer $filterGroup
     *
     * @return Filters
     */
    public function setFilterGroup($filterGroup)
    {
        $this->filterGroup = $filterGroup;

        return $this;
    }

    /**
     * Get filterGroup
     *
     * @return int
     */
    public function getFilterGroup()
    {
        return $this->filterGroup;
    }

    /**
     * Set filterType
     *
     * @param integer $filterType
     *
     * @return Filters
     */
    public function setFilterType($filterType)
    {
        $this->filterType = $filterType;

        return $this;
    }

    /**
     * Get filterType
     *
     * @return int
     */
    public function getFilterType()
    {
        return $this->filterType;
    }

    /**
     * Set formula
     *
     * @param string $formula
     *
     * @return Filters
     */
    public function setFormula($formula)
    {
        $this->formula = $formula;

        return $this;
    }

    /**
     * Get formula
     *
     * @return string
     */
    public function getFormula()
    {
        return $this->formula;
    }

    /**
     * Set operator
     *
     * @param integer $operator
     *
     * @return Filters
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return int
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set valueType
     *
     * @param string $valueType
     *
     * @return Filters
     */
    public function setValueType($valueType)
    {
        $this->valueType = $valueType;

        return $this;
    }

    /**
     * Get valueType
     *
     * @return string
     */
    public function getValueType()
    {
        return $this->valueType;
    }

    /**
     * Set order1
     *
     * @param integer $order1
     *
     * @return Filters
     */
    public function setOrder1($order1)
    {
        $this->order1 = $order1;

        return $this;
    }

    /**
     * Get order1
     *
     * @return int
     */
    public function getOrder1()
    {
        return $this->order1;
    }
}

