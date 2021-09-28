<?php
$minLength = function (int $size = 3): Closure {
    return function ($value) use (&$size) {
        return strlen($value) > $size;
    };
};
