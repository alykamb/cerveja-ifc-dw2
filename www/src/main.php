<?php
require_once("classes/Crud.php");
require_once("classes/DB.php");
require_once("classes/Field.php");
require_once("classes/Instance.php");

$files = array_merge(
    glob(dirname(__FILE__) . '/classes/*.php'),
    glob(dirname(__FILE__) . '/helpers/*.php'),
    glob(dirname(__FILE__) . '/components/*.php'),
    glob(dirname(__FILE__) . '/pages/*.php'),
);

foreach ($files as $file) {
    require_once($file);
}

$GLOBALS['title'] = "";

$path = parsePath();
$GLOBALS['path'] = $path;

$db = new DB();
$enderecos = new Crud($db, 'endereco');
$cervejarias = new Crud($db, 'cervejaria');
$cervejas = new Crud($db, 'cerveja');
$cozinhas = new Crud($db, 'cozinha');
$cozinha_cerveja = new Crud($db, 'cozinha_cerveja');
