<?php
/**
 * Author: Evgeniy Tkachenko <et.coder@gmail.com>
 * 2018
 */

namespace githubjeka\enum\tests;

use githubjeka\enum\BaseEnum;
use githubjeka\enum\BaseObjectEnum;
use githubjeka\enum\IEnum;
use githubjeka\enum\IObjectEnum;

class EnumTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider classesProvider
     * @param IEnum $enum
     * @param bool $modeString
     */
    public function testKeys(IEnum $enum, bool $modeString)
    {
        if ($modeString) {

            foreach ($enum::getKeys() as $key) {
                $this->assertTrue(is_string($key));
                $this->assertFalse(is_integer($key));
            }

            $this->assertTrue('10' === $enum::ACTIVE);
            $this->assertTrue('20' === $enum::BANNED);
            $this->assertTrue(10 !== $enum::ACTIVE);
            $this->assertTrue(20 !== $enum::BANNED);
        } else {
            $this->assertEquals([10, 20], $enum::getKeys());
            $this->assertTrue('10' !== $enum::ACTIVE);
            $this->assertTrue('20' !== $enum::BANNED);
            $this->assertTrue(10 === $enum::ACTIVE);
            $this->assertTrue(20 === $enum::BANNED);
        }
    }

    /**
     * @dataProvider classesProvider
     * @param IEnum $enum
     * @param $modeString
     */
    public function testIssetValue(IEnum $enum, $modeString)
    {
        $this->assertTrue($enum::isValid($enum::ACTIVE));
        $this->assertTrue($enum::isValid($enum::BANNED));

        if ($modeString) {
            $this->assertTrue($enum::isValid('10'));
            $this->assertTrue($enum::isValid('20'));
            $this->assertFalse($enum::isValid(10));
            $this->assertFalse($enum::isValid(20));
        } else {
            $this->assertFalse($enum::isValid('10'));
            $this->assertFalse($enum::isValid('20'));
            $this->assertTrue($enum::isValid(10));
            $this->assertTrue($enum::isValid(20));
        }
    }

    /**
     * @dataProvider classesProvider
     * @param IEnum $enum
     * @param $mode
     */
    public function testLabels(IEnum $enum, $mode)
    {
        $this->assertEquals('Active', $enum::getLabel($enum::ACTIVE));
        $this->assertEquals('Banned', $enum::getLabel($enum::BANNED));
    }

    /**
     * @dataProvider classesProvider
     * @param IEnum $enum
     * @param $modeString
     */
    public function testWrongValueForLabel(IEnum $enum, $modeString)
    {
        $this->expectException(\InvalidArgumentException::class);
        if ($modeString) {
            $enum::getLabel(10);
            $enum::getLabel(20);
        } else {
            $enum::getLabel('10');
            $enum::getLabel('20');
        }
    }

    /**
     * @dataProvider objectsProvider
     * @param BaseObjectEnum $enum
     * @param $key
     */
    public function testEnumObjects($enum, $key)
    {
        $this->assertInstanceOf(Status::class, $enum);
        $this->assertInstanceOf(BaseObjectEnum::class, $enum);
        $this->assertInstanceOf(BaseEnum::class, $enum);
        $this->assertInstanceOf(IEnum::class, $enum);
        $this->assertSame($key, $enum->asKey());
        $this->assertSame($key, (string)$enum);
        $this->assertSame(Status::getLabel($key), $enum->asLabel());
        $this->assertTrue($enum->equals($enum));
    }

    /**
     * @return array
     */
    public function objectsProvider()
    {
        return [
            [new Status(Status::DEFAULT), Status::DEFAULT],
            [new Status(Status::ACTIVE), Status::ACTIVE],
        ];
    }

    /**
     * @return array
     */
    public function classesProvider()
    {
        return [
            [
                new class() extends BaseEnum {
                    const ACTIVE = '10';
                    const BANNED = '20';

                    public static function getList(): array
                    {
                        return [
                            self::ACTIVE => 'Active',
                            self::BANNED => 'Banned',
                        ];
                    }
                },
                true,
            ],
            [
                new class extends BaseEnum {
                    protected static $stringMode = false;
                    const ACTIVE = 10;
                    const BANNED = 20;

                    public static function getList(): array
                    {
                        return [
                            self::ACTIVE => 'Active',
                            self::BANNED => 'Banned',
                        ];
                    }
                },
                false,
            ],
        ];
    }
}


final class Status extends BaseObjectEnum implements IObjectEnum
{
    const ACTIVE = 'a';
    const BANNED = 'b';
    const DEFAULT = 'd';

    public static function getList(): array
    {
        return [
            self::ACTIVE => 'active',
            self::DEFAULT => 'default',
            self::BANNED => 'banned',
        ];
    }
}
