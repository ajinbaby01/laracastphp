<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected $errors = [];
    public array $attributes;
    public function validate($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a valid password';
        }

        if(! empty($this->errors)) {
            $this->throw();
        }
    }

    public function throw(){
        ValidationException::throw($this->errors, $this->attributes);
    }

    public function setErrors($field, $message)
    {
        $this->errors[$field] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}

?>
