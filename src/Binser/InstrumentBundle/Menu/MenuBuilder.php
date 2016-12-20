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

        $menu->addChild('О нас', array('route' => 'binser_instrument_about', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Наши услуги', array('route' => 'binser_instrument_services', 'attributes' => array('class' => 'nav-item')));
        /*$menu->addChild('Цены', array('uri' => '#', 'attributes' => array('class' => 'nav-item')));*/
        $menu->addChild('Обучение', array('route' => 'binser_instrument_education', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Примеры работ', array('route' => 'binser_instrument_examples', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Фирменный магазин', array('route' => 'binser_instrument_shop_index', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Статьи', array('route' => 'binser_instrument_blog', 'attributes' => array('class' => 'nav-item')));
        $menu->addChild('Контакты', array('route' => 'binser_instrument_contacts', 'attributes' => array('class' => 'nav-item')));

        return $menu;
    }

    public function createShopMenu()
    {
        $menu = $this->factory->createItem('root');

        $categories = $this->em->getRepository('BinserInstrumentBundle:Category')->findBy(array('enabled' => true));
        foreach($categories as $category) {
            $parent = $menu->addChild($category->getName(),
                array(
                    'route' => 'binser_instrument_shop_category',
                    'routeParameters' => array('categoryUrl' => $category->getUrl())
                )
            );
            $subcategories = $category->getSubCategories();
            if (!$subcategories->isEmpty()) {
                $parent->setAttributes(array(
                    'class' => 'switch collapsed',
                    'data-toggle' => 'collapse',
                    'data-target' => "#subcategories_{$category->getId()}"
                ));
                $parent->setChildrenAttributes(array(
                    'id' => "subcategories_{$category->getId()}",
                    'class' => 'collapse'
                ));
                foreach($subcategories as $subcategory) {
                    $parent->addChild($subcategory->getName(),
                        array(
                            'route' => 'binser_instrument_shop_subcategory',
                            'routeParameters' => array(
                                'categoryUrl' => $category->getUrl(),
                                'subcategoryUrl' => $subcategory->getUrl(),
                            )
                        )
                    );
                }
            }
        }

        return $menu;
    }
}