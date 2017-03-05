<?php

namespace Binser\InstrumentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ServiceAdmin extends Admin
{
    protected $baseRouteName = 'service';
    protected $baseRoutePattern = 'service';

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title', null, array('label' => 'Заголовок'));
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
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('price', null, array('label' => 'Цена, РУБ'))
            ->add('link', null, array('label' => 'Ссылка на страницу услуги', 'attr' => array('placeholder' => 'Латинские буквы и символ -')))
            ->add('seoTitle', null, array('label' => 'Заголовок для SEO'))
            ->add('seoDescription', null, array('label' => 'Описание для SEO'))
            ->add('seoKeywords', null, array('label' => 'Ключевые слова для SEO'))
            ->add('text', 'ckeditor', array(
                    'label' => 'Структура страницы услуги',
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
        $listMapper
            ->addIdentifier('title', null, array('label' => 'Заголовок'))
            ->add('price', null, array('label' => 'Цена'));
    }
}