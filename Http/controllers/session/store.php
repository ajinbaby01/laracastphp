<?php
use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a valid password';
}

if (!empty($errors)) {
    return view("session/create.view.php", [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

// check if email is already present in the database
$query = "select * from users where email = :email";
$user = $db->query($query, [
    'email' => $email
])->find();

if($user) {
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
