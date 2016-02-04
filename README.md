# timdev/php-array-utils

Everybody who writes a bunch of PHP eventually writes functions to do some common array manipulation tasks.

This is where I'm going to stick all mine.  You're welcome to use them, too.

The utilities are implemented as static methods on a class.

As of today, there's only one function:

## ArrayUtils::val(array $array, $keys, $default = null)

Digs a value out of an array, or else returns a default value.
```php
use TimDev\ArrayUtils as A;

$array = ['foo' => ['bar' => 'baz']];

// $baz == 'baz'
$baz = A::val($array, ['foo', 'bar']);

// $nope == null
$nope = A::val($array, ['foo', 'bork']);

// $nope == 'squee'
$nope = A::val($array, ['i-do-not-exist'], 'squee');

// if you're just dereferencing by one level, you can pass int/string as second arg:
// $foo == ['bar' => 'baz']
$foo = A::val($array, 'foo');  


```
