<?php

function cervejariasPage()
{
    $GLOBALS['title'] = "Cervejarias";

    $var = 'cervejarias';
    $data = new Cervejaria();

    tablePage($var, $data);
}
