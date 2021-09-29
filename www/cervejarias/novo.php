<?php
require_once("../src/main.php");
$GLOBALS['title'] = "Nova Cervejaria";

$var = 'cervejarias';
$success = 'Cervejaria adicionada com sucesso';
$new = 'Adicionar nova cervejaria';

$data = new Cervejaria();
$data_end = new Endereco();
$status = 'input';

if ($_POST['cadastrar']) {
    try {
        foreach ($data as $key => $prop) {
            $data->$key->value = $_POST[$key];
        }

        foreach ($data_end as $key => $prop) {
            $data_end->$key->value = $_POST[$key];
        }
        var_dump($data);
        $new_end = $enderecos->create($data_end);
        $data->endereco_id->value = $new_end['id'];
        $cervejarias->create($data);

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
            $data->$key = $prop;
        }
        echo createFormForInstance('Adicionar nova cervejaria', '/cervejarias/novo.php', $data);
    }
    ?>


</body>

</html>