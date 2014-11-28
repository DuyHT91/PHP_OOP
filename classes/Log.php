<?php
/**
 * Created by PhpStorm.
 * User: Diamond
 * Date: 11/26/2014
 * Time: 10:35 AM
 */

class Log {
    private $userLog = 'user.log';
    private $methodLog = 'method.log';
    private $paymentLog = 'payment.log';

    protected function write( $strFileName, $strData ) {
        if (!file_exists('logs')) {
            mkdir('/logs', 0777, true);
        }
        $handler = fopen( "logs/" . $strFileName, 'a+');
        fwrite($handler, "\r\n" . "[" . date('Y-m-d H:i:s') . "]" . " ". $strData);
        fclose($handler);
    }


    public function logUserCreate ( $userId, $functionName) {
        $this->write($this->userLog, "[" . $functionName . "] " . $userId . " was created");
    }

    public function logUserBindPaymentMethod ( $userId, $method, $functionName) {
        $paymentMethod = implode(", ", $method);
        $this->write($this->userLog, "[" . $functionName . "] " . $userId . " has bind " . $paymentMethod . " as payment method(s)");
    }

    public function logUserUnbindPaymentMethod ( $userId, $method, $functionName) {
        $this->write($this->userLog, "[" . $functionName . "] " . $userId . " has unbind " . $method . " payment method");
    }

    public function logUserActiveMethod ( $userId, $method, $functionName) {
        $this->write($this->userLog, "[" . $functionName . "]" . $userId . " has set " . $method . " as active payment method");
    }

    public function logUserGetTransaction ( $userId, $functionName) {
        $this->write($this->userLog, "[" . $functionName . "] " . $userId . " has get all transactions");
    }

    public function logUserGetTransactionByMethod ( $userId, $method, $functionName) {
        $this->write($this->userLog, "[" . $functionName . "] " . $userId . " has get all transactions of method " . $method);
    }

    public function logCCInfo ( $userId, $name, $number, $functionName) {
        $this->write($this->methodLog, "[" . $functionName . "] " . $userId . " has set data for Credit Card as: " . $name . "|" . $number);
    }

    public function logBankAccountInfo ( $userId, $name, $number, $functionName) {
        $this->write($this->methodLog, "[" . $functionName . "] " . $userId . " has set data for Bank Account as: " . $name . "|" . $number);
    }

    public function logTransaction ( $userId, $amount, $currency, $method, $functionName) {
        $this->write($this->paymentLog, "[" . $functionName . "] " . $userId . " has made a transaction Amount: " . $amount . " Currency: " . $currency . " using Method: " . $method);
    }

} 