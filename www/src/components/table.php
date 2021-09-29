<?php

function c_table_item($data, $item, $editar, $excluir)
{

?>
    <tr>

        <?php
        foreach ($data as $key => $prop) {
            echo "<td>$item[$key]</td>";
        }
        ?>
        <td>
            <a href="<?= $editar($item['id']) ?>">editar</a>
            <a href="<?= $excluir($item['id']) ?>">excluir</a>
        </td>
    </tr>

<?php
}

function c_table($novo, $items, $data, $editar,  $excluir)
{
?>
    <div>
        <a href="<?= $novo ?>">Adicionar novo</a>
    </div>
    <table>
        <tr>
            <?php
            foreach ($data as $prop) {
                echo "<th>$prop->name</th>";
            }
            ?>
            <th>
                Ações
            </th>
        </tr>
        <?php
        foreach ($items as $key => $item) {
            echo c_table_item($data, $item, $editar, $excluir);
        }
        ?>
    </table>
<?php
}
