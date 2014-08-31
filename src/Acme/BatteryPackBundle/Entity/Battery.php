<?php

namespace Acme\BatteryPackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Battery
 * @ORM\Entity(repositoryClass="Acme\BatteryPackBundle\Entity\BatteryRepository")
 */
class Battery
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $count;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Battery
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
     * Set type
     *
     * @param string $type
     * @return Battery
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param integer $count
     * @return Battery
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }
}
