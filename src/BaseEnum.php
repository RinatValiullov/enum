<?php
/**
 * Author: Evgeniy Tkachenko <et.coder@gmail.com>
 * 2018
 */

namespace githubjeka\enum;

abstract class BaseEnum implements IEnum
{
    protected static $exceptionClass = \InvalidArgumentException::class;
    protected static $stringMode = true;

    /**
     * @inheritdoc
     */
    abstract public static function getList(): array;

    /**
     * @inheritdoc
     */
    public static function getLabel($value): string
    {
        $list = static::getList();

        if (!static::isValid($value)) {
            throw new static::$exceptionClass;
        }

        return $list[$value];
    }

    /**
     * @inheritdoc
     */
    public static function getKeys(): array
    {
        $keys = [];
        foreach (static::getList() as $key => $value) {
            if (static::$stringMode) {
                $keys[] = (string)$key;
            } else {
                $keys[] = (integer)$key;
            }

        }
        return $keys;
    }

    /**
     * @inheritdoc
     */
    public static function isValid($value): bool
    {
        return in_array($value, static::getKeys(), true);
    }
}