# ju1ius/xdg-mime

[![codecov](https://codecov.io/gh/ju1ius/xdg-mime/branch/main/graph/badge.svg?token=EO5QT1GNKW)](https://codecov.io/gh/ju1ius/xdg-mime)

This package is a pure PHP implementation of the
[XDG Shared MIME-Info Database](http://standards.freedesktop.org/shared-mime-info-spec/) specification.


## Implementation status

* [x] MIME type hierarchy
  * [x] subclasses
  * [x] aliases
* [ ] MIME type guessing
  * [x] globs
  * [x] magic rules
  * [x] treemagic rules
  * [x] XML namespaces
* [x] MIME type icons
  * [x] icons 
  * [x] generic icons 


## Installation

```sh
$ composer require ju1ius/xdg-mime
```


## Usage

### Built-in database

For convenience, this package ships with a pre-compiled database, built from the
[latest shared-mime-info database](https://gitlab.freedesktop.org/xdg/shared-mime-info/-/blob/master/data/freedesktop.org.xml.in).

```php
use ju1ius\XdgMime\XdgMimeDatabase;

$db = new XdgMimeDatabase();
// guess mime-type using the XDG specification algorithm
$type = $db->guessType('/path/to/file');
// guess mime-type using the filename only (no I/O performed)
$type = $db->guessTypeByFileName('/path/to/file');
// guess mime-type using the file contents only (doesn't take the filename into account)
$type = $db->guessTypeByContents('/path/to/file');
// guess the mime-type of a binary buffer
$type = $db->guessTypeByData('<?php echo "Hello World!";');
```


### Custom database

If you want to modify/add mime-type information to the database, you'll have to generate a custom database.

```php
use ju1ius\XdgMime\MimeDatabaseGenerator;
use ju1ius\XdgMime\XdgMimeDatabase;

$outputDirectory = '/path/to/output-directory';
$generator = new MimeDatabaseGenerator();
$generator->generate($outputDirectory);

$db = new XdgMimeDatabase($outputDirectory);
$type = $db->guessType('/path/to/file');
```

By default, the database generator looks for mime-info XML files in the standard XDG data directories.
These directories are configured by the `XDG_DATA_HOME` and `XDG_DATA_DIRS` environment variables
(see the [XDG Base Directory Specification](https://specifications.freedesktop.org/basedir-spec/latest/) for details).
On most linux systems, they will typically be:
  - `/usr/share/mime/packages`
  - `/usr/local/share/mime/packages`
  - `~/.local/share/mime/packages`

The mime-info files are installed by default on most Linux desktops
(on Debian, they are installed by the `shared-mime-info` package).

You can override these paths by passing custom paths to the generator.

```php
use ju1ius\XdgMime\MimeDatabaseGenerator;

$generator = new MimeDatabaseGenerator();
// omit or set to true to keep the standard XDG directories.
$generator->useXdgDirectories(false);
// add custom package directories or mime-info XML files
$generator->addCustomPaths('/path/to/custom/packages', '/path/to/custom/mime-info.xml');
$generator->generate('/path/to/output-directory');
```

### Adding new MIME types

TypeScript doesn't have an official MIME type, and the `.ts` extension is used for several other types,
like `video/mp2t` (MPEG-2 Transport Stream) or `text/vnd.trolltech.linguist` (QT linguist files).

As a consequence, the default mime database won't be able to correctly detect TypeScript files.

To fix this, we will add a new MIME type declaration:

```xml
<?xml version="1.0" encoding="UTF-8" ?>
<mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
  <mime-type type="text/typescript">
    <!-- TypeScript files are plain text files -->
    <sub-class-of type="text/plain"/>
    <!--
        The weight for `video/mp2t` and `text/vnd.trolltech.linguist` glob patterns is 50.
        By adding a glob with a higher weight, we ensure that it is prioritized
        when the magic sniffing fails to detect a MIME type.
    -->
    <glob pattern="*.ts" weight="60"/>
  </mime-type>
</mime-info>
```
