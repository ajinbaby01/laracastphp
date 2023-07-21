<?php

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'Core/functions.php';

spl_autoload_register(function ($class) {
    require base_path("Core/{$class}.php");
});
// Loads classes automatically when required

require base_path('Core/router.php');

?>
