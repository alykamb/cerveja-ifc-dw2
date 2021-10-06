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

function cervejasVer()
{
    global $path, $cervejas, $cozinhas, $cozinha_cerveja;
    [, $id] = $path;

    $data = Cerveja::fromData($cervejas->findById($id), true);
    $GLOBALS['title'] = "Cerveja - " . $data->nome->value;

    if ($_POST['atualizar-cozinhas']) {
        $c = $_POST['cozinhas'];
        $cozinha_cerveja->removeWhere("WHERE cerveja_id = $id");

        foreach ($c as $key) {
            $cozinha_cerveja->create(CozinhaCerveja::fromData(['cerveja_id' => $id, 'cozinha_id' => $key]));
        }
    }

    $cervejasCozinhas = $cozinha_cerveja->findAll("WHERE cerveja_id = $id");

?>

    <!DOCTYPE html>
    <html lang="en">
    <?= c_head(); ?>

    <body>
        <?= c_header(); ?>
        <div class="info">
            <div class="acoes">
                <a href="/cervejas/excluir/<?= $data->id->value ?>">excluir</a>
                <a href="/cervejas/editar/<?= $data->id->value ?>">editar</a>
            </div>
            <p><b>Nome: </b><?= $data->nome->value; ?></p>
            <p><small><b>Id:</b> <?= $data->id->value; ?></small></p>
            <p><b>Cervejaria: </b><a href="/cervejarias/<?= $data->cervejaria->id->value ?>"><?= $data->cervejaria->nome->value; ?></a></p>
            <br>
            <hr>
            <br>
            <div class="cozinhas">
                <a href="/cozinhas/novo?cerveja_id=<?= $id ?>">Adicionar nova cozinha</a>
                <?php
                if ($path[2] == 'editar-cozinhas') {
                    $cozinhas_list = Cozinha::fromDataList($cozinhas->findAll());
                    if (sizeof($cozinhas_list) == 0 || $cozinhas_list == NULL) {
                ?>
                        <p><i>Nenhuma cozinha cadastrada</i></p>
                    <?php
                    } else {
                    ?>
                        <form method="post" action>
                            <div class="cozinhas">
                                <?php
                                foreach ($cozinhas_list as $index => $cozinha) {
                                ?>
                                    <label for="<?= $index; ?>">
                                        <input type="checkbox" id="<?= $index; ?>" class="check" name="cozinhas[]" value="<?= $cozinha->id->value ?>" <?= array_search($cozinha->id->value, array_column($cervejasCozinhas, 'cozinha_id')) !== false ? 'checked="checked"' : '' ?>>
                                        <?= $cozinha->nome->value ?>
                                    </label><br>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="actions">
                                <a href="/cervejas/<?= $id ?>">cancelar</a>
                                <input type="submit" name="atualizar-cozinhas" value="Enviar">
                            </div>
                        </form>
                        <?php
                    }
                } else {
                    if (sizeof($cervejasCozinhas) == 0 || $cervejasCozinhas == NULL) {
                    } else {
                        $cozinhas_ids = implode(',', array_map(function ($c) {
                            return $c['cozinha_id'];
                        }, $cervejasCozinhas));



                        $cozinhas_list = Cozinha::fromDataList($cozinhas->findAll("WHERE id in ({$cozinhas_ids})"));

                        foreach ($cozinhas_list as $cozinha) {
                        ?>
                            <p><a href="/cozinhas/<?= $cozinha->id->value ?>"><b><?= $cozinha->id->value ?>: </b><?= $cozinha->nome->value ?></a></p>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                    <a href="/cervejas/<?= $id ?>/editar-cozinhas">Editar cozinhas</a>
                <?php } ?>
            </div>
        </div>
    </body>

    </html>
<?php
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
            if (is_numeric($path[1])) {
                cervejasVer();
                return;
            }
            tablePage($var, function () use ($cervejas) {
                return Cerveja::fromDataList($cervejas->findAll(), true);
            });
    }
}
