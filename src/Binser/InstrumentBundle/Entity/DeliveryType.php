<?php

namespace Binser\InstrumentBundle\Entity;

class DeliveryType {
    const PICKUP = 1;
    const INSIDE_MKAD = 2;
    const AWAY_MKAD = 3;
    const BY_RUSSIA = 4;
    const ANOTHER_COUNTRY = 5;

    /**
     * @return array
     */
    static public function map(){
        return array(
            self::PICKUP => array(
                'name' => 'Самовывоз - бесплатно',
                'price' => 0
            ),
            self::INSIDE_MKAD => array(
                'name' => 'Доставка в пределах МКАД - 300 руб',
                'price' => 300
            ),
            self::AWAY_MKAD => array(
                'name' => 'Доставка за МКАД - от 500 руб',
                'price' => 500
            ),
            self::BY_RUSSIA => array(
                'name' => 'Доставка по России - от 600 руб',
                'price' => 600
            ),
            self::ANOTHER_COUNTRY => array(
                'name' => 'Доставка в другую страну - от 1000 руб',
                'price' => 1000
            )
        );
    }

    /**
     * @param $type
     * @return string
     */
    static public function getAsText($type){
        $map = self::map();
        if(array_key_exists($type, $map)){
            return $map[$type]['name'];
        }
        return '';
    }
}