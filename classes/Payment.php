<?php
/**
 * Created by PhpStorm.
 * User: Diamond
 * Date: 11/26/2014
 * Time: 10:20 AM
 */
require_once('Log.php');

class Payment
{

    protected $transaction = array();
    protected $transactionDetail = array();
    protected $transactionDetailByMethod = array();
    protected $amount;
    protected $summarize;
    protected $currency;
    protected $userId;
    protected $paymentMethod;

    /**
     * @desc    Bind data to process transaction
     * @param   str $amount
     * @param   str $currency
     * @param   str $userId
     * @param   str $paymentMethod
     */
    public function makePayment ( $amount, $currency, $userId, $paymentMethod ) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->userId = $userId;
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @desc    Bind data to the payment transaction
     * @param   int $rate
     */
    public function setTransaction ( $rate ) {
        $amount = $this->amount;
        $commissionAmount = $amount * ( 1 + $rate / 100 );

        $transaction = array(
            "amount" => $amount,
            "summarize" => $commissionAmount,
            "currency" => $this->currency,
            "user" => $this->userId,
            "method" => $this->paymentMethod
        );

        $this->transaction = $transaction;
        array_push($this->transactionDetail, $transaction);
        $log = new Log();
        $log->logTransaction($this->userId, $this->amount, $this->currency, $this->paymentMethod, __FUNCTION__);
    }

    /**
     * @desc    Return all transactions made by the user
     * @param   str $userID
     */
    public function getTransaction ( $userID ) {
        if ( $this->userId == $userID ) {
            $log = new Log();
            $log->logUserGetTransaction($userID, __FUNCTION__);
            return $this->transactionDetail;
        }
    }

    /**
     * @desc    Return all transactions of a method made by the user
     * @param   str $userId
     * @param   str $method
     */
    public function getTransactionByMethod ( $userID, $method ) {
        if ( $userID == $this->userId ) {
            foreach ( $this->transactionDetail as $key => $value ) {
                if ( $method == $value['method'] ) {
                    array_push($this->transactionDetailByMethod, $this->transactionDetail[$key]);
                }
            }
        }
        $log = new Log();
        $log->logUserGetTransactionByMethod($userID, $method, __FUNCTION__);
        return $this->transactionDetailByMethod;
    }

} 