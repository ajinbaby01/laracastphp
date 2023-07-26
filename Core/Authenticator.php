<?php

namespace Core;
use Core\Session;

class Authenticator
{
    public function attempt($email, $password)
    { // attempts to check if user is present in database
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
                static::login($user);
                return true;
            }
        }

        return false;
    }

    public static function login($user)
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public static function logout()
    {
        Session::flush(); // clear the $_SESSION superglobal
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['http_only']);

    }
}

?>
