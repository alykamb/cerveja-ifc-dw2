<?php
require_once("src/main.php");

if (sizeOf($path)) {
    $page = "{$path[0]}Page";
    if (function_exists($page)) {
        $page();
    } else {
        echo create404Page();
    }
} else {
    home_page();
}
