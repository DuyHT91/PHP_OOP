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

    abstract protected function setInfo( $userId, $name, $number );
    abstract protected function getInfo();

} 