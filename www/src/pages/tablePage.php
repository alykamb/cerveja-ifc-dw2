<?php

function tablePage($var, $data)
{
    global $$var, $path;

    $success = '';
    if (isset($path[2]) && $path[1] == "excluir") {
        $success = "<p>Item {$path[2]} removido com sucesso</p>";
        $$var->remove(intval($path[2]));
    }

    $items = [];

    foreach ($$var->findAll() as $key => $item) {
        $items[] = $item;
    }

    $editar = function ($id) use ($var) {
        return "/$var/editar/$id";
    };

    $excluir = function ($id) use ($var) {
        return "/$var/excluir/$id";
    };
?>
    <!DOCTYPE html>
    <html lang="en">
    <?= c_head(); ?>

    <body>
        <?= c_header(); ?>
        <?= $success ?>
        <?= c_table(
            "/$var/novo",
            $items,
            $data,
            $editar,
            $excluir
        ); ?>
    </body>

    </html>

<?php
}
