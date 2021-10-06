<?php

function createForm($header, $contents)
{
    ob_start();
?>
    <div>
        <h3 class="text-lg font-medium leading-6 text-gray-900"><?= $header ?></h3>
        <form method="POST" autocomplete="off">
            <div class="form-input">
                <?= $contents ?>
            </div>
            <div class="form-actions">
                <input type="submit" value="Cadastrar" name="cadastrar" class="btn" />
            </div>
        </form>
    </div>
<?php
    $ret = ob_get_contents();
    ob_end_clean();
    return $ret;
}


function createInput($label, $id, $contents)
{
    ob_start();
?>
    <div class="form-group">
        <label for="<?= $id ?>"><?= $label ?></label>
        <div>
            <?= $contents ?>
        </div>
    </div>
<?php
    $ret = ob_get_contents();
    ob_end_clean();
    return $ret;
}

function createInputForField(Field $field, string $id)
{
    [$dataType, $fieldType] = explode(":", $field->type);
    if (isset($field->options) && $field->options != NULL) {
        $options = $field->options;
        if ($fieldType == 'select') {
            $ret = "<select name=\"$id\" id=\"$id\" value=\"{$field->value}\">
            <option value=\"\"></option>";
            foreach ($options as $option) {
                $s = $field->value && $field->value == $option["value"] ? "selected=\"selected\"" : "";
                $o = "<option value=\"{$option["value"]}\" {$s}>{$option["label"]}</option>";
                $ret .= $o;
            }
            $ret .= "</select>";
            return $ret;
        }
    }
    if ($fieldType == "textarea") {
        return "<textarea name=\"$id\" id=\"$id\" cols=\"30\" rows=\"10\">$field->value</textarea>";
    }
    return "<input type=\"$fieldType\" name=\"$id\" id=\"$id\" value=\"$field->value\"class=\"focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md\">";
}

function createInputsForFileds($data)
{
    $contents = '';
    foreach ($data as $id => $field) {
        if ($field->show == "table") {
            $contents .= "<input type=\"hidden\" name=\"$id\" id=\"$id\" value=\"$field->value\"class=\"focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md\">";
            continue;
        }
        $contents .= createInput($field->name, $id, createInputForField($field, $id));
    }
    return $contents;
}

function createFormForInstance($header, $data, $extras = '')
{
    $contents = createInputsForFileds($data);
    return createForm($header, $contents . $extras);
}

?>