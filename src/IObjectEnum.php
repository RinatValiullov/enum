<?php
/**
 * Author: Evgeniy Tkachenko <et.coder@gmail.com>
 */

namespace githubjeka\enum;

interface IObjectEnum extends IEnum
{
    public function asKey();

    public function asLabel(): string;

    public function equals(IObjectEnum $enum): bool;
}
