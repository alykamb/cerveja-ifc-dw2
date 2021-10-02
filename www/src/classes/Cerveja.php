<?php

class Cerveja extends Instance
{
    public Field $id;
    public Field $nome;
    public Field $cervejaria_id;
    public Cervejaria $cervejaria;

    function __construct()
    {
        global $minLength;
        $this->id = new Field("id", "number", false, false);
        $this->nome = new Field("nome", "text", true, true, $minLength(3));

        $this->cervejaria_id = new Field("cervejaria_id", "number", true, "all", NULL, function () {
            $this->getOptionsCervejarias();
        });
    }

    function loadRelations()
    {
        global $cervejarias;
        if ($this->cervejaria_id) {
            $this->cervejaria = $cervejarias->findById($this->cervejaria_id->value);
        }
    }

    function getOptionsCervejarias()
    {
        global $cervejarias;
        $options = [];
        foreach ($cervejarias->findAll() as $row) {
            $options[$row['id']] = $row['nome'];
        }
    }
}
