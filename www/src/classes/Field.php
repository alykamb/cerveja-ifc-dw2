<?php

class Field
{
    public string $name;
    public string $type;
    public bool $required;
    public string $show;
    public Closure $validator;
    public $value;

    function __construct(
        string $name,
        string $type = "text",
        bool $required = false,
        string $show = "table",
        $validator = NULL
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
        $this->show = $show;
        if ($validator && $validator instanceof Closure) {
            $this->validator = $validator;
        }
    }
}
