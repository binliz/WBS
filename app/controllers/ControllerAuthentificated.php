<?php
declare(strict_types=1);

class ControllerAuthentificated extends ControllerBase
{
    public $excludeActions =[];
    public function beforeExecuteRoute() {
        if(!in_array($this->dispatcher->getActionName(),$this->getExcludeActions()) ){
            if(!$this->isLoggedIn()){
                $this->response->redirect(['for'=>'login']);
            }
        }
        return true;
    }
    /**
     * @return array
     */
    public function getExcludeActions(): array
    {
        return $this->excludeActions;
    }

}
