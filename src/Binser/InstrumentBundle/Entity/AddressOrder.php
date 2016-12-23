<?php

namespace Binser\InstrumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="shop_order_address")
 */
class AddressOrder
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $region;

    /**
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $district;

    /**
     * @ORM\Column(type="string")
     */
    protected $street;

    /**
     * @ORM\Column(type="string")
     */
    protected $house;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $flat;

    /**
     * @ORM\Column(name="enter_code", type="string", nullable=true)
     */
    protected $enterCode;

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
     * Set region
     *
     * @param string $region
     *
     * @return AddressOrder
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return AddressOrder
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return AddressOrder
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return AddressOrder
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set house
     *
     * @param string $house
     *
     * @return AddressOrder
     */
    public function setHouse($house)
    {
        $this->house = $house;

        return $this;
    }

    /**
     * Get house
     *
     * @return string
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Set flat
     *
     * @param string $flat
     *
     * @return AddressOrder
     */
    public function setFlat($flat)
    {
        $this->flat = $flat;

        return $this;
    }

    /**
     * Get flat
     *
     * @return string
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Set enterCode
     *
     * @param string $enterCode
     *
     * @return AddressOrder
     */
    public function setEnterCode($enterCode)
    {
        $this->enterCode = $enterCode;

        return $this;
    }

    /**
     * Get enterCode
     *
     * @return string
     */
    public function getEnterCode()
    {
        return $this->enterCode;
    }

    public function getFullAddress()
    {
        if (!$this->getRegion()) {
            return '';
        }

        $address =  "{$this->getRegion()}, {$this->getCity()}";
        if ($this->getDistrict()) {
            $address .= " {$this->getDistrict()}";
        }
        $address .= ", Ул. {$this->getStreet()} {$this->getHouse()}";
        if ($this->getFlat()) {
            $address .= " кв. {$this->getFlat()}";
        }
        if ($this->getEnterCode()) {
            $address .= ", Код домофона: {$this->getEnterCode()}";
        }

        return $address;
    }
}
