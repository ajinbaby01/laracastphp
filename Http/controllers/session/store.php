<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$loginForm = new LoginForm();

if ($loginForm->validate($email, $password)) {
    $auth = new Authenticator();

    if ($auth->attempt($email, $password)) {
        redirect('/');
    }

    $loginForm->setErrors('password', 'Account with that email address and password is not found');

}

Session::flash('errors', $loginForm->getErrors());
redirect('/login');

// return view("session/create.view.php", [
//     'errors' => $loginForm->getErrors()
// ]);

?>
