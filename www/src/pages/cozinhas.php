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
    global $cozinhas, $cozinha_cerveja;
    $GLOBALS['title'] = "Nova Cozinha";

    $success = function ($d) {
        return "Cozinha {$d->nome->value} adicionada com sucesso";
    };
    $formHeader = 'Adicionar nova cozinharia';

    $data = new Cozinha();
    $status = 'input';
    $action = function ($data) use ($cozinhas, $cozinha_cerveja) {
        $cozinha_nova = ($cozinhas)->create($data);
        if (isset($_GET['cerveja_id']) && $_GET['cerveja_id'] != NULL) {
            echo "here";
            $cozinha_cerveja->create(CozinhaCerveja::fromData([
                'cerveja_id' => $_GET['cerveja_id'],
                'cozinha_id' => $cozinha_nova['id'],
            ]));
        }
    };

    createFormPage($data, $formHeader, $success, $status, NULL, NULL, $action);
}

function cozinhasVer()
{
    global $path, $cozinhas;
    [, $id] = $path;

    $data = Cozinha::fromData($cozinhas->findById($id), true);
    $GLOBALS['title'] = "Cozinha - " . $data->nome->value;
?>

    <!DOCTYPE html>
    <html lang="en">
    <?= c_head(); ?>

    <body>
        <?= c_header(); ?>
        <div class="info">
            <div class="acoes">
                <a href="/cozinhas/excluir/<?= $data->id->value ?>">excluir</a>
                <a href="/cozinhas/editar/<?= $data->id->value ?>">editar</a>
            </div>
            <p><b>Nome: </b><?= $data->nome->value; ?></p>
            <p><small><b>Id:</b> <?= $data->id->value; ?></small></p>
            <p><b>Descrição</b>: <?= $data->descricao->value; ?></p>
        </div>
    </body>

    </html>
<?php
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
            if (is_numeric($path[1])) {
                cozinhasVer();
                return;
            }
            tablePage($var, function () use ($cozinhas) {
                return Cozinha::fromDataList($cozinhas->findAll(), true);
            });
    }
}
