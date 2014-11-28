<?php
/**
 * Created by PhpStorm.
 * User: Diamond
 * Date: 11/26/2014
 * Time: 10:18 AM
 *
 * The purpose of this project is simulate actions of a user making payments
 * and practicing OOP with PHP
 */

function __autoload($class){
    require_once "/classes/".$class.".php";
}

$validMethods = array("creditcard", "banktransfer");

//Init a new user with identifier
$user = new User('Nate');

//Init payment
$payment = new Payment();

//Bind all valid payment methods to the user
$user->setPaymentMethod($validMethods);

//Unbind one payment method of the user
$user->unsetPaymentMethod("banktransfer", $user->getPaymentMethod());

//Bind a new payment method to the user
$user->setPaymentMethod(array("banktransfer"));

//Set data of Credit Card to the user
$cc = new Creditcard();
$cc->setInfo($user->getUserId(), "Norman", "444422221111");

//Set data of Bank Account to the user
$bankaccount = new Bankaccount();
$bankaccount->setInfo($user->getUserId(), "Jack", "0055131234");

//Get all necessary data to process payments
$userId = $user->getUserId();
$userPaymentMethods = $user->getPaymentMethod();
$ccInfo = $cc->getInfo();
$ccRate = $cc->getRate();
$bankaccountInfo = $bankaccount->getInfo();
$bankaccountRate = $bankaccount->getRate();

//Begin of making a payment using Credit Card
$user->setActivePaymentMethod("creditcard");
$userActiveMethod = $user->getActivePaymentMethod();
$payment->makePayment( 100, "USD", $userId, $userActiveMethod );
$payment->setTransaction( $ccRate );
//End of making a payment using Credit Card

//Begin of making a payment using Bank Transfer
$user->setActivePaymentMethod("banktransfer");
$userActiveMethod = $user->getActivePaymentMethod();
$payment->makePayment( 200, "AUD", $userId, $userActiveMethod );
$payment->setTransaction( $bankaccountRate );
//End of making a payment using Bank Transfer

echo "All transactions data of user: <br>";
var_dump($payment->getTransaction($userId));
echo "All transactions data for a method of user: <br>";
var_dump($payment->getTransactionByMethod($userId, 'creditcard'));