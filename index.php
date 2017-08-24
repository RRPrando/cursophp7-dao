<?php
/**
 * Created by PhpStorm.
 * User: rafae
 * Date: 21/08/2017
 * Time: 22:54
 */

require_once "config.php";

//CARREGA 1 USUARIO
/*$usuario = new Usuario();
$usuario->loadById(3);
echo $usuario;*/

//CARREGA LISTA DE USUARIO
/*$lista = Usuario::getList();
echo json_encode($lista);*/

//CARREGA LISTA DE USUARIO BUSCANDO LOGIN
/*$search = Usuario::search("jo");
echo json_encode($search);*/

//CARREGA UM USUARIO USANDO LOGIN E SENHA
$usuario = new Usuario();
$usuario->login("root","!@#$");
echo $usuario;