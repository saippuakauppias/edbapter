# EDBApter

![Lint Code Base](https://github.com/saippuakauppias/edbapter/workflows/Lint%20Code%20Base/badge.svg)

Adapter to DBA extension and  wrapper around LMDB (Lightning Memory-Mapped Database) library.

## Requirements

* PHP >= 7.3.14 or >= 7.4.2
* [LMDB](https://github.com/LMDB/lmdb)
* Ext/DBA
* Enabled [LMDB DBA support](https://www.php.net/manual/en/dba.installation.php)

## Installation

The preferred way to install this library is through [composer](http://getcomposer.org/download/).

Either run

```bash
composer require saippuakauppias/edbapter
```

or add `"saippuakauppias/edbapter": "^1.0"` to the `require` section of your `composer.json` file.

## Usage

See [example.php](https://github.com/saippuakauppias/edbapter/blob/master/example.php).

## TODO

- [ ] [libmdbx](https://github.com/erthink/libmdbx) support
