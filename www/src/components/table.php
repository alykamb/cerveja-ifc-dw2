<?php

function c_table_item($item, $keys, $editar, $excluir, $ver)
{
?>
    <tr>

        <?php
        foreach ($keys as $key) {
            echo "<td>{$item[$key]}</td>";
        }
        ?>
        <td>
            <a href="<?= $editar($item['id']) ?>">editar</a>
            <a href="<?= $excluir($item['id']) ?>">excluir</a>
            <a href="<?= $ver($item['id']) ?>">ver</a>
        </td>
    </tr>

<?php
}

function c_table($novo, $items, $editar,  $excluir, $ver)
{
?>
    <div>
        <a href="<?= $novo ?>">Adicionar novo</a>
    </div>
    <?php
    if (sizeOf($items) <= 0) {
        echo 'Nenhum item cadastrado';
    } else {
        $headers = $items[0]->getHeaders();
    ?>
        <table>
            <tr>
                <?php
                foreach ($headers as $header) {
                    echo "<th>$header</th>";
                }
                ?>
                <th>
                    Ações
                </th>
            </tr>
            <?php
            foreach ($items as $item) {
                echo c_table_item($item->getValues(), array_keys($headers), $editar, $excluir, $ver);
            }
            ?>
        </table>
<?php
    }
}
