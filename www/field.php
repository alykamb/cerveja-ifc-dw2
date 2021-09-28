<?php

class Field
{
    public string $name;
    public string $type;
    public bool $required;
    public Closure $validator;
    public $value;

    function __construct(
        string $name,
        string $type = "text",
        bool $required = false,
        $validator = NULL
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
        if ($validator && $validator instanceof Closure) {
            $this->validator = $validator;
        }
    }
}
