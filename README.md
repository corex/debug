# Debug functions.
Various helpers for debugging code.

![License](https://img.shields.io/packagist/l/corex/debug.svg)
![Build Status](https://travis-ci.org/corex/debug.svg?branch=master)
![codecov](https://codecov.io/gh/corex/debug/branch/master/graph/badge.svg)

This package is a simple approach for debug'ing code when developing. It is based on the excellent var-dumper package from Symfony.

It is a valuable tool when debug'ing old codebases, especially since it also can use [Symfony Dump Server](https://symfony.com/doc/current/components/var_dumper.html#the-dump-server).

## Functions

### d() - Dump value(s)
This function is an alias form dump() function which comes from var-dumper package.


### dv() - Dump value(s) and return builder
It has the same parameters as d() but will only return an expressive caster.


### dse() - Enable remote server dumper handler
**All dump functions will from this point only dump to remote server, even if remote server has not been started.**


### dsd() - Disable remote server dumper handler
**All dump functions will from this point will work as dump() normally would.**


### ds() - Dump value(s) to server only
**All dump functions will from this point only dump to remote server, even if remote server has not been started.**


### dsv() - Dump value(s) to server only and return builder
**All dump functions will from this point only dump to remote server, even if remote server has not been started.**


### dd() - Dump value(s) and die() - exists in Symfony VarDumper component.
This function does only exist in var-dumper package but is documented here to show relevant debug functions.


### d_show_uses() - Show debug uses
Must be call latest in the chain


```php
// Dump value(s).
d('value');

// Dump value(s) and return builder.
dv('value')->value();

// Enable remote server dumper handler.
dse();

// Disable remote server dumper handler.
dsd();

// Dump value(s) to server only.
ds('value');

// Dump value(s) to server only and return builder.
dsv();

// Dump value(s) and die().
dd('value');

// Show Show debug uses. Must be call latest in the chain.
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

To start remote server, start "vendor/bin/var-dump-server".

You can read more at [Symfony Dump Server](https://symfony.com/doc/current/components/var_dumper.html#the-dump-server).

- If you use ds() and remote server is not started, nothing will be dumped
either for cli or html.
- First time ds() is called, it initializes the VarDumper handler to ServerDumper.
All dump(), d(), .... will in future dump to remote dump-server. 
