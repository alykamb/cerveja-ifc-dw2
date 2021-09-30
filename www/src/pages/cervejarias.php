<?php
function cervejariasEditar()
{
    global $cervejarias, $enderecos, $path;
    $GLOBALS['title'] = "Editar Cervejaria";

    $success = function ($d) {
        return "Cervejaria {$d->nome->value} editada com sucesso";
    };
    $formHeader = "Editar cervejaria {$path[2]}";

    $data = new Cervejaria();
    $data_end = new Endereco();
    $status = 'input';
    $action = function ($data) use ($cervejarias) {
        ($cervejarias)->create($data);
    };

    $c = $cervejarias->findById($_POST['id'] ? $_POST['id'] : $path[2]);
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
            $data_end->$key->value = $post[$key];
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

    createFormPage($data, $formHeader, $success, $status, $beforeSave, $beforeRender, $action);
}
function cervejariasAdicionar()
{
    global $cervejarias, $enderecos;
    $GLOBALS['title'] = "Nova Cervejaria";

    $success = function ($d) {
        return "Cervejaria {$d->nome->value} adicionada com sucesso";
    };
    $formHeader = 'Adicionar nova cervejaria';

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

    createFormPage($data, $formHeader, $success, $status, $beforeSave, $beforeRender, $action);
}

function cervejariasPage()
{
    global $path;
    $GLOBALS['title'] = "Cervejarias";

    $var = 'cervejarias';
    $data = new Cervejaria();

    switch ($path[1]) {
        case 'novo':
            cervejariasAdicionar();
            break;
        case 'editar':
            cervejariasEditar();
            break;
        default:
            tablePage($var, $data);
    }
}
