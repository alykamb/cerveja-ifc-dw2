<?php

class Cozinha
{
    public Field $id;
    public Field $nome;
    public Field $descricao;

    function __construct()
    {
        global $minLength;
        $this->id  = new Field("id", "number", false, false);
        $this->nome = new Field("nome", "text", true, true, $minLength(3));
        $this->descricao = new Field("descricao", "textarea", true);
    }
}
