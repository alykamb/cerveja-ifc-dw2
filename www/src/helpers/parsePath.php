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

function str_replace_first($from, $to, $content)
{
    $from = '/' . preg_quote($from, '/') . '/';

    return preg_replace($from, $to, $content, 1);
}
