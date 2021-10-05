<?php

class Instance
{
    public static function fromData($data, $withRelations = false)
    {
        $obj = new static();
        foreach ($data as $key => $prop) {
            $obj->$key->value = $prop;
        }

        if ($withRelations) {
            $obj->loadRelations();
        }
        return $obj;
    }

    public static function fromDataList($items, $withRelations = false)
    {
        $list = [];
        foreach ($items as $item) {
            $list[] = Self::fromData($item, $withRelations);
        }
        return $list;
    }

    public function loadRelations()
    {
    }
}
