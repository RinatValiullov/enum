<?php
/**
 * Author: Evgeniy Tkachenko <et.coder@gmail.com>
 * 2018
 */
namespace githubjeka\enum;

interface IEnum
{
    /**
     * Should return an array of value enum and description:
     * keys of the array are values enum.
     * values of the array are descriptions
     */
    public static function getList(): array;

    /**
     * Should return values enum
     */
    public static function getKeys(): array;

    /**
     * Should return a description enum by value enum
     * @param $value integer|string
     * @return mixed
     * @throw \InvalidArgumentException if $value is wrong
     */
    public static function getLabel($value);

    /**
     * Allows to avoid \InvalidArgumentException and similar
     * @param $value
     * @return bool
     */
    public static function isValid($value): bool;
}
