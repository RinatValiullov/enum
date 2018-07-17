[![Build Status](https://travis-ci.com/githubjeka/enum.svg?branch=master)](https://travis-ci.com/githubjeka/enum)

## Usage ENUM
Simple and base functional to start using Enum in your projects.
Just initialize enum value by creating Enum class.

```php
final class SizeEnum extends \githubjeka\enum\BaseEnum
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

After that you can use it as:

- `SizeEnum::getList()` to return ready list for use in HTML list elements like checkboxes, select or others;
- `SizeEnum::getKeys()` to return values of ENUM for use it in validation rules like `Assertion::inArray('xs', SizeEnum::getKeys());`;
- `SizeEnum::LARGE` to compare with the saved value `<?= $size === SizeEnum::LARGE ? 'Large badge' : '' ?>`;
- `SizeEnum::getLabel(SizeEnum::LARGE)` to use a human description of value. `InvalidArgumentException` will be returned
if value is wrong.
- `SizeEnum::isValid('xl')` to avoid exceptions.

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
