<?php

function create404Page()
{
    http_response_code(404);
    $GLOBALS['title'] = "Não encontrado";
?>
    <!DOCTYPE html>
    <html lang="en">
    <?= c_head(); ?>


    <body>
        <?= c_header(); ?>
        <div>
            <h2>O recurso que você está procurando não existe, use o menu acima para acessar os recursos do sistema</h2>
        </div>
    </body>

    </html>
<?php
}
