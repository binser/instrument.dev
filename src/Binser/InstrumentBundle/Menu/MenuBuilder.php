<?php

namespace Binser\InstrumentBundle\Menu;

use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     * @param EntityManager $em
     */
    public function __construct(FactoryInterface $factory, EntityManager $em)
    {
        $this->factory = $factory;
        $this->em = $em;
    }

    public function createMainMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'nav navbar-nav'));

        //$menu->addChild('Главная', array('route' => 'hookah_main_page'));
        $menu->addChild('О нас', array('uri' => '#', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Наши услуги', array('uri' => '#', 'attributes' => array('class' => 'nav-item dropdown')));
        $menu['Наши услуги']->setChildrenAttributes(array('class' => 'dropdown-menu'));
        $menu['Наши услуги']->addChild('заточка маникюрного инструмента', array('uri' => '#'));
        $menu['Наши услуги']->addChild('заточка парикмахерского оборудования', array('uri' => '#'));
        $menu->addChild('Цены', array('uri' => '#', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Обучение', array('uri' => '#', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Примеры работ', array('uri' => '#', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Фирменный магазин', array('route' => 'binser_instrument_shop_index', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Статьи', array('route' => 'binser_instrument_blog', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Контакты', array('uri' => '#', 'attributes' => array('class' => 'nav-item')));

        return $menu;
    }
}