# Changelog

## 3.1.0

### Added
- Added support for Symfony ^6.0.
- Added php 8.1 for testing package.

## 3.0.0

### Changed
- Set php requirement to 7.4 || 8.0
- Made code more strict.

### Removed
- Removed dse() function.
- Removed dsd() function.
- Removed ds() function.
- Removed dsv() function.

## 2.1.0

### Added
- Added renderer "md5" to show md5 sums.
- Added renderer "objectHash" to show object hash (spl_object_hash) for an object.

## 2.0.0

### Added
- Added helper function dv() to dump value(s) and return builder.
- Added helper function dse() to enable remote server dumper handler.
- Added helper dsd() to disable remote server dumper handler.
- Added helper dsv() to dump value(s) to server only and return builder.
- Added renderer "json" to show json for an array.
- Added renderer "keys" to show keys for an array.
- Added renderer "constants" to show constants for an object or a class.
- Added renderer "extend" to show class extends for an object or a class.
- Added renderer "interfaces" to show interfaces for an object or a class.
- Added renderer "methods" to show methods for an object or a class.

## 1.1.0

### Added
- Added function ds() to dump only to remote server.

## 1.0.3

### Fixed
- Reached 100% Code Coverage.

## 1.0.2

### Fixed
- Removed @throw from docblock.

## 1.0.1

### Fixed
- Fixed variable name with multiple purposes.

## 1.0.0

### Added
- Initial release.
