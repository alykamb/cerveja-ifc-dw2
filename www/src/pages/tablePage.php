<?php

function tablePage($var, $getItems)
{
    global $$var, $path;

    $success = '';
    if (isset($path[2]) && $path[1] == "excluir") {
        $success = "<p>Item {$path[2]} removido com sucesso</p>";
        $$var->remove(intval($path[2]));
    }

    $items = $getItems();

    $editar = function ($id) use ($var) {
        return "/$var/editar/$id";
    };

    $excluir = function ($id) use ($var) {
        return "/$var/excluir/$id";
    };

    $ver = function ($id) use ($var) {
        return "/$var/$id";
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
            $editar,
            $excluir,
            $ver
        );
        ?>
    </body>

    </html>

<?php
}
