<?php
/**
 * Created by PhpStorm.
 * User: rafae
 * Date: 21/08/2017
 * Time: 22:54
 */

require_once "config.php";

$usuario = new Usuario();
$usuario->loadById(3);
echo $usuario;