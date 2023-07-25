<?php
use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of atleast 7 characters';
}

if (!empty($errors)) {
    return view("registration/create.view.php", [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

// check if email is already present in the database
$query = "select * from users where email = :email";
$user = $db->query($query, [
    'email' => $email
])->find();

if ($user) {

    // if user is already registered/present in database
    login($user);
    header('location: /'); // Can redirect elsewhere if needed
    exit;
} else {

    // if user is not registered, insert into database
    $query = "insert into users(email, password) values(:email, :password)";
    $db->query($query, [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    login([
        'email' => $email
    ]);

    header('location: /');
    exit;

}

?>
