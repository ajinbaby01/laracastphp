<?php

namespace Http\Forms;

use Core\App;
use Core\Authenticator;
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

    public function insert($email, $password)
    {
        $query = "insert into users(email, password) values(:email, :password)";
        $db = App::resolve('Core\Database');
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
