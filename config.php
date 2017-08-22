<?php
/**
 * Created by PhpStorm.
 * User: rafae
 * Date: 21/08/2017
 * Time: 22:52
 */

spl_autoload_register(function ($class_name){
    $filename = $class_name.".php";
    if (file_exists($filename)) {
        require_once $filename;
    }
});