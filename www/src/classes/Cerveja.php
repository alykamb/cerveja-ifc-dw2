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
        $this->id = new Field("Id", "number:number", false, "table");
        $this->nome = new Field("Nome", "string:text", true, true, $minLength(3));

        $this->cervejaria_id = new Field("Cervejaria", "number:select", true, "all", NULL, function () {
            return $this->getOptionsCervejarias();
        });
    }

    function loadRelations()
    {
        global $cervejarias;
        if ($this->cervejaria_id) {
            $this->cervejaria = Cervejaria::fromData($cervejarias->findById($this->cervejaria_id->value));
        }
    }

    function getOptionsCervejarias()
    {
        global $cervejarias;
        $options = [];
        foreach ($cervejarias->findAll() as $row) {
            $options[] = ["value" => $row['id'], "label" => $row['nome']];
        }
        return $options;
    }

    function getHeaders($withRelations = true)
    {
        if (!$withRelations) {
            return ['id' => 'Id', 'nome' => 'Nome', 'cervejaria_id' => 'Cervejaria'];
        }

        return array_merge(['id' => 'Id', 'nome' => 'Nome', 'cervejaria_nome' => 'Cervejaria']);
    }

    function getValues($withRelations = true)
    {
        if (!$withRelations) {
            return ['id' => $this->id->value, 'nome' => $this->nome->value, 'cervejaria_id' => $this->cervejaria_id->value];
        }
        $cervejariaValues = $this->cervejaria->getValues(false);
        $cervejariaItems = [];

        foreach (array_filter(array_keys($cervejariaValues), function ($key) {
            return $key != 'id';
        }) as $key) {
            $cervejariaItems[$key] = $cervejariaValues[$key];
        }

        return array_merge(['id' => $this->id->value, 'nome' => $this->nome->value, 'cervejaria_nome' => $cervejariaItems['nome']]);
    }
}
