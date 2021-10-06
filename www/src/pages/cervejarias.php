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

function cervejariasVer()
{
    global $path, $cervejarias, $cervejas;
    [, $id] = $path;

    $data = Cervejaria::fromData($cervejarias->findById($id), true);
    $GLOBALS['title'] = "Cervejaria - " . $data->nome->value;;

    $cervejas_list = Cerveja::fromDataList($cervejas->findAll("WHERE cervejaria_id = {$data->id->value}"));
?>

    <!DOCTYPE html>
    <html lang="en">
    <?= c_head(); ?>

    <body>
        <?= c_header(); ?>
        <div class="info">
            <div class="acoes">
                <a href="/cervejarias/excluir/<?= $data->id->value ?>">excluir</a>
                <a href="/cervejarias/editar/<?= $data->id->value ?>">editar</a>
            </div>
            <p><b>Nome: </b><?= $data->nome->value; ?></p>
            <p><small><b>Id:</b> <?= $data->id->value; ?></small></p>
            <hr>
            <p><b>Logradouro</b>: <?= $data->endereco->logradouro->value; ?></p>
            <p><b>Estado</b>: <?= $data->endereco->estado->value; ?></p>
            <p><b>Cidade</b>: <?= $data->endereco->cidade->value; ?></p>
            <p><b>Cep</b>: <?= $data->endereco->cep->value; ?></p>
            <div class="cervejas">
                <h2>Cervejas</h2>
                <a href="/cervejas/novo?cervejaria_id=<?= $id ?>">Adicionar Cerveja</a>
                <?php
                if (sizeof($cervejas_list) == 0) {
                ?>
                    <p><i>Nenhuma cerveja cadastrada</i></p>
                    <?php
                } else {

                    foreach ($cervejas_list as $cerveja) {
                    ?>
                        <p><a href="/cervejas/<?= $cerveja->id->value ?>"><?= $cerveja->nome->value ?></a></p>
                <?php
                    }
                }
                ?>

            </div>
        </div>


        <?php
        ?>
    </body>

    </html>
<?php
}

function cervejariasPage()
{
    global $path, $cervejarias;
    $GLOBALS['title'] = "Cervejarias";

    switch ($path[1]) {
        case 'novo':
            cervejariasAdicionar();
            break;
        case 'editar':
            cervejariasEditar();
            break;
        default:
            if (is_numeric($path[1])) {
                cervejariasVer();
                return;
            }
            tablePage('cervejarias', function () use ($cervejarias) {
                return Cervejaria::fromDataList($cervejarias->findAll(), true);
            });
    }
}
