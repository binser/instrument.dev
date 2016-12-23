<?php

namespace Binser\InstrumentBundle\Form;

use Binser\InstrumentBundle\Entity\DeliveryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\SecurityContext;

class OrderType extends AbstractType
{
    /** @var  Session */
    private $session;
    /** @var  SecurityContext */
    private $securityContext;

    public function __construct(Session $session, SecurityContext $securityContext)
    {
        $this->session = $session;
        $this->securityContext = $securityContext;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->securityContext->getToken()->getUser();
        if ($user === 'anon.') {
            $user = false;
        }
        $builder
            ->add('clientFirstName', null, array(
                'attr' => array(
                    'placeholder' => 'Иван',
                    'class' => 'input_block'
                ),
                'label' => 'Имя',
                'data' => $user ? $user->getFirstname() : ''))
            ->add('clientLastName', null, array(
                'attr' => array(
                    'placeholder' => 'Иванов',
                    'class' => 'input_block'
                ),
                'label' => 'Фамилия',
                'data' => $user ? $user->getLastname() : ''))
            ->add('telephone', null, array(
                'attr' => array(
                    'placeholder' => '+7 910 001 10 10',
                    'class' => 'input_block'
                ),
                'label' => 'Телефон',
                'data' => $user ? $user->getPhone() : ''))
            ->add('email', EmailType::class, array(
                'attr' => array(
                    'placeholder' => 'mail@mail.ru',
                    'class' => 'input_block'
                ),
                'label' => 'E-mail',
                'data' => $user ? $user->getEmail() : ''))
            ->add('address', new AddressOrderType(), array(
                'label' => false,
                'required' => false,
                'data_class' => 'Binser\InstrumentBundle\Entity\AddressOrder'
            ))
            ->add('wishes', null, array('label' => 'Ваши пожелания'))
            ->add('deliveryType', 'hidden', array('data' => DeliveryType::PICKUP))
            ->add('products', 'hidden', array('data' => $this->session->get('ids')))
            ->add('summ', 'hidden', array('data' => $this->session->get('basketSumm')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Binser\InstrumentBundle\Entity\Order',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Orders';
    }
}