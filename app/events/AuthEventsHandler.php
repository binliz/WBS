<?php


class AuthEventsHandler
{
    public function login($event,Users $user)
    {
        (new IsLoginValidator())->registerSession($user);
    }

    public function logout($event)
    {
        (new IsLoginValidator())->destroySession();
    }

}