<?php

class Cervejaria
{
    public Field $id;
    public Field $nome;
    public Field $endereco_id;

    function __construct()
    {
        global $minLength;
        $this->id = new Field("id", "number", false);
        $this->nome = new Field("Nome", "text", true, "all", $minLength(3));
        $this->endereco_id = new Field("Endereço", "number", false, "table");
    }
}
