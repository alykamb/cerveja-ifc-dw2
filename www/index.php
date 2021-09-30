<?php
require_once("src/main.php");


if (sizeOf($path)) {
    $page = "{$path[0]}Page";
    $page();
} else {
    home_page();
}
