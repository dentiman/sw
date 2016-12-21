<?php

namespace AppBundle\Entity\Presets;

use Doctrine\ORM\Mapping as ORM;



/**
 * Charts
 *
 * @ORM\Table(name="presets_charts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Presets\ChartsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Charts
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="tf1", type="string", length=255)
     */
    private $tf1;

    /**
     * @var string
     *
     * @ORM\Column(name="tf2", type="string", length=255)
     */
    private $tf2;

    /**
     * @var string
     *
     * @ORM\Column(name="tf3", type="string", length=255)
     */
    private $tf3;

    /**
     * @var array
     *
     * @ORM\Column(name="chart1", type="array")
     */
    private $chart1;

    /**
     * @var array
     *
     * @ORM\Column(name="chart2", type="array")
     */
    private $chart2;

    /**
     * @var array
     *
     * @ORM\Column(name="chart3", type="array")
     */
    private $chart3;

    /**
     * @var array
     *
     * @ORM\Column(name="display_columns", type="array")
     */
    private $displayColumns;



    /**
     * @return array
     */
    public function getDisplayColumns()
    {

        return $this->displayColumns;
    }

    /**
     * @param array $displayColumns
     * @return Charts
     */
    public function setDisplayColumns($displayColumns)
    {
        $this->displayColumns = $displayColumns;

        return $this;
    }



    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Charts
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUser()
    {
        return $this->userId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Charts
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set tf1
     *
     * @param string $tf1
     *
     * @return Charts
     */
    public function setTf1($tf1)
    {
        $this->tf1 = $tf1;

        return $this;
    }

    /**
     * Get tf1
     *
     * @return string
     */
    public function getTf1()
    {
        return $this->tf1;
    }

    /**
     * Set tf2
     *
     * @param string $tf2
     *
     * @return Charts
     */
    public function setTf2($tf2)
    {
        $this->tf2 = $tf2;

        return $this;
    }

    /**
     * Get tf2
     *
     * @return string
     */
    public function getTf2()
    {
        return $this->tf2;
    }

    /**
     * Set tf3
     *
     * @param string $tf3
     *
     * @return Charts
     */
    public function setTf3($tf3)
    {
        $this->tf3 = $tf3;

        return $this;
    }

    /**
     * Get tf3
     *
     * @return string
     */
    public function getTf3()
    {
        return $this->tf3;
    }

    /**
     * Set chart1
     *
     * @param array $chart1
     *
     * @return Charts
     */
    public function setChart1($chart1)
    {
        $this->chart1 = $chart1;

        return $this;
    }

    /**
     * Get chart1
     *
     * @return array
     */
    public function getChart1()
    {
        return $this->chart1;
    }

    /**
     * Set chart2
     *
     * @param array $chart2
     *
     * @return Charts
     */
    public function setChart2($chart2)
    {
        $this->chart2 = $chart2;

        return $this;
    }

    /**
     * Get chart2
     *
     * @return array
     */
    public function getChart2()
    {
        return $this->chart2;
    }

    /**
     * Set chart3
     *
     * @param array $chart3
     *
     * @return Charts
     */
    public function setChart3($chart3)
    {
        $this->chart3 = $chart3;

        return $this;
    }

    /**
     * Get chart3
     *
     * @return array
     */
    public function getChart3()
    {
        return $this->chart3;
    }

    /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime("now");
    }

    public function __clone()
    {
        if ($this->id) {
            $this->id = null;
            $this->name = '';
        }
    }

    /**
     * @param array
     * @return string
     */
    private function chartSerialize($chart){

        $A= [];
        foreach ($chart as $key => $value) {

            if( is_array($value)) {
                if(isset($value['check']) && isset($value['color']) && $value['check'] !=false){
                    $A[] = $key.'=1';
                    if($value['color'] != null) {
                        $A[] = $key . '_color=' . $value['color'];
                    }

                } elseif(isset($value['choice']) && isset($value['color']) && $value['choice'] !=null){
                    $A[] = $key.'=1';
                    if($value['color'] != null) {
                        $A[] = $key.'_color='.$value['color'];
                    }
                }

            } elseif ($value != null && $value != false) {
                $A[] = $key.'='.$value;
            }
        }

        return implode('&',$A);
    }


    /**
     * @return array
     */
    public function getSerializeData()
    {
        $A = ['name'=>$this->name,'columns'=>[]];

        if($this->tf1 !='') {
            $A['charts'][] = [
                'tf'=>$this->tf1,
                'src'=>http_build_query($this->chart1)
            ];
        }

        if($this->tf2 !='') {
            $A['charts'][] = [
                'tf'=>$this->tf2,
                'src'=>$this->chartSerialize($this->chart2)
            ];
        }

        if($this->tf3 !='') {
            $A['charts'][] = [
                'tf'=>$this->tf3,
                'src'=>$this->chartSerialize($this->chart3)
            ];
        }

        foreach ($this->displayColumns as $name => $value) {
            if($value === true) {
                $A['columns'][] = $name;
            }
        }
        return $A;
    }

    public function isAuthor($user){

        return $this->userId === $user->getId();

    }

    public function isNewRecord(){

        if($this->id == null) {
            return true;
        }

        return false;
    }

}

