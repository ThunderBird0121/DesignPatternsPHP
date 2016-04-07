<?php

namespace DesignPatterns\Structural\Flyweight;

use DesignPatterns\Structural\Flyweight\CharacterFlyweight;

/**
 * A factory manages shared flyweights. Clients shouldn't instaniate them directly,
 * but let the factory take care of returning existing objects or creating new ones.
 */
class FlyweightFactory
{
    /**
     * Associative store for flyweight objects
     * @var Array
     */
    private $pool = array();

    /**
     * Magic getter
     * @param string $name
     * @return Flyweight
     */
    public function __get($name)
    {
        if (!array_key_exists($name, $this->pool)) {
            $this->pool[$name] = new CharacterFlyweight($name);
        }
        return $this->pool[$name];
    }

    public function totalNumber()
    {
        return sizeof($this->pool);
    }
}
