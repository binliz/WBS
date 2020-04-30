<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{
    // Implement common logic
    public function initialize()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);
    }

    public function indexAction()
    {

    }


}

