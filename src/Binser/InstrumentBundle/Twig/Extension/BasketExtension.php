<?php

namespace Binser\InstrumentBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BasketExtension extends \Twig_Extension
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
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