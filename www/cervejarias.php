<?php
require_once("src/main.php");
$GLOBALS['title'] = "Cervejarias";

$var = 'cervejarias';
$success = 'Cervejaria adicionada com sucesso';

if ($_GET['excluir']) {
    $$var->remove(intval($_GET['excluir']));
}
$items = $$var->findAll();
$data = new Cervejaria();
$editar = function ($id) use ($var) {
    return "/$var/editar.php?id=$id";
};

$excluir = function ($id) use ($var) {
    return "/$var.php?excluir=$id";
};
?>

<!DOCTYPE html>
<html lang="en">
<?= c_head(); ?>

<body>
    <?= c_header(); ?>
    <?= c_table(
        "/$var/novo.php",
        $items,
        $data,
        $editar,
        $excluir
    ); ?>
</body>

</html>