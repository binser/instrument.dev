<?php

namespace Binser\InstrumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="namespace Binser\InstrumentBundle\Repository\OrderRepository")
 * @ORM\Table(name="shop_orders")
 */
class Order
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Имя клиента
     *
     * @ORM\Column(name="client_first_name", type="string")
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Имя не может быть короче {{ limit }} символов",
     *      maxMessage = "Имя не может быть длинее {{ limit }} символов"
     * )
     */
    protected $clientFirstName;

    /**
     * Фамилия клиента
     *
     * @ORM\Column(name="client_last_name", type="string", nullable=true)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Фамилия не может быть короче {{ limit }} символов",
     *      maxMessage = "Фамилия не может быть длинее {{ limit }} символов"
     * )
     */
    protected $clientLastName;


    /**
     * Телефон клиента
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern = "/^[\+\d\-]{3,15}$/",
     *     message = "Неверно введен телефон (разрешенные значения [+, -, {0-9}])"
     * )
     */
    protected $telephone;

    /**
     * Email клиента
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank()
     * @Assert\Email(message="Введите корректный email")
     */
    protected $email;

    /**
     * Пожелания клиента
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $wishes;

    /**
     * json_encode продуктов в корзине
     *
     * @ORM\Column(type="text")
     */
    protected $products;

    /** @var  array */
    protected $orderProductsArray;

    /**
     * Сущность адреса
     * @ORM\OneToOne(targetEntity="ShopBundle\Entity\AddressOrder", cascade={"persist"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=true)
     */
    protected $address;

    /**
     * Тип доставки
     *
     * @ORM\Column(name="delivery_type", type="smallint")
     */
    protected $deliveryType;

    /**
     * Сумма заказа
     *
     * @ORM\Column(type="float")
     */
    protected $summ;

    /**
     * Статус заказа:
     * 1 - новый
     * 2 - в процессе выполнения
     * 3 - выполнен
     * 4 - отклонен
     *
     * @ORM\Column(type="smallint")
     */
    protected $status;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    protected $user;

    /**
     * Дата создания заказа
     *
     * @ORM\Column(name="date", type="datetime")
     */
    protected $date;

    /**
     * Идентификатор Uuid
     *
     * @ORM\Column(type="string")
     */
    protected $uuid;

    /**
     * Пожелания администратора
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $adminWishes;

    public function __construct() {
        $this->date = new \DateTime();
        $this->status = OrderStatus::NEW_ORDER;
        $this->deliveryType = DeliveryType::PICKUP;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set clientFirstName
     *
     * @param string $clientFirstName
     *
     * @return Order
     */
    public function setClientFirstName($clientFirstName)
    {
        $this->clientFirstName = $clientFirstName;

        return $this;
    }

    /**
     * Get clientFirstName
     *
     * @return string
     */
    public function getClientFirstName()
    {
        return $this->clientFirstName;
    }

    /**
     * Set clientLastName
     *
     * @param string $clientLastName
     *
     * @return Order
     */
    public function setClientLastName($clientLastName)
    {
        $this->clientLastName = $clientLastName;

        return $this;
    }

    /**
     * Get clientLastName
     *
     * @return string
     */
    public function getClientLastName()
    {
        return $this->clientLastName;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Order
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set wishes
     *
     * @param string $wishes
     *
     * @return Order
     */
    public function setWishes($wishes)
    {
        $this->wishes = $wishes;

        return $this;
    }

    /**
     * Get wishes
     *
     * @return string
     */
    public function getWishes()
    {
        return $this->wishes;
    }

    /**
     * Set products
     *
     * @param string $products
     *
     * @return Order
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get products
     *
     * @return string
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Order
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set summ
     *
     * @param float $summ
     *
     * @return Order
     */
    public function setSumm($summ)
    {
        $this->summ = $summ;

        return $this;
    }

    /**
     * Get summ
     *
     * @return float
     */
    public function getSumm()
    {
        return $this->summ;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     *
     * @return Order
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return array
     */
    public function getOrderProductsArray()
    {
        return $this->orderProductsArray;
    }

    /**
     * @param array $orderProductsArray
     */
    public function setOrderProductsArray($orderProductsArray)
    {
        $this->orderProductsArray = $orderProductsArray;
    }

    public function getTextStatus()
    {
        return OrderStatus::getAsText($this->getStatus());
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Order
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function getDelivery()
    {
        return DeliveryType::getAsText($this->getDeliveryType());
    }

    /**
     * Set deliveryType
     *
     * @param integer $deliveryType
     *
     * @return Order
     */
    public function setDeliveryType($deliveryType)
    {
        $this->deliveryType = $deliveryType;

        return $this;
    }

    /**
     * Get deliveryType
     *
     * @return integer
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
    }

    /**
     * Set bonus
     *
     * @param string $bonus
     *
     * @return Order
     */
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * Get bonus
     *
     * @return string
     */
    public function getBonus()
    {
        return $this->bonus;
    }

    /**
     * Set address
     *
     * @param \ShopBundle\Entity\AddressOrder $address
     *
     * @return Order
     */
    public function setAddress(\ShopBundle\Entity\AddressOrder $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \ShopBundle\Entity\AddressOrder
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set adminWishes
     *
     * @param string $adminWishes
     *
     * @return Order
     */
    public function setAdminWishes($adminWishes)
    {
        $this->adminWishes = $adminWishes;

        return $this;
    }

    /**
     * Get adminWishes
     *
     * @return string
     */
    public function getAdminWishes()
    {
        return $this->adminWishes;
    }
}
