<?php


$GLOBALS['title'] = "Editar Cervejaria";

$url = $_SERVER['REQUEST_URI'];
$var = 'cervejarias';
$success = function ($d) {
    return "Cervejaria {$d->nome->value} editada com sucesso";
};
$new = 'Adicionar nova cervejaria';

$action = function ($data) use ($cervejarias) {
    ($cervejarias)->update(intval($data->id->value), $data);
};

$data = new Cervejaria();
$data_end = new Endereco();
$status = 'input';

$c = $cervejarias->findById($_POST['id'] ? $_POST['id'] : $_GET['id']);
$e = $enderecos->findById($c['endereco_id']);

foreach ($data as $key => $prop) {
    $data->$key->value = $c[$key];
}

foreach ($data_end as $key => $prop) {
    $data_end->$key->value = $e[$key];
}

$beforeSave = function ($post) use ($data_end, $c, $e, $data) {
    global $enderecos;

    $data->endereco_id->value = $e['id'];
    foreach ($data_end as $key => $prop) {
        if ($key == 'id') {
            $data_end->$key->value = $c['endereco_id'];
            continue;
        }
        $data_end->$key->value = $_POST[$key];
    }

    $data->endereco_id->value = $e['id'];
    $enderecos->update(intval($c['endereco_id']), $data_end);
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
