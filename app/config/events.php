<?php
$em = new \Phalcon\Events\Manager;

$em->attach('auth',new AuthEventsHandler());
return $em;