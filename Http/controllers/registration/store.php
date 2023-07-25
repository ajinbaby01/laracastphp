<?php

use Core\Authenticator;
use Http\Forms\RegisterForm;

$email = $_POST['email'];
$password = $_POST['password'];

$registerForm = new RegisterForm();
if (!$registerForm->validate($email, $password)) {
    return view("registration/create.view.php", [
        'errors' => $registerForm->getErrors()
    ]);
}

$auth = new Authenticator();
if ($auth->attempt($email, $password)) {
    // check if user is already in the database
    redirect('/');
}
else {
    // user is not in database. insert user into database
    $registerForm->insert($email, $password);
    redirect('/');
}

?>
