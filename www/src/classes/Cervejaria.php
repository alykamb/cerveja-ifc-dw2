<?php

class Cervejaria extends Instance
{
    public Field $id;
    public Field $nome;
    public Field $endereco_id;
    public Endereco $endereco;

    function __construct()
    {
        global $minLength;
        $this->id = new Field("id", "number", false);
        $this->nome = new Field("Nome", "text", true, "all", $minLength(3));
        $this->endereco_id = new Field("Endereço", "number", false, "table");
    }

    function loadRelations()
    {
        global $enderecos;
        if ($this->endereco_id) {
            var_dump($enderecos->findById($this->endereco_id->value));
            $this->endereco = Endereco::fromData($enderecos->findById($this->endereco_id->value));
        }
    }

    function getHeaders($withRelations = true)
    {
        if (!$withRelations) {
            return ['id' => 'Id', 'nome' => 'Nome', 'endereco_id' => 'Endereco'];
        }
        $enderecoHeaders = $this->endereco->getHeaders();
        $enderecoItems = [];

        foreach (array_filter(array_keys($enderecoHeaders), function ($key) {
            return $key != 'id';
        }) as $key) {
            $enderecoItems[$key] = $enderecoHeaders[$key];
        }

        return array_merge(['id' => 'Id', 'nome' => 'Nome'], $enderecoItems);
    }

    function getValues($withRelations = true)
    {
        if (!$withRelations) {
            return ['id' => $this->id->value, 'nome' => $this->nome->value, 'endereco_id' => $this->endereco_id->value];
        }
        $enderecoValues = $this->endereco->getValues();
        $enderecoItems = [];

        foreach (array_filter(array_keys($enderecoValues), function ($key) {
            return $key != 'id';
        }) as $key) {
            $enderecoItems[$key] = $enderecoValues[$key];
        }

        return array_merge(['id' => $this->id->value, 'nome' => $this->nome->value], $enderecoItems);
    }
}
