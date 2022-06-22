# Basic usage

## Working with MIME-types

All methods working with MIME-types accept and/or return instances of `ju1ius\XdgMime\MimeType` objects.

`MimeType` objects are created via the static constructor method `MimeType::of()`.

`MimeType` objects use the flyweight pattern (only one instance per MIME-type is ever created),
so they can be compared using strict equality.

Alternatively, you can use the `MimeType->is()` instance method to compare MIME-types.

Per the specification, MIME-types are case-insensitive, so they are always internally normalized to lowercase form.

```php
use \ju1ius\XdgMime\MimeType;

// Note that all comparison operations are case-insensitive
assert(MimeType::of('text/plain') === MimeType::of('text/plain'));
assert(MimeType::of('text/plain')->is(MimeType::of('text/plain')));
// `MimeType->is()` also accepts strings
assert(MimeType::of('text/plain')->is('text/plain'));
```

## Querying the MIME database

### MIME-type guessing

The method you'll be using 99% of the time is `XdgMimeDatabase::guessType()`.

It accepts a file path and runs the XDG specification algorithm to guess it's MIME-type.
The algorithm first tries to detect the MIME-type by checking glob patterns against the file name.
If nothing matches at this step (or the result is several conflicting MIME-types),
the algorithm tries to sniff a MIME-type using a portion of the file's contents (if available),
and then performs conflict resolution in order to return the best possible type.

If nothing matches, the `application/octet-stream` MIME-type is returned.

The algorithm also returns the following MIME-types for special filesystem objects:
* `inode/directory` for directories
* `inode/symlink` for symbolic links
* `inode/socket` for sockets
* `inode/fifo` for FIFOs
* `inode/chardevice` for character devices (e.g. `/dev/null`, `/dev/tty`, etc)
* `inode/blockdevice` for block devices (e.g. `/dev/sda`, `/dev/cdrom`, etc)

```php
use ju1ius\XdgMime\XdgMimeDatabase;

$db = new XdgMimeDatabase();
// guess mime-type using the XDG specification algorithm
$type = $db->guessType('/path/to/file');
```

The following type-guessing methods are also available, but will most likely return less accurate results
since they only implement parts of the guessing algorithm:

```php
use ju1ius\XdgMime\XdgMimeDatabase;

$db = new XdgMimeDatabase();
// guess mime-type using the filename only (no I/O performed)
$type = $db->guessTypeByFileName('/path/to/file');
// guess mime-type using the file contents only (doesn't take the filename into account)
$type = $db->guessTypeByContents('/path/to/file');
// guess the mime-type of a binary buffer
$type = $db->guessTypeByData('<?php echo "Hello World!";');
```


### MIME-type information

#### Canonical types

Some MIME-types have common aliases, which can be resolved using `XdgMimeDatabase::getCanonicalType()`.

Note that the database methods always return canonical types.

```php
use ju1ius\XdgMime\MimeType;
use ju1ius\XdgMime\XdgMimeDatabase;

$db = new XdgMimeDatabase();
$type = $db->getCanonicalType(MimeType::of('application/javascript'));
assert($type === MimeType::of('text/javascript'));
```

#### Type hierarchy

MIME-types have a (multiple inheritance) type hierarchy.

For example the hierarchy for `text/javascript` is:
```
text/javascript ─▶ application/ecmascript ┬─▶ text/plain ──────────────┬─▶ application/octet-stream
                                          └─▶ application/x-executable ┘
```

The list of ancestors for a given MIME-type can be retrieved using `XdgMimeDatabase::getAncestors()`.

```php
use ju1ius\XdgMime\MimeType;
use ju1ius\XdgMime\XdgMimeDatabase;

$db = new XdgMimeDatabase();
$ancestors = $db->getAncestors(MimeType::of('text/javascript'));
assert($ancestors === [
    MimeType::of('application/ecmascript'),
    MimeType::of('application/x-executable'),
    MimeType::of('text/plain'),
]);
```

Note that since all MIME-types implicitly inherit from `application/octet-stream`,
it is not included in the results.
