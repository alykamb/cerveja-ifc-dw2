<?php

function createFormPage($data, $new, $success, $status, $beforeSave, $beforeRender, $action)
{
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

    foreach ($data as $key => $prop) {
        if (isset($_GET[$key]) && $_GET[$key] != NULL) {
            $data->$key->value = $_GET[$key];
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
            <div class="success"><b><?= $success($data) ?></b></div>
        <?php
        } else {
            echo createFormForInstance($new, $data);
        }
        ?>
    </body>

    </html>
<?php
}
