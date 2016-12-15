<?php

namespace Binser\InstrumentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Binser\InstrumentBundle\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category
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
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $enabled;

    /**
     * @ORM\OneToMany(targetEntity="Binser\InstrumentBundle\Entity\SubCategory", mappedBy="category")
     */
    protected $subCategories;

    /**
     * @ORM\OneToMany(targetEntity="Binser\InstrumentBundle\Entity\Product", mappedBy="category")
     */
    protected $products;

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subCategories = new ArrayCollection();
        $this->enabled = true;
    }

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
     *
     * @return Category
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
     * Set url
     *
     * @param string $url
     *
     * @return Category
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Category
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Add subCategory
     *
     * @param \Binser\InstrumentBundle\Entity\SubCategory $subCategory
     *
     * @return Category
     */
    public function addSubCategory(\Binser\InstrumentBundle\Entity\SubCategory $subCategory)
    {
        $this->subCategories[] = $subCategory;

        return $this;
    }

    /**
     * Remove subCategory
     *
     * @param \Binser\InstrumentBundle\Entity\SubCategory $subCategory
     */
    public function removeSubCategory(\Binser\InstrumentBundle\Entity\SubCategory $subCategory)
    {
        $this->subCategories->removeElement($subCategory);
    }

    /**
     * Get subCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubCategories()
    {
        return $this->subCategories;
    }

    /**
     * Add product
     *
     * @param \Binser\InstrumentBundle\Entity\Product $product
     *
     * @return Category
     */
    public function addProduct(\Binser\InstrumentBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \Binser\InstrumentBundle\Entity\Product $product
     */
    public function removeProduct(\Binser\InstrumentBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }
}
