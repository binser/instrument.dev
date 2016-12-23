<?php

namespace Binser\InstrumentBundle\Entity;

class OrderStatus {
    const NEW_ORDER = 1; // новый
    const IN_PROCESS = 2; // в процессе
    const IS_MADE = 3;   // принят
    const REJECTED = 4;   // отклонён

    /**
     * @return array
     */
    static public function map(){
        return array(
            self::NEW_ORDER => 'Новый заказ',
            self::IN_PROCESS => 'В процессе обработки',
            self::IS_MADE => 'Выполнен',
            self::REJECTED => 'Отклонен',
        );
    }

    /**
     * @param $status
     * @return string
     */
    static public function getAsText($status){
        $map = self::map();
        if(array_key_exists($status, $map)){
            return $map[$status];
        }
        return '';
    }
}