<?php

namespace Http\Forms;

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;

class RegisterForm
{
    protected $errors = [];
    public function validate($email, $password)
    {
        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validator::string($password, 7, 255)) {
            $this->errors['password'] = 'Please provide a password of atleast 7 characters';
        }
        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($field, $message)
    {
        $this->errors[$field] = $message;
    }

    public function check($email)
    { // check if user email is already registered with the website
        $db = App::resolve(Database::class);

        $query = "select * from users where email = :email";
        $user = $db->query($query, [
            'email' => $email
        ])->find();

        if ($user) {
            // user is already registered and email exists in database
            return true;
        }

        return false;
    }

    public function insert($email, $password)
    {
        $db = App::resolve('Core\Database');
        $query = "insert into users(email, password) values(:email, :password)";
        $db->query($query, [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        Authenticator::login([
            'email' => $email
        ]);
    }
}

?>
