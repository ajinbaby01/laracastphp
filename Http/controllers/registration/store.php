<?php

use Core\Session;
use Http\Forms\RegisterForm;

$email = $_POST['email'];
$password = $_POST['password'];

$registerForm = new RegisterForm();
if ($registerForm->validate($email, $password)) { // check if entered email and password is valid
    if (!$registerForm->check($email)) { // check if user is already in the database

        // user is not present in database
        $registerForm->insert($email, $password);
        redirect('/');
    }

    // user is already registered
    $registerForm->setErrors('email', 'Email address is already registered. Please login.');
}

Session::flash('old', [
    'email' => $email
]);

Session::flash('errors', $registerForm->getErrors());

redirect('/register');

// return view("registration/create.view.php", [
//     'errors' => $registerForm->getErrors()
// ]);

?>
