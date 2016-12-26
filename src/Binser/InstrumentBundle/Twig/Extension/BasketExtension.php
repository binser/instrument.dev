<?php

namespace ShopBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class BasketExtension extends \Twig_Extension
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            'filters_block' => new \Twig_SimpleFunction('basket_block', array($this, 'basketBlock'), array('needs_environment' => true))
        );
    }

    /**
     * @param $twig \Twig_Environment
     * @return string
     */
    public function basketBlock(\Twig_Environment $twig)
    {

        return $twig->render('@BinserInstrument/Pages/Shop/basket.html.twig', array());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'basket_block';
    }
}