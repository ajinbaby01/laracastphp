<?php

namespace Http\Forms;

use Core\App;
use Core\Authenticator;
use Core\Validator;

class CreateANoteForm
{
    protected $errors = [];
    public function validate($noteBody)
    {
        if (!Validator::string($_POST['body'], 1, 1000)) {
            $this->errors['body'] = 'A body of no more than 1000 characters is required';
        }

        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function insert($noteBody)
    {
        $db = App::resolve('Core\Database');
        $query = "insert into notes (body, user_id) values(:body, :user_id)";
        $db->query($query, [
            'body' => filter_var($noteBody, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'user_id' => 1
            // TODO => Make user_id dynamic
        ]);
    }
}

?>
