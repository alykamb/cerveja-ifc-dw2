<?php

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
        $this->id = new Field("id", "number", false);
        $this->logradouro = new Field("logradouro", "text", true, "all", $minLength(3));
        $this->estado = new Field("estado", "text", true, "all", $minLength(3));
        $this->cidade = new Field("cidade", "text", true, "all", $minLength(3));
        $this->cep = new Field("cep", "text", true, "all", $minLength(9));
    }
}
