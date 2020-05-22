<?php


namespace utilities\SimpleList;

use ArrayAccess;
use Countable;
use Iterator;

/**
 * Class SimpleList
 * @package utilities\SimpleList
 */
class SimpleList implements Countable, ArrayAccess, Iterator
{
    private array $container = [];
    private int $position = 0;

    public function __construct(array $elements = [])
    {
        $this->container = $elements;
    }

    public function current()
    {
        return $this->container[$this->position];
    }

    public function next()
    {
        $this->position++;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->container[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->container[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        }
        else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    public function count()
    {
        return sizeof($this->container);
    }

}