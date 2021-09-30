<?php

$GLOBALS['title'] = "Nova Cervejaria";

$var = 'cervejarias';
$success = function ($d) {
    return "Cervejaria {$d->nome->value} adicionada com sucesso";
};
$new = 'Adicionar nova cervejaria';

$data = new Cervejaria();
$data_end = new Endereco();
$status = 'input';
$action = function ($data) use ($cervejarias) {
    ($cervejarias)->create($data);
};

$beforeSave = function ($post) use ($data_end, $enderecos, $data) {
    foreach ($data_end as $key => $prop) {
        $data_end->$key->value = $post[$key];
    }

    $new_end = $enderecos->create($data_end);
    $data->endereco_id->value = $new_end['id'];
};

$beforeRender = function () use ($data_end, $data) {
    foreach ($data_end as $key => $prop) {
        if ($key == 'id') {
            continue;
        }
        $data->$key = $prop;
    }
};

createFormPage();
