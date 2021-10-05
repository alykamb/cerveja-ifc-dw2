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
            $this->cervejaria = Cerveja::fromData($cervejarias->findById($this->cervejaria_id->value));
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

    function getHeaders($withRelations = true)
    {
        if (!$withRelations) {
            return ['id' => 'Id', 'nome' => 'Nome', 'cervejaria_id' => 'Cervejaria'];
        }
        $cervejariaHeaders = $this->cervejaria->getHeaders();
        $cervejariaItems = [];

        foreach (array_filter(array_keys($cervejariaHeaders), function ($key) {
            return $key != 'id';
        }) as $key) {
            $cervejariaItems[$key] = $cervejariaHeaders[$key];
        }

        return array_merge(['id' => 'Id', 'nome' => 'Nome'], $cervejariaItems);
    }

    function getValues($withRelations = true)
    {
        if (!$withRelations) {
            return ['id' => $this->id->value, 'nome' => $this->nome->value, 'cervejaria_id' => $this->cervejaria_id->value];
        }
        $cervejariaValues = $this->cervejaria->getValues();
        $cervejariaItems = [];

        foreach (array_filter(array_keys($cervejariaValues), function ($key) {
            return $key != 'id';
        }) as $key) {
            $cervejariaItems[$key] = $cervejariaValues[$key];
        }

        return array_merge(['id' => $this->id->value, 'nome' => $this->nome->value], $cervejariaItems);
    }
}
