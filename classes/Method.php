<?php
/**
 * Created by PhpStorm.
 * User: Diamond
 * Date: 11/26/2014
 * Time: 10:24 AM
 */
require_once('Log.php');

abstract class Method
{

    protected $methodData = array();
    protected $userId;
    protected $name;
    protected $number;
    protected $commissionRate;

    /**
     * @desc    Bind data to the payment method
     * @param   str $userId
     * @param   str $name
     * @param   str $number
     */
    abstract protected function setInfo( $userId, $name, $number );

    /**
     * @desc    Return data bound to the payment method
     * @return  array $methodData
     */
    abstract protected function getInfo();

    /**
     * @desc    Return commission rate of the payment method
     * @return  int $commissionRate
     */
    abstract protected function getRate();

} 