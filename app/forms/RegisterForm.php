<?php

use \Phalcon\Forms\Element\Text;
use \Phalcon\Forms\Element\Email;
use \Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
class RegisterForm extends \Phalcon\Forms\Form
{
    public function initialize()
    {
        $this->setEntity($this);


        $name = new Text('name', ['class' => 'form-control']);

        $email = new Email('email', ['class' => 'form-control']);

        $password = new Password('password', ['class' => 'form-control']);
        $confirm_password = new Password('confirm_password', ['class' => 'form-control']);


        $this->add($name);
        $this->add($email);
        $this->add($password);
        $this->add($confirm_password);


        $name->addValidators([
                new PresenceOf(
                    [
                        'message' => 'The name is required',
                    ]
                ),
                new StringLength(
                    [
                        "max" => 50,
                        "min" => 3,
                    ]
                ),
            ]
        );
        $email->addValidators([
                new PresenceOf(
                    [
                        'message' => 'The email is required',
                    ]
                ),
                new Uniqueness([
                    'model'   => new Users(),
                    'message' => 'You can`t set this email',
                ])
            ]
        );
        $password->addValidators([
            new PresenceOf(
                [
                    'message' => 'The password is required',
                ]
            ),
            new StringLength(
                [
                    "max" => 50,
                    "min" => 8,
                ]
            ),
            new Confirmation(
                [
                    "message" => "Password doesn't match confirmation",
                    "with"    => 'confirm_password',
                ]
            )
        ]);


    }

}