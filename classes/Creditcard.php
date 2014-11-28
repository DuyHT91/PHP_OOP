<?php
/**
 * Created by PhpStorm.
 * User: Diamond
 * Date: 11/27/2014
 * Time: 10:26 AM
 */

class Creditcard extends Method
{

    protected $commissionRate = 5;

    public function setInfo ( $userId, $name, $number ) {
        $methodData = array(
            'user_id' => $userId,
            "name" => $name,
            "number" => $number,
        );

        $this->userId = $userId;
        $this->name = $name;
        $this->number = $number;

        $this->methodData = $methodData;
        $log = new Log();
        $log->logCCInfo($userId, $name, $number, __FUNCTION__);
    }

    public function getRate() {
        return $this->commissionRate;
    }

    public function getInfo () {
        return $this->methodData;
    }

} 