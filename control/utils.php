<?php
/**
 * Created by PhpStorm.
 * User: e.bouh
 * Date: 29/11/2017
 * Time: 10:16
 */

class utils
{
    private static $_instance = false;

    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new utils();
        }

        return self::$_instance;
    }

    public function verify_null ($var)
    {
        if($var!="" && !empty($var)){
            return trim($var);
        }
        return null;
    }

    public static function isNull($var){
        return is_null(utils::getInstance()->verify_null($var));
    }

}