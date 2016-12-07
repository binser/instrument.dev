<?php

namespace Binser\InstrumentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends Admin
{
    protected $baseRouteName = 'product';
    protected $baseRoutePattern = 'product';

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title', null, array('label' => 'Название'));
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
            ->add('title', null, array('label' => 'Название'))
            ->add('price', null, array('label' => 'Цена, РУБ'))
            ->add('category', 'sonata_type_model', array('label' => 'Категория'))
            ->add('subCategory', 'sonata_type_model', array('label' => 'Подкатегория'))
            ->add('description', 'ckeditor', array(
                    'label' => 'Описание товара',
                    'config' => array(
                        'filebrowserBrowseRoute' => 'elfinder',
                        'filebrowserBrowseRouteParameters' => array('instance' => 'default')
                    )
                )
            )
            ->add('characteristics', 'ckeditor', array(
                    'label' => 'Характеристики товара',
                    'config' => array(
                        'filebrowserBrowseRoute' => 'elfinder',
                        'filebrowserBrowseRouteParameters' => array('instance' => 'default')
                    )
                )
            )
            ->add('mainImage', 'sonata_media_type', array(
                'label' => 'Главние фото',
                'provider' => 'sonata.media.provider.image',
                'context'  => 'post',
                'required' => true
            ))
            ->add('images', 'sonata_type_model_list', array('label' => 'Фотограффии'), array('link_parameters' => array('context' => 'photo_report'), 'list' => false));
    }

    /**
     * Конфигурация списка записей
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array('label' => 'Название'))
            ->add('price', null, array('label' => 'Цена'))
            ->add('image', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'));
    }
}