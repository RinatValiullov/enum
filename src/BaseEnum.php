<?php
/**
 * Author: Evgeniy Tkachenko <et.coder@gmail.com>
 */

namespace githubjeka\enum;

abstract class BaseEnum implements IEnum
{
    protected static $stringMode = true;

    /**
     * @inheritdoc
     */
    final public static function getLabel($value): string
    {
        $list = static::getList();

        if (!static::isValid($value)) {
            throw new \InvalidArgumentException('value not valid');
        }

        return $list[$value];
    }

    /**
     * @inheritdoc
     */
    final public static function getKeys(): array
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
    final public static function isValid($value): bool
    {
        return in_array($value, static::getKeys(), true);
    }
}