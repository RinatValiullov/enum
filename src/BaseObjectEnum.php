<?php
/**
 * Author: Evgeniy Tkachenko <et.coder@gmail.com>
 */

namespace githubjeka\enum;

abstract class BaseObjectEnum extends BaseEnum implements IObjectEnum
{
    private $currentKey;

    final public function __construct($key)
    {
        if (!static::isValid($key)) {
            throw new \InvalidArgumentException('key not valid');
        }
        $this->currentKey = $key;
    }

    final public function asKey()
    {
        return $this->currentKey;
    }

    final public function __toString()
    {
        return $this->asKey();
    }

    final public function asLabel(): string
    {
        return static::getLabel($this->currentKey);
    }

    final public function equals(IObjectEnum $object): bool
    {
        return $this instanceof $object && $this->asKey() === $object->asKey();
    }
}