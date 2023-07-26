<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$loginForm = new LoginForm();

$loginForm->validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt(
    $attributes['email'], $attributes['password']
);

if (!$signedIn) {
    $loginForm->setErrors('password', 'Account with that email address and password is not found');
    $loginForm->throw();
}

redirect('/');

// return view("session/create.view.php", [
//     'errors' => $loginForm->getErrors()
// ]);
// This method submitted form twice when refreshing. Better to redirect.

?>
