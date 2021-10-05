<?php

class Cozinha extends Instance
{
    public Field $id;
    public Field $nome;
    public Field $descricao;

    function __construct()
    {
        global $minLength;
        $this->id  = new Field("Id", "number:number", false);
        $this->nome = new Field("Nome", "string:text", true, "all", $minLength(3));
        $this->descricao = new Field("Descricao", "string:textarea", true, "input");
    }

    function getHeaders($withRelations = true)
    {
        return ['id' => 'Id', 'nome' => 'Nome'];
    }

    function getValues($withRelations = true)
    {
        return ['id' => $this->id->value, 'nome' => $this->nome->value];
    }
}
