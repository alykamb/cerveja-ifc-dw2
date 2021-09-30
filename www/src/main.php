<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("classes/Crud.php");
require_once("classes/DB.php");
require_once("classes/Field.php");

$files = array_merge(
    glob(dirname(__FILE__) . '/classes/*.php'),
    glob(dirname(__FILE__) . '/helpers/*.php'),
    glob(dirname(__FILE__) . '/components/*.php'),
    glob(dirname(__FILE__) . '/pages/*.php'),
);

foreach ($files as $file) {
    require_once($file);
}


// require_once("classes/Cerveja.php");
// require_once("classes/Cozinha.php");
// require_once("classes/CozinhaCerveja.php");
// require_once("classes/Cervejaria.php");
// require_once("classes/Endereco.php");

// require_once("helpers/validators.php");
// require_once("helpers/form.php");
// require_once("helpers/parsePath.php");

// require_once("components/head.php");
// require_once("components/header.php");
// require_once("components/table.php");

// require_once("pages/formPage.php");
// require_once("pages/home.php");

$GLOBALS['title'] = "";

$path = parsePath();
$GLOBALS['path'] = $path;

$db = new DB();
$enderecos = new Crud($db, 'endereco');
$cervejarias = new Crud($db, 'cervejaria');
$cervejas = new Crud($db, 'cerveja');
$cozinhas = new Crud($db, 'cozinha');
$cozinha_cerveja = new Crud($db, 'cozinha_cerveja');
