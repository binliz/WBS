<?php


abstract class Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     * @throws \RuntimeException
     */
    public static function getFacadeAccessor()
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    public static function getService()
    {
        return \Phalcon\Di::getDefault()->get(static::getFacadeAccessor());
    }

    public static function __callStatic($method, $args)
    {
        $instance = static::getService();

        if (!$instance) {
            throw new RuntimeException('A facade root has not been set.');
        }

        switch (count($args)) {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array([$instance, $method], $args);
        }
    }
}