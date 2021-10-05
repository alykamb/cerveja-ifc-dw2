<?php

class Endereco extends Instance
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

    function getValues()
    {
        return [
            'id' => $this->id->value,
            'logradouro' => $this->logradouro->value,
            'estado' => $this->estado->value,
            'cidade' => $this->cidade->value,
            'cep' => $this->cep->value,
        ];
    }

    function getHeaders()
    {
        return [
            'id' => 'Id',
            'logradouro' => 'Logradouro',
            'estado' => 'Estado',
            'cidade' => 'Cidade',
            'cep' => 'Cep'
        ];
    }
}
