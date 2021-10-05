<?php
function cozinhasEditar()
{
    global $cozinhas, $path;
    $GLOBALS['title'] = "Editar Cozinha";

    $success = function ($d) {
        return "Cozinha {$d->nome->value} editada com sucesso";
    };
    $formHeader = "Editar cozinharia {$path[2]}";

    $data = new Cozinha();
    $status = 'input';
    $action = function ($data) use ($cozinhas) {
        ($cozinhas)->update($data->id->value, $data);
    };

    $c = $cozinhas->findById($_POST['id'] ? $_POST['id'] : $path[2]);

    foreach ($data as $key => $prop) {
        $data->$key->value = $c[$key];
    }

    createFormPage($data, $formHeader, $success, $status, NULL, NULL, $action);
}
function cozinhasAdicionar()
{
    global $cozinhas;
    $GLOBALS['title'] = "Nova Cozinha";

    $success = function ($d) {
        return "Cozinha {$d->nome->value} adicionada com sucesso";
    };
    $formHeader = 'Adicionar nova cozinharia';

    $data = new Cozinha();
    $status = 'input';
    $action = function ($data) use ($cozinhas) {
        ($cozinhas)->create($data);
    };

    createFormPage($data, $formHeader, $success, $status, NULL, NULL, $action);
}

function cozinhasPage()
{
    global $path, $cozinhas;
    $GLOBALS['title'] = "Cozinhas";

    $var = 'cozinhas';

    switch ($path[1]) {
        case 'novo':
            cozinhasAdicionar();
            break;
        case 'editar':
            cozinhasEditar();
            break;
        default:
            tablePage($var, function () use ($cozinhas) {
                return Cozinha::fromDataList($cozinhas->findAll(), true);
            });
    }
}
