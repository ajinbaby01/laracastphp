<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if (!$form->validate($email, $password)) {
    return view("session/create.view.php", [
        'errors' => $form->getErrors()
    ]);
}

$auth = new Authenticator();
if ($auth->attempt($email, $password)) {
    redirect('/');
} else {
    return view('session/create.view.php', [
        'errors' => [
            'password' => "Account with that email address and password is not found"
        ]
    ]);
}

?>
