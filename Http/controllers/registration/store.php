<?php

use Core\Authenticator;
use Http\Forms\RegisterForm;

$email = $_POST['email'];
$password = $_POST['password'];

$registerForm = new RegisterForm();
if ($registerForm->validate($email, $password)) {
    // check if entered email and password is valid
    $auth = new Authenticator();
    if (!$auth->attempt($email, $password)) {
        // check if user is already in the database
        $registerForm->insert($email, $password);
    }
    redirect('/');
} else {
    return view("registration/create.view.php", [
        'errors' => $registerForm->getErrors()
    ]);
}

?>
