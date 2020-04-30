<?php


class IsLoginValidator
{
    /**
     * @var string
     */
    private $redirectUrl;
    /**
     * @var string[]
     */
    private $excludedRoutes;

    public function isValid()
    {
        if(SessionFacade::has('auth')) return true;
        return false;
    }

    public function registerSession(Users $user)
    {
        SessionFacade::set('auth',['id'=>$user->id,'name'=>$user->name]);
    }

    public function destroySession()
    {
        SessionFacade::remove('auth');
    }

}