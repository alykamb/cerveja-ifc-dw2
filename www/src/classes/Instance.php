<?php

class Instance
{
    public static function fromData($data)
    {
        $obj = new static();
        foreach ($data as $key => $prop) {
            $obj->$key->value = $prop;
        }
        return $obj;
    }
}
