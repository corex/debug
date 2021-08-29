# Debug functions.
Various helpers for debugging code.

![License](https://img.shields.io/packagist/l/corex/debug.svg)
![Build Status](https://app.travis-ci.com/corex/debug.svg?branch=master)
![codecov](https://codecov.io/gh/corex/debug/branch/master/graph/badge.svg)

This package is a simple and valuable tool when debug'ing legacy codebases and while developing. It is based on the excellent var-dumper package from Symfony.

## Functions

### d() - Dump value(s)
This function is an alias for dump() function which comes from var-dumper package.


### dv() - Dump value(s) and return builder
This function has the same parameters as d() but will only return an expressive caster.


### dd() - Dump value(s) and die() - exists in Symfony VarDumper component.
This function does only exist in var-dumper package but is documented here to show relevant debug functions.


### d_show_uses() - Show debug uses
Must be call latest in the chain


```php
// Dump value(s).
d('value');

// Dump value(s) and return builder.
dv('value')->value();

// Dump value(s) and die().
dd('value');

// Show debug uses. Must be call latest in the chain.
d_show_uses();
```


## Builder (for renderers)
When receiving a builder from i.e. dv(), it is possible to chain renderers i.e. ->value()->json()->....

- value() - Show value.
- json() - Show json.
- keys() - Show keys for an array.
- constants() - Show constants for an object or a class.
- extend() - Show class extends for an object or a class.
- interfaces() - Show interfaces for an object or a class.
- methods() - Show methods for an object or a class.
- md5() - Show md5 sum.
- objectHash() - Show object hash (spl_object_hash) for an object.
