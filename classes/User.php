<?php
/**
 * Created by PhpStorm.
 * User: Diamond
 * Date: 11/26/2014
 * Time: 10:23 AM
 */
require_once('Log.php');

class User
{

    private $userId;
    private $acceptMethod = array();
    private $activeMethod;

    /**
     * @desc    Init User
     * @param   str $userId     Identifier of the user
     */
    public  function __construct ( $userId ) {
        $this->userId = $userId;
        echo "A new User with Id: " . $userId . " was created<br>";
        $log = new Log();
        $log->logUserCreate($userId, __FUNCTION__);
    }

    /**
     * @desc    Return the id of user
     * @return  str $userId
     */
    public function getUserId () {
        return $this->userId;
    }

    /**
     * @desc   Bind payment methods to user
     * @param  array $acceptMethod
     */
    public function setPaymentMethod ( $acceptMethod ) {
        if (empty($this->acceptMethod)) {
            $this->acceptMethod = $acceptMethod;
        } else {
            foreach ($acceptMethod as $key => $value) {
                if (!in_array($value, $this->acceptMethod)) {
                    array_push($this->acceptMethod, $value);
                }
            }
        }
        $log = new Log();
        $log->logUserBindPaymentMethod($this->userId, $acceptMethod, __FUNCTION__);
    }

    /**
     * @desc   Unbind payment method from user
     * @param  str $unsetMethod
     * @param  array $acceptMethod
     */
    public function unsetPaymentMethod ( $unsetMethod, $acceptMethod ) {
        if (in_array($unsetMethod, $acceptMethod)) {
            foreach ($acceptMethod as $key => $value) {
                if ($unsetMethod == $value) {
                    unset($acceptMethod[$key]);
                }
            }
            $this->acceptMethod = $acceptMethod;
        }
        $log = new Log();
        $log->logUserUnbindPaymentMethod($this->userId, $unsetMethod, __FUNCTION__);
    }

    /**
     * @desc    Return the payment methods of user
     * @return  array $acceptMethod
     */
    public function getPaymentMethod () {
        return $this->acceptMethod;
    }

    /**
     * @desc   Bind active method to user
     * @param  str $activeMethod
     */
    public function setActivePaymentMethod ( $activeMethod ) {
        $acceptMethod = $this->acceptMethod;
        if (in_array($activeMethod, $acceptMethod)) {
            foreach ($acceptMethod as $key => $value) {
                if ($activeMethod == $value) {
                    $this->activeMethod = $activeMethod;
                }
            }
        }
        $log = new Log();
        $log->logUserActiveMethod($this->userId, $activeMethod, __FUNCTION__);
    }

    /**
     * @desc    Return the active method of user
     * @return  str $activeMethod
     */
    public function getActivePaymentMethod (){
        return $this->activeMethod;
    }

} 