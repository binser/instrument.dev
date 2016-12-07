<?php

namespace Binser\InstrumentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PostAdmin extends Admin
{
    protected $baseRouteName = 'post';
    protected $baseRoutePattern = 'post';

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title', null, array('label' => 'Заголовок'));
    }

    /**
     * Конфигурация формы редактирования записи
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('image', 'sonata_media_type', array(
                'label' => 'Картинка',
                'provider' => 'sonata.media.provider.image',
                'context'  => 'post',
                'required' => false
            ))
            ->add('anons', null, array('label' => 'Анонс'))
            ->add('text', 'ckeditor', array(
                    'label' => 'Текст',
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
            ->add('anons', null, array('label' => 'Анонс'))
            ->add('image', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'));
    }
}