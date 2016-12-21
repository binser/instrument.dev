<?php

namespace Binser\UserBundle\Menu;

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

    public function createUserMenu()
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'list-group'));

        $menu->addChild('Мои данные', array('route' => 'user_profile_comments',  'attributes' => array('class' => 'list-group-item')));
        $menu->addChild('Мои комментарии', array('route' => 'fos_user_profile_show',  'attributes' => array('class' => 'list-group-item')));
        $menu->addChild('Сменить пароль', array('route' => 'fos_user_change_password', 'attributes' => array('class' => 'list-group-item')));

        return $menu;
    }
}