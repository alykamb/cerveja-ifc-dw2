<?php

function parsePath()
{
    $path = [];

    foreach (explode('/', $_GET['path']) as $section) {
        if (strlen($section) === 0) continue;
        $path[] = $section;
    }

    return $path;
}
