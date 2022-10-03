# Customizing the MIME database

There are cases where you might want to add, remove or modify some information from/to the MIME database:
* If your application only supports a few MIME types, it makes sense to only include information
  for these MIME types for performance reasons.
* If your application use custom file types, you might want to add rules to properly detect them.
* Or the default database might simply be missing some uncommon MIME types.

In those cases, you have to compile the database yourself, using custom data.

It is a good idea to get familiar with [the specification](https://specifications.freedesktop.org/shared-mime-info-spec/shared-mime-info-spec-latest.html),
in particular the relevant chapters:
* [The source XML files](https://specifications.freedesktop.org/shared-mime-info-spec/shared-mime-info-spec-latest.html#idm46292897757504)
* [Directory Layout](https://specifications.freedesktop.org/shared-mime-info-spec/shared-mime-info-spec-latest.html#s2_layout)


## Generating a database from system directories

```php
use Xdg\Mime\MimeDatabaseGenerator;
use Xdg\Mime\XdgMimeDatabase;

// the directory to compile your database into
$outputDirectory = '/path/to/output-directory';
MimeDatabaseGenerator::new()->generate($outputDirectory);
// use your compiled database
$db = new XdgMimeDatabase($outputDirectory);
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


## Generating a database from custom files / directories

```php
use Xdg\Mime\MimeDatabaseGenerator;

// the directory to compile your database into
$outputDirectory = '/path/to/output-directory';
MimeDatabaseGenerator::new()
    // omit or set to true to keep the standard XDG directories.
    ->useXdgDirectories(false)
    // add custom package directories or mime-info XML files
    // when passing a directory, all files with a .xml extension will be parsed
    ->addCustomPaths('/path/to/custom/packages', '/path/to/custom/mime-info.xml')
    ->generate($outputDirectory)
;
// use your compiled database
$db = new XdgMimeDatabase($outputDirectory);
```

## Adding new MIME types

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
