# Debug functions.
Various helpers for debugging code.

![License](https://img.shields.io/packagist/l/corex/debug.svg)
![Build Status](https://travis-ci.org/corex/debug.svg?branch=master)
![codecov](https://codecov.io/gh/corex/debug/branch/master/graph/badge.svg)


```php
// Dump value.
d('value');

// Dump value and die.
dd('value');

// Dump value only to remote server.
ds('value');
```

To start remote server, start "vendor/bin/var-dump-server".

You can read more at [Symfony Dump Server](https://symfony.com/doc/current/components/var_dumper.html#the-dump-server).

- If you use ds() and remote server is not started, nothing will be dumped
either for cli or html.
- First time ds() is called, it initializes the VarDumper handler to ServerDumper.
All dump(), d(), .... will dump to remote dump-server. 

## ToDo
- Implement dv()->keys();
- Implement dv()->dec().
- Implement dv()->hex().
- Implement dv()->json().
- Implement dv()->rows().
