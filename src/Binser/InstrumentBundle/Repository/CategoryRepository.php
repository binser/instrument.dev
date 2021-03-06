<?php

namespace Binser\InstrumentBundle\Repository;
use Binser\InstrumentBundle\Entity\Category;
use Binser\InstrumentBundle\Entity\SubCategory;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $url
     * @return Category|null
     */
    public function getCategoryByUrl($url)
    {
        return $this->findOneBy(['url' => $url]);
    }
}
