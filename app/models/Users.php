<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Validation\Validator\StringLength as StringLengthValidator;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $active;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();
        $validator->add(
            'email',
            new UniquenessValidator(
                [
                    'model'   => $this,
                    'message' => 'These email is registred',
                ]
            )
        );
        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );
        $validator->add(
            [
                "name",
                "email"
            ],
            new StringLengthValidator(
                [
                    "max"            => 50,
                    "min"            => 3,
                    "messageMaximum" => [
                        "We don't like really long names",
                        "We don't like really long emails",
                    ],
                    "messageMinimum" => [
                        "We want more than just their initials",
                        "Email name is very simple",
                    ]
                ]
            )
        );

        return $this->validate($validator);
    }

    public function checkHash($password)
    {
        return SecurityFacade::checkHash($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = SecurityFacade::hash($password);
        return $this;
    }

    /**
     * @param $email
     * @return Users
     */
    public static function findByEmail($email)
    {
        return static::query()
            ->where('email = :email:', ['email' => $email])
            ->execute()->getFirst();
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("school212");
        $this->setSource("users");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
