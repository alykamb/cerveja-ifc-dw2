<?php
function cervejasEditar()
{
    global $cervejas, $path;
    $GLOBALS['title'] = "Editar Cerveja";

    $success = function ($d) {
        return "Cerveja {$d->nome->value} editada com sucesso";
    };
    $formHeader = "Editar cervejaria {$path[2]}";

    $data = new Cerveja();
    $status = 'input';
    $action = function ($data) use ($cervejas) {
        ($cervejas)->update($data->id->value, $data);
    };

    $c = $cervejas->findById($_POST['id'] ? $_POST['id'] : $path[2]);

    foreach ($data as $key => $prop) {
        $data->$key->value = $c[$key];
    }

    createFormPage($data, $formHeader, $success, $status, NULL, NULL, $action);
}
function cervejasAdicionar()
{
    global $cervejas;
    $GLOBALS['title'] = "Nova Cerveja";

    $success = function ($d) {
        return "Cerveja {$d->nome->value} adicionada com sucesso";
    };
    $formHeader = 'Adicionar nova cervejaria';

    $data = new Cerveja();
    $status = 'input';
    $action = function ($data) use ($cervejas) {
        ($cervejas)->create($data);
    };

    createFormPage($data, $formHeader, $success, $status, NULL, NULL, $action);
}

function cervejasPage()
{
    global $path, $cervejas;
    $GLOBALS['title'] = "Cervejas";

    $var = 'cervejas';

    switch ($path[1]) {
        case 'novo':
            cervejasAdicionar();
            break;
        case 'editar':
            cervejasEditar();
            break;
        default:
            tablePage($var, function () use ($cervejas) {
                return Cerveja::fromDataList($cervejas->findAll(), true);
            });
    }
}
