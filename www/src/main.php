<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once("classes/Crud.php");
require_once("classes/DB.php");
require_once("classes/Field.php");
require_once("classes/Cerveja.php");
require_once("classes/Cozinha.php");
require_once("classes/CozinhaCerveja.php");
require_once("classes/Cervejaria.php");
require_once("classes/Endereco.php");

require_once("helpers/validators.php");
require_once("helpers/form.php");

require_once("components/head.php");
require_once("components/header.php");
require_once("components/table.php");

$GLOBALS['title'] = "";

$db = new DB();
$enderecos = new Crud($db, 'endereco');
$cervejarias = new Crud($db, 'cervejaria');
$cervejas = new Crud($db, 'cerveja');
$cozinhas = new Crud($db, 'cozinha');
$cozinha_cerveja = new Crud($db, 'cozinha_cerveja');
