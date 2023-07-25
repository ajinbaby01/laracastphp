<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm;
if (!$form->validate($email, $password)) {
    return view("session/create.view.php", [
        'errors' => $form->getErrors()
    ]);
}

$db = App::resolve(Database::class);

// check if email is already present in the database
$query = "select * from users where email = :email";
$user = $db->query($query, [
    'email' => $email
])->find();

if ($user) {
    // user is already registered and email exists in database
    if (password_verify($password, $user['password'])) {
        // check if password is correct and log in
        login($user);
        header('location: /');
        exit;
    }
}

return view('session/create.view.php', [
    'errors' => [
        'password' => "Account with that email address and password is not found"
    ]
]);

?>
