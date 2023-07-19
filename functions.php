<?php

function isUrl($value){
    return parse_url($_SERVER['REQUEST_URI'])['path'] == $value;
}
?>
