<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected $logedValidator = null;
    public function isLoggedIn(){
        if($this->logedValidator === null) {
            $this->logedValidator = new IsLoginValidator();
        }
        return $this->logedValidator->isValid();
    }
}
