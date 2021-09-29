<?php

class Cerveja
{
    public Field $id;
    public Field $nome;
    public Field $cervejaria_id;

    function __construct()
    {
        global $minLength;
        $this->id = new Field("id", "number", false, false);
        $this->nome = new Field("nome", "text", true, true, $minLength(3));
        $this->cervejaria_id = new Field("cervejaria_id", "number", true, false);
    }
}
