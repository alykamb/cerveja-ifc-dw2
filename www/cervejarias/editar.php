<?php
require_once("../src/main.php");
$GLOBALS['title'] = "Nova Cervejaria";

$var = 'cervejarias';
$success = 'Cervejaria editada com sucesso';
$new = 'Adicionar nova cervejaria';

$data = new Cervejaria();
$data_end = new Endereco();
$status = 'input';

$c = $cervejarias->findById($_GET['id']);
$e = $enderecos->findById($c['endereco_id']);


foreach ($data as $key => $prop) {
    $data->$key->value = $c[$key];
}

foreach ($data_end as $key => $prop) {
    $data_end->$key->value = $e[$key];
}

if ($_POST['cadastrar']) {
    try {
        foreach ($data as $key => $prop) {
            if ($key == 'id') {
                continue;
            }
            $data->$key->value = $_POST[$key];
        }

        foreach ($data_end as $key => $prop) {
            if ($key == 'id') {
                $data_end->$key->value = $c['endereco_id'];
                continue;
            }
            $data_end->$key->value = $_POST[$key];
        }

        $data->endereco_id->value = $e['id'];

        $enderecos->update(intval($c['endereco_id']), $data_end);
        $cervejarias->update(intval($data->id->value), $data);

        $status = 'success';
    } catch (Exception $e) {
        var_dump($e);
        $status = 'error';
    }
}

foreach ($data as $key => $prop) {
    $data->$key->value = $_POST[$key];
}


?>

<!DOCTYPE html>
<html lang="en">
<?= c_head(); ?>


<body>
    <?= c_header(); ?>
    <?php
    if ($status == 'success') {
        foreach ($data_end as $key => $prop) {
            $data->$key = $prop;
        }
    ?>
        <div><b>Cervejaria <?= $data->nome->value ?> adicionada com sucesso!</b></div>
    <?php
    } else {
        foreach ($data_end as $key => $prop) {
            if ($key == 'id') {
                continue;
            }
            $data->$key = $prop;
        }
        echo createFormForInstance('Adicionar nova cervejaria', "/cervejarias/editar.php?id={$_GET['id']}", $data);
    }
    ?>


</body>

</html>