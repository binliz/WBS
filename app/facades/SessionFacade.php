<?php

class SessionFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'session';
    }

}