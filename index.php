<?php
/**
 * Created by PhpStorm.
 * User: rafae
 * Date: 21/08/2017
 * Time: 22:54
 */

require_once "config.php";

$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);