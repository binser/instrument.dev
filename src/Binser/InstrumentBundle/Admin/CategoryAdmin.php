<?php

namespace Binser\InstrumentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CategoryAdmin extends Admin
{
    protected $baseRouteName = 'category';
    protected $baseRoutePattern = 'category';

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name', null, array('label' => 'Имя'));
    }

    /**
     * Конфигурация формы редактирования записи
     *
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, array('label' => 'Имя'))
            ->add('url', null, array('label' => 'Ссылка на страницу категории', 'attr' => array('placeholder' => 'Латинские буквы и символ -')))
            ->add('title', null, array('label' => 'Заголовок страницы'))
            ->add('description', null, array('label' => 'Опиание страницы'))
            ->add('keywords', null, array('label' => 'Ключевые слова'))
            ->add('seoText', 'ckeditor', array(
                    'label' => 'Текст снизу на странице',
                    'config' => array(
                        'filebrowserBrowseRoute' => 'elfinder',
                        'filebrowserBrowseRouteParameters' => array('instance' => 'default')
                    )
                )
            );
    }

    /**
     * Конфигурация списка записей
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', null, array('label' => 'Имя'));
        $listMapper->addIdentifier('url', null, array('label' => 'Ссылка'));
    }
}