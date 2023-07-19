<?php

function isUrl($value)
{
    return parse_url($_SERVER['REQUEST_URI'])['path'] == $value;
}

function dd($array)
{
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
    exit;
}
?>
