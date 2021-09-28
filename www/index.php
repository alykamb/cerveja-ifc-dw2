<?php
require_once("db.php");
require_once("crud.php");
require_once("field.php");
include "validators.php";

$db = new DB();
$endereco = new Crud($db, 'endereco');



class Endereco
{
    public Field $id;
    public Field $logradouro;
    public Field $estado;
    public Field $cidade;
    public Field $cep;

    function __construct()
    {
        global $minLength;
        $this->id = new Field("id");
        $this->logradouro = new Field("logradouro", "text", true, $minLength(3));
        $this->estado = new Field("estado", "text", true, $minLength(3));
        $this->cidade = new Field("cidade", "text", true, $minLength(3));
        $this->cep = new Field("cep", "text", true, $minLength(9));
    }
}

// $end = new Endereco();
// $end->logradouro->value = "rua abstergo";
// $end->estado->value = "Santa Catarina";
// $end->cidade->value = "Rio do sul";
// $end->cep->value = "89160-000";


var_dump($endereco->findAll());
