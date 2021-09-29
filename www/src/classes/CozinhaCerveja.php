<?php

class CozinhaCerveja
{
    public Field $id;
    public Field $cerveja_id;
    public Field $cozinha_id;

    function __construct()
    {
        global $minLength;
        $this->id = new Field("id", "number", false, false);
        $this->cerveja_id = new Field("cerveja_id", "number", true);
        $this->cozinha_id = new Field("cozinha_id", "number", true);
    }
}
