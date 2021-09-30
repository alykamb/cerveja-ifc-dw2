<?php

function createFormPage()
{
    global  $data, $new, $success, $status, $url, $beforeSave, $beforeRender, $action;

    if ($_POST['cadastrar']) {
        try {
            foreach ($data as $key => $prop) {
                if ($key == 'id') {
                    continue;
                }
                $data->$key->value = $_POST[$key];
            }

            if (isset($beforeSave)) {
                $beforeSave($_POST);
            }

            $action($data);

            foreach ($data as $key => $prop) {
                $data->$key->value = $_POST[$key];
            }

            $status = 'success';
        } catch (Exception $e) {
            var_dump($e);
            $status = 'error';
        }
    }

    if (isset($beforeRender)) {
        $beforeRender($_POST);
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <?= c_head(); ?>


    <body>
        <?= c_header(); ?>
        <?php
        if ($status == 'success') {
        ?>
            <div><b><?= $success($data) ?></b></div>
        <?php
        } else {
            echo createFormForInstance($new, $url, $data);
        }
        ?>
    </body>

    </html>
<?php
}
