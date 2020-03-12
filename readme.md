[![Build Status](https://travis-ci.com/githubjeka/enum.svg?branch=master)](https://travis-ci.com/githubjeka/enum)

## Usage ENUM
Simple and base functional to start using Enum in your projects.
Just initialize enum value by creating Enum class.

```php
final class SizeEnum extends \githubjeka\enum\BaseObjectEnum
{
    const XS = 'xs';
    const SMALL = 's';
    const MEDIUM = 'm';
    const LARGE = 'l';
    const XL = 'xl';
    const XXL = 'xxl';

    public static function getList(): array
    {
        return [
            self::XS => 'Extra small(xs)',
            self::SMALL => 'Small',
            self::MEDIUM => 'Medium',
            self::LARGE => 'Large',
            self::XL => 'Extra large(xl)',
            self::XXL => 'Extra extra large(xxl)',
        ];
    }
}
```

After that you can use API enums as:

#### `SizeEnum::getList()`
Return ready list for use in HTML list elements like checkboxes, select or others

#### `SizeEnum::getKeys()` 

Return values of ENUM for use it in validation rules like `Assertion::inArray('xs', SizeEnum::getKeys());`;

#### `SizeEnum::XXL` 
Return string key. Use to compare with the saved values `(bool)('xxl' === SizeEnum::XXL)?>`;

#### `SizeEnum::getLabel(SizeEnum::LARGE)`
Return human description of value. `InvalidArgumentException` will be returned if value is wrong.
 
#### `SizeEnum::isValid('xl')`
Use to avoid `InvalidArgumentException` exception.

#### `new SizeEnum('xxl')`
Return Object enum.

```php
class Shirt
{
    private $size;

    public function __construct(SizeEnum $size)
    {
        $this->size = $size;
    }

    public function size(): SizeEnum
    {
        return $this->size;
    }
}

$sizeFromDb = 'xxl';
$size = new SizeEnum($sizeFromDb);
$shirt = new Shirt($size);

$shirt->size()->asKey(); // (string) xxl 

$shirt->size()->asLabel(); // (string) Extra extra large(xxl)

$shirt->size()->equals(new SizeEnum(SizeEnum::XS)); // (bool) false

echo $shirt->size(); // (string) xxl
```

 

## Extra

Strongly recommend that you do not use numbers as enumeration values:

```php
const XS = '0';         // not recommend
const SMALL = '1';      // not recommend
const MEDIUM = 2;       // not recommend
const LARGE = 3;        // not recommend
```
 
because it is easy to mix up the strings and the underlying number values if you quote the ENUM values incorrectly.

**By default expected that all Enum(constants) are Strings.** 

If you want to use integers you can change `$stringMode` property to `FALSE` in your Enum class. After that should 
use only integers value for constants:
 
 ```php
const XS = 0;
const SMALL = 1;
const MEDIUM = 2;
const LARGE = 3;
 ```

If you [use MySQL ENUM see limits also](https://dev.mysql.com/doc/refman/8.0/en/enum.html#enum-limits) 
