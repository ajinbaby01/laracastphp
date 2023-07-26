<?php
use Core\Session;

// This controller is responsible for showing the 'Create a Note' page

view('notes/create.view.php', [
    'heading' => 'Create a Note',
    'errors' => Session::get('errors')
]);
