<?php declare(strict_types=1);

use ju1ius\XDGMime\Runtime\MagicDatabase;
use ju1ius\XDGMime\Runtime\MagicMatch;
use ju1ius\XDGMime\Runtime\MagicRule;
use ju1ius\XDGMime\Utils\Bytes;

$swap = Bytes::isLittleEndianPlatform() ? 1 : 0;

return new MagicDatabase(
    lookupBufferSize: 18729,
    rules: [
        new MagicRule('application/vnd.stardivision.writer', 90, 2100, [
            new MagicMatch(2089, 2090, 'StarWriter', '', 0),
        ]),
        new MagicRule('application/x-docbook+xml', 90, 125, [
            new MagicMatch(0, 1, '<?xml', '', 0, [new MagicMatch(0, 100, '-//OASIS//DTD DocBook XML', '', 0), new MagicMatch(0, 100, '-//KDE//DTD DocBook XML', '', 0)]),
        ]),
        new MagicRule('image/x-eps', 90, 20, [
            new MagicMatch(0, 1, '%!', '', 0, [new MagicMatch(15, 16, 'EPS', '', 0)]),
            new MagicMatch(0, 1, "\x04%!", '', 0, [new MagicMatch(16, 17, 'EPS', '', 0)]),
            new MagicMatch(0, 1, "\xC5\xD0\xD3\xC6", '', 0),
        ]),
        new MagicRule('application/prs.plucker', 80, 69, [
            new MagicMatch(60, 61, 'DataPlkr', '', 0),
        ]),
        new MagicRule('application/schema+json', 80, 266, [
            new MagicMatch(0, 1, '{', '', 0, [new MagicMatch(1, 256, '"$schema":', '', 0)]),
        ]),
        new MagicRule('application/vnd.corel-draw', 80, 17, [
            new MagicMatch(8, 9, 'CDRXvrsn', "\xFF\xFF\xFF\x00\xFF\xFF\xFF\xFF", 0),
        ]),
        new MagicRule('application/x-fictionbook+xml', 80, 268, [
            new MagicMatch(0, 256, '<FictionBook', '', 0),
        ]),
        new MagicRule('application/x-mobipocket-ebook', 80, 69, [
            new MagicMatch(60, 61, 'BOOKMOBI', '', 0),
        ]),
        new MagicRule('application/x-mozilla-bookmarks', 80, 99, [
            new MagicMatch(0, 64, '<!DOCTYPE NETSCAPE-Bookmark-file-1>', '', 0),
        ]),
        new MagicRule('application/x-nzb', 80, 260, [
            new MagicMatch(0, 256, '<nzb', '', 0),
        ]),
        new MagicRule('application/x-pak', 80, 5, [
            new MagicMatch(0, 1, 'PACK', '', 0),
        ]),
        new MagicRule('application/x-php', 80, 69, [
            new MagicMatch(0, 64, '<?php', '', 0),
        ]),
        new MagicRule('application/xliff+xml', 80, 262, [
            new MagicMatch(0, 256, '<xliff', '', 0),
        ]),
        new MagicRule('audio/x-flac+ogg', 80, 34, [
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(28, 29, 'fLaC', '', 0)]),
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(28, 29, "\x7FFLAC", '', 0)]),
        ]),
        new MagicRule('audio/x-opus+ogg', 80, 37, [
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(28, 29, 'OpusHead', '', 0)]),
        ]),
        new MagicRule('audio/x-speex+ogg', 80, 36, [
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(28, 29, 'Speex  ', '', 0)]),
        ]),
        new MagicRule('audio/x-vorbis+ogg', 80, 36, [
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(28, 29, "\x01vorbis", '', 0)]),
        ]),
        new MagicRule('image/astc', 80, 5, [
            new MagicMatch(0, 1, "\x13\xAB\xA1\\", '', 0),
        ]),
        new MagicRule('image/ktx', 80, 13, [
            new MagicMatch(0, 1, "\xABKTX", '', 0, [new MagicMatch(4, 5, " 11\xBB", '', 0, [new MagicMatch(8, 9, "\r\n\x1A\n", '', 0)])]),
        ]),
        new MagicRule('image/ktx2', 80, 13, [
            new MagicMatch(0, 1, "\xABKTX", '', 0, [new MagicMatch(4, 5, " 20\xBB", '', 0, [new MagicMatch(8, 9, "\r\n\x1A\n", '', 0)])]),
        ]),
        new MagicRule('image/svg+xml', 80, 269, [
            new MagicMatch(0, 256, '<!DOCTYPE svg', '', 0),
        ]),
        new MagicRule('image/svg+xml', 80, 27, [
            new MagicMatch(0, 1, '<!-- Created with Inkscape', '', 0),
            new MagicMatch(0, 1, '<svg', '', 0),
        ]),
        new MagicRule('image/vnd.djvu', 80, 17, [
            new MagicMatch(0, 1, 'AT&TFORM', '', 0, [new MagicMatch(12, 13, 'DJVU', '', 0)]),
            new MagicMatch(0, 1, 'FORM', '', 0, [new MagicMatch(8, 9, 'DJVU', '', 0)]),
        ]),
        new MagicRule('image/vnd.djvu+multipage', 80, 17, [
            new MagicMatch(0, 1, 'AT&TFORM', '', 0, [new MagicMatch(12, 13, 'DJVM', '', 0)]),
            new MagicMatch(0, 1, 'FORM', '', 0, [new MagicMatch(8, 9, 'DJVM', '', 0)]),
        ]),
        new MagicRule('image/x-kodak-kdc', 80, 264, [
            new MagicMatch(242, 243, 'EASTMAN KODAK COMPANY', '', 0),
        ]),
        new MagicRule('image/x-niff', 80, 5, [
            new MagicMatch(0, 1, 'IIN1', '', 0),
        ]),
        new MagicRule('video/x-ogm+ogg', 80, 35, [
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(29, 30, 'video', '', 0)]),
        ]),
        new MagicRule('video/x-theora+ogg', 80, 36, [
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(28, 29, "\x80theora", '', 0)]),
        ]),
        new MagicRule('application/atom+xml', 70, 262, [
            new MagicMatch(0, 256, '<feed ', '', 0),
        ]),
        new MagicRule('application/epub+zip', 70, 64, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/epub+zip', '', 0), new MagicMatch(43, 44, 'application/epub+zip', '', 0)])]),
        ]),
        new MagicRule('application/rss+xml', 70, 261, [
            new MagicMatch(0, 256, '<rss ', '', 0),
            new MagicMatch(0, 256, '<RSS ', '', 0),
        ]),
        new MagicRule('application/vnd.apple.keynote', 70, 41, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'index.apxl', '', 0)]),
        ]),
        new MagicRule('application/vnd.apple.mpegurl', 70, 149, [
            new MagicMatch(0, 1, '#EXTM3U', '', 0, [new MagicMatch(0, 128, '#EXT-X-TARGETDURATION', '', 0), new MagicMatch(0, 128, '#EXT-X-STREAM-INF', '', 0)]),
        ]),
        new MagicRule('application/vnd.apple.pages', 70, 49, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'index.xml', '', 0), new MagicMatch(30, 31, 'Index/Document.iwa', '', 0)]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.chart', 70, 79, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.chart', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.chart-template', 70, 88, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.chart-template', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.database', 70, 78, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.base', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.formula', 70, 81, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.formula', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.formula-template', 70, 90, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.formula-template', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.graphics', 70, 82, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.graphics', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.graphics-template', 70, 91, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.graphics-template', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.image', 70, 79, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.image', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.presentation', 70, 86, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.presentation', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.presentation-template', 70, 95, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.presentation-template', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.spreadsheet', 70, 85, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.spreadsheet', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.spreadsheet-template', 70, 94, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.spreadsheet-template', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text', 70, 78, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.text', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text-master', 70, 85, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.text-master', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text-template', 70, 87, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.text-template', '', 0)])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text-web', 70, 82, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.text-web', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.calc', 70, 67, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.calc', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.calc.template', 70, 67, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.calc', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.draw', 70, 67, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.draw', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.draw.template', 70, 67, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.draw', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.impress', 70, 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.impress', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.impress.template', 70, 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.impress', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.math', 70, 67, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.math', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.writer', 70, 69, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.writer', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.writer.global', 70, 69, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.writer', '', 0)])]),
        ]),
        new MagicRule('application/vnd.sun.xml.writer.template', 70, 69, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/vnd.sun.xml.writer', '', 0)])]),
        ]),
        new MagicRule('application/x-zip-compressed-fb2', 70, 260, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 256, '.fb2', '', 0)]),
        ]),
        new MagicRule('image/openraster', 70, 55, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'image/openraster', '', 0)])]),
        ]),
        new MagicRule('text/x-opml+xml', 70, 262, [
            new MagicMatch(0, 256, '<opml ', '', 0),
        ]),
        new MagicRule('application/vnd.apple.numbers', 65, 49, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'index.xml', '', 0), new MagicMatch(30, 31, 'Index/Document.iwa', '', 0)]),
        ]),
        new MagicRule('application/vnd.apple.pkpass', 65, 40, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'pass.json', '', 0)]),
        ]),
        new MagicRule('application/msword', 60, 2141, [
            new MagicMatch(0, 1, "1\xBE\x00\x00", '', 0),
            new MagicMatch(0, 1, 'PO^Q`', '', 0),
            new MagicMatch(0, 1, "\xFE7\x00#", '', 0),
            new MagicMatch(0, 1, "\xDB\xA5-\x00\x00\x00", '', 0),
            new MagicMatch(2112, 2113, 'MSWordDoc', '', 0),
            new MagicMatch(2108, 2109, 'MSWordDoc', '', 0),
            new MagicMatch(2112, 2113, 'Microsoft Word document data', '', 0),
            new MagicMatch(546, 547, 'bjbj', '', 0),
            new MagicMatch(546, 547, 'jbjb', '', 0),
        ]),
        new MagicRule('application/ovf', 60, 266, [
            new MagicMatch(1, 256, '.ovf', '', 0, [new MagicMatch(257, 258, "ustar\x00", '', 0), new MagicMatch(257, 258, "ustar  \x00", '', 0)]),
        ]),
        new MagicRule('application/vnd.ms-cab-compressed', 60, 9, [
            new MagicMatch(0, 1, "MSCF\x00\x00\x00\x00", '', 0),
        ]),
        new MagicRule('application/vnd.ms-wpl', 60, 261, [
            new MagicMatch(0, 256, '<?wpl', '', 0),
        ]),
        new MagicRule('application/vnd.rar', 60, 5, [
            new MagicMatch(0, 1, 'Rar!', '', 0),
        ]),
        new MagicRule('application/x-7z-compressed', 60, 7, [
            new MagicMatch(0, 1, "7z\xBC\xAF'\x1C", '', 0),
        ]),
        new MagicRule('application/x-ace', 60, 15, [
            new MagicMatch(7, 8, '**ACE**', '', 0),
        ]),
        new MagicRule('application/x-arc', 60, 5, [
            new MagicMatch(0, 1, "\x1A\x08\x00\x00", "\xFF\xFF\x80\x80", 0),
            new MagicMatch(0, 1, "\x1A\t\x00\x00", "\xFF\xFF\x80\x80", 0),
            new MagicMatch(0, 1, "\x1A\x02\x00\x00", "\xFF\xFF\x80\x80", 0),
            new MagicMatch(0, 1, "\x1A\x03\x00\x00", "\xFF\xFF\x80\x80", 0),
            new MagicMatch(0, 1, "\x1A\x04\x00\x00", "\xFF\xFF\x80\x80", 0),
            new MagicMatch(0, 1, "\x1A\x06\x00\x00", "\xFF\xFF\x80\x80", 0),
        ]),
        new MagicRule('application/x-cpio', 60, 7, [
            new MagicMatch(0, 1, "q\xC7", '', 2|$swap),
            new MagicMatch(0, 1, '070701', '', 0),
            new MagicMatch(0, 1, '070702', '', 0),
            new MagicMatch(0, 1, "\xC7q", '', 2|$swap),
        ]),
        new MagicRule('application/x-font-type1', 60, 70, [
            new MagicMatch(0, 1, 'LWFN', '', 0),
            new MagicMatch(65, 66, 'LWFN', '', 0),
            new MagicMatch(0, 1, '%!PS-AdobeFont-1.', '', 0),
            new MagicMatch(6, 7, '%!PS-AdobeFont-1.', '', 0),
            new MagicMatch(0, 1, '%!FontType1-1.', '', 0),
            new MagicMatch(6, 7, '%!FontType1-1.', '', 0),
        ]),
        new MagicRule('application/x-java-pack200', 60, 5, [
            new MagicMatch(0, 1, "\xCA\xFE\xD0\r", '', 0),
        ]),
        new MagicRule('application/x-karbon', 60, 59, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-karbon\x04\x06", '', 0)])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/x-karbon', '', 0)])]),
        ]),
        new MagicRule('application/x-kchart', 60, 59, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-kchart\x04\x06", '', 0)])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/x-kchart', '', 0)])]),
        ]),
        new MagicRule('application/x-kformula', 60, 61, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-kformula\x04\x06", '', 0)])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/x-kformula', '', 0)])]),
        ]),
        new MagicRule('application/x-killustrator', 60, 47, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-killustrator\x04\x06", '', 0)])]),
        ]),
        new MagicRule('application/x-kivio', 60, 58, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-kivio\x04\x06", '', 0)])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/x-kivio', '', 0)])]),
        ]),
        new MagicRule('application/x-kontour', 60, 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-kontour\x04\x06", '', 0)])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/x-kontour', '', 0)])]),
        ]),
        new MagicRule('application/x-kpresenter', 60, 63, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-kpresenter\x04\x06", '', 0)])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/x-kpresenter', '', 0)])]),
        ]),
        new MagicRule('application/x-krita', 60, 83, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-krita\x04\x06", '', 0)])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/x-krita', '', 0), new MagicMatch(42, 43, 'application/x-krita', '', 0), new MagicMatch(63, 64, 'application/x-krita', '', 0)])]),
        ]),
        new MagicRule('application/x-kspread', 60, 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-kspread\x04\x06", '', 0)])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/x-kspread', '', 0)])]),
        ]),
        new MagicRule('application/x-kword', 60, 58, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0, [new MagicMatch(10, 11, 'KOffice', '', 0, [new MagicMatch(18, 19, "application/x-kword\x04\x06", '', 0)])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 0, [new MagicMatch(30, 31, 'mimetype', '', 0, [new MagicMatch(38, 39, 'application/x-kword', '', 0)])]),
        ]),
        new MagicRule('application/x-lha', 60, 9, [
            new MagicMatch(2, 3, '-lh -', '', 0),
            new MagicMatch(2, 3, '-lh0-', '', 0),
            new MagicMatch(2, 3, '-lh1-', '', 0),
            new MagicMatch(2, 3, '-lh2-', '', 0),
            new MagicMatch(2, 3, '-lh3-', '', 0),
            new MagicMatch(2, 3, '-lh4-', '', 0),
            new MagicMatch(2, 3, '-lh5-', '', 0),
            new MagicMatch(2, 3, '-lh40-', '', 0),
            new MagicMatch(2, 3, '-lhd-', '', 0),
            new MagicMatch(2, 3, '-lz4-', '', 0),
            new MagicMatch(2, 3, '-lz5-', '', 0),
            new MagicMatch(2, 3, '-lzs-', '', 0),
        ]),
        new MagicRule('application/x-lrzip', 60, 5, [
            new MagicMatch(0, 1, 'LRZI', '', 0),
        ]),
        new MagicRule('application/x-lz4', 60, 5, [
            new MagicMatch(0, 1, "\x04\"M\x18", '', 0),
            new MagicMatch(0, 1, "\x02!L\x18", '', 0),
        ]),
        new MagicRule('application/x-lzip', 60, 5, [
            new MagicMatch(0, 1, 'LZIP', '', 0),
        ]),
        new MagicRule('application/x-lzop', 60, 10, [
            new MagicMatch(0, 1, "\x89LZO\x00\r\n\x1A\n", '', 0),
        ]),
        new MagicRule('application/x-par2', 60, 5, [
            new MagicMatch(0, 1, 'PAR2', '', 0),
        ]),
        new MagicRule('application/x-qpress', 60, 9, [
            new MagicMatch(0, 1, 'qpress10', '', 0),
        ]),
        new MagicRule('application/x-quicktime-media-link', 60, 75, [
            new MagicMatch(0, 1, '<?xml', '', 0, [new MagicMatch(0, 64, '<?quicktime', '', 0)]),
            new MagicMatch(0, 1, 'RTSPtext', '', 0),
            new MagicMatch(0, 1, 'rtsptext', '', 0),
            new MagicMatch(0, 1, 'SMILtext', '', 0),
        ]),
        new MagicRule('application/x-sega-cd-rom', 60, 277, [
            new MagicMatch(0, 1, 'SEGADISCSYSTEM', '', 0, [new MagicMatch(256, 257, 'SEGA', '', 0)]),
            new MagicMatch(16, 17, 'SEGADISCSYSTEM', '', 0, [new MagicMatch(272, 273, 'SEGA', '', 0)]),
        ]),
        new MagicRule('application/x-stuffit', 60, 9, [
            new MagicMatch(0, 1, 'StuffIt ', '', 0),
            new MagicMatch(0, 1, 'SIT!', '', 0),
        ]),
        new MagicRule('application/x-tar', 60, 266, [
            new MagicMatch(257, 258, "ustar\x00", '', 0),
            new MagicMatch(257, 258, "ustar  \x00", '', 0),
        ]),
        new MagicRule('application/x-xar', 60, 5, [
            new MagicMatch(0, 1, 'xar!', '', 0),
        ]),
        new MagicRule('application/x-xz', 60, 7, [
            new MagicMatch(0, 1, "\xFD7zXZ\x00", '', 0),
        ]),
        new MagicRule('application/x-zoo', 60, 25, [
            new MagicMatch(20, 21, "\xDC\xA7\xC4\xFD", '', 0),
        ]),
        new MagicRule('application/xhtml+xml', 60, 305, [
            new MagicMatch(0, 256, '//W3C//DTD XHTML ', '', 0),
            new MagicMatch(0, 256, 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd', '', 0),
            new MagicMatch(0, 256, '<html xmlns="http://www.w3.org/1999/xhtml', '', 0),
            new MagicMatch(0, 256, '<HTML xmlns="http://www.w3.org/1999/xhtml', '', 0),
        ]),
        new MagicRule('application/zip', 60, 5, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0),
        ]),
        new MagicRule('application/zstd', 60, 5, [
            new MagicMatch(0, 1, "(\xB5/\xFD", '', 0),
        ]),
        new MagicRule('audio/vnd.dts.hd', 60, 18729, [
            new MagicMatch(0, 1, "\x7F\xFE\x80\x01", '', 0, [new MagicMatch(4, 18725, 'dX %', '', 0)]),
        ]),
        new MagicRule('text/x-python3', 60, 34, [
            new MagicMatch(0, 1, '#!/bin/python3', '', 0),
            new MagicMatch(0, 1, '#! /bin/python3', '', 0),
            new MagicMatch(0, 1, 'eval "exec /bin/python3', '', 0),
            new MagicMatch(0, 1, '#!/usr/bin/python3', '', 0),
            new MagicMatch(0, 1, '#! /usr/bin/python3', '', 0),
            new MagicMatch(0, 1, 'eval "exec /usr/bin/python3', '', 0),
            new MagicMatch(0, 1, '#!/usr/local/bin/python3', '', 0),
            new MagicMatch(0, 1, '#! /usr/local/bin/python3', '', 0),
            new MagicMatch(0, 1, 'eval "exec /usr/local/bin/python3', '', 0),
            new MagicMatch(2, 16, '/bin/env python3', '', 0),
        ]),
        new MagicRule('text/x-txt2tags', 60, 11, [
            new MagicMatch(0, 1, '%!postproc', '', 0),
            new MagicMatch(0, 1, '%!encoding', '', 0),
        ]),
        new MagicRule('application/smil+xml', 55, 261, [
            new MagicMatch(0, 256, '<smil', '', 0),
        ]),
        new MagicRule('audio/x-ms-asx', 51, 68, [
            new MagicMatch(0, 1, 'ASF ', '', 0),
            new MagicMatch(0, 64, '<ASX', '', 0),
            new MagicMatch(0, 64, '<asx', '', 0),
            new MagicMatch(0, 64, '<Asx', '', 0),
        ]),
        new MagicRule('application/annodex', 50, 520, [
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(28, 29, "fishead\x00", '', 0, [new MagicMatch(56, 512, "CMML\x00\x00\x00\x00", '', 0)])]),
        ]),
        new MagicRule('application/dicom', 50, 133, [
            new MagicMatch(128, 129, 'DICM', '', 0),
        ]),
        new MagicRule('application/fits', 50, 10, [
            new MagicMatch(0, 1, 'SIMPLE  =', '', 0),
        ]),
        new MagicRule('application/gnunet-directory', 50, 9, [
            new MagicMatch(0, 1, "\x89GND\r\n\x1A\n", '', 0),
        ]),
        new MagicRule('application/gzip', 50, 3, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0),
        ]),
        new MagicRule('application/mac-binhex40', 50, 41, [
            new MagicMatch(11, 12, 'must be converted with BinHex', '', 0),
        ]),
        new MagicRule('application/mathematica', 50, 321, [
            new MagicMatch(0, 1, '(************** Content-type: application/mathematica', '', 0),
            new MagicMatch(100, 256, 'This notebook can be used on any computer system with Mathematica', '', 0),
            new MagicMatch(10, 256, 'This is a Mathematica Notebook file.  It contains ASCII text', '', 0),
        ]),
        new MagicRule('application/metalink+xml', 50, 279, [
            new MagicMatch(0, 256, '<metalink version="3.0"', '', 0),
        ]),
        new MagicRule('application/metalink4+xml', 50, 276, [
            new MagicMatch(0, 256, '<metalink xmlns="urn', '', 0),
        ]),
        new MagicRule('application/mxf', 50, 270, [
            new MagicMatch(0, 256, "\x06\x0E+4\x02\x05\x01\x01\r\x01\x02\x01\x01\x02", '', 0),
        ]),
        new MagicRule('application/ogg', 50, 5, [
            new MagicMatch(0, 1, 'OggS', '', 0),
        ]),
        new MagicRule('application/owl+xml', 50, 265, [
            new MagicMatch(0, 256, '<Ontology', '', 0),
        ]),
        new MagicRule('application/pdf', 50, 1029, [
            new MagicMatch(0, 1024, '%PDF-', '', 0),
        ]),
        new MagicRule('application/pgp-encrypted', 50, 28, [
            new MagicMatch(0, 1, '-----BEGIN PGP MESSAGE-----', '', 0),
        ]),
        new MagicRule('application/pgp-keys', 50, 38, [
            new MagicMatch(0, 1, '-----BEGIN PGP PUBLIC KEY BLOCK-----', '', 0),
            new MagicMatch(0, 1, '-----BEGIN PGP PRIVATE KEY BLOCK-----', '', 0),
            new MagicMatch(0, 1, "\x95\x01", '', 0),
            new MagicMatch(0, 1, "\x95\x00", '', 0),
            new MagicMatch(0, 1, "\x99\x00", '', 0),
            new MagicMatch(0, 1, "\x99\x01", '', 0),
        ]),
        new MagicRule('application/pgp-signature', 50, 30, [
            new MagicMatch(0, 1, '-----BEGIN PGP SIGNATURE-----', '', 0),
        ]),
        new MagicRule('application/pkix-cert', 50, 33, [
            new MagicMatch(0, 1, '-----BEGIN CERTIFICATE-----', '', 0),
            new MagicMatch(0, 1, '-----BEGIN X509 CERTIFICATE-----', '', 0),
        ]),
        new MagicRule('application/pkix-crl', 50, 25, [
            new MagicMatch(0, 1, '-----BEGIN X509 CRL-----', '', 0),
        ]),
        new MagicRule('application/postscript', 50, 4, [
            new MagicMatch(0, 1, "\x04%!", '', 0),
            new MagicMatch(0, 1, '%!', '', 0),
        ]),
        new MagicRule('application/raml+yaml', 50, 8, [
            new MagicMatch(0, 1, '#%RAML ', '', 0),
        ]),
        new MagicRule('application/rtf', 50, 6, [
            new MagicMatch(0, 1, '{\\rtf', '', 0),
        ]),
        new MagicRule('application/sdp', 50, 258, [
            new MagicMatch(0, 1, 'v=', '', 0, [new MagicMatch(0, 256, 's=', '', 0)]),
        ]),
        new MagicRule('application/vnd.adobe.flash.movie', 50, 4, [
            new MagicMatch(0, 1, 'FWS', '', 0),
            new MagicMatch(0, 1, 'CWS', '', 0),
        ]),
        new MagicRule('application/vnd.appimage', 50, 12, [
            new MagicMatch(1, 2, 'ELF', '', 0, [new MagicMatch(8, 9, 'A', '', 0, [new MagicMatch(9, 10, 'I', '', 0, [new MagicMatch(10, 11, "\x02", '', 0)])])]),
        ]),
        new MagicRule('application/vnd.chess-pgn', 50, 8, [
            new MagicMatch(0, 1, '[Event ', '', 0),
        ]),
        new MagicRule('application/vnd.debian.binary-package', 50, 15, [
            new MagicMatch(0, 1, '!<arch>', '', 0, [new MagicMatch(8, 9, 'debian', '', 0)]),
        ]),
        new MagicRule('application/vnd.emusic-emusic_package', 50, 8, [
            new MagicMatch(0, 1, 'nF7YLao', '', 0),
        ]),
        new MagicRule('application/vnd.flatpak', 50, 13, [
            new MagicMatch(0, 1, "xdg-app\x00\x01\x00\x89\xE5", '', 0),
            new MagicMatch(0, 1, "flatpak\x00\x01\x00\x89\xE5", '', 0),
        ]),
        new MagicRule('application/vnd.flatpak.ref', 50, 269, [
            new MagicMatch(0, 256, '[Flatpak Ref]', '', 0),
        ]),
        new MagicRule('application/vnd.flatpak.repo', 50, 270, [
            new MagicMatch(0, 256, '[Flatpak Repo]', '', 0),
        ]),
        new MagicRule('application/vnd.framemaker', 50, 17, [
            new MagicMatch(0, 1, '<MakerFile', '', 0),
            new MagicMatch(0, 1, '<MIFFile', '', 0),
            new MagicMatch(0, 1, '<MakerDictionary', '', 0),
            new MagicMatch(0, 1, '<MakerScreenFon', '', 0),
            new MagicMatch(0, 1, '<MML', '', 0),
            new MagicMatch(0, 1, '<Book', '', 0),
            new MagicMatch(0, 1, '<Maker', '', 0),
        ]),
        new MagicRule('application/vnd.iccprofile', 50, 41, [
            new MagicMatch(36, 37, 'acsp', '', 0),
        ]),
        new MagicRule('application/vnd.lotus-1-2-3', 50, 15, [
            new MagicMatch(0, 1, "\x00\x00\x02\x00\x06\x04\x06\x00\x08\x00\x00\x00\x00\x00", '', 0),
        ]),
        new MagicRule('application/vnd.lotus-wordpro', 50, 8, [
            new MagicMatch(0, 1, 'WordPro', '', 0),
        ]),
        new MagicRule('application/vnd.ms-access', 50, 20, [
            new MagicMatch(0, 1, "\x00\x01\x00\x00Standard Jet DB", '', 0),
        ]),
        new MagicRule('application/vnd.ms-asf', 50, 12, [
            new MagicMatch(0, 1, "0&\xB2u", '', 0),
            new MagicMatch(0, 1, '[Reference]', '', 0),
        ]),
        new MagicRule('application/vnd.ms-excel', 50, 2110, [
            new MagicMatch(2080, 2081, 'Microsoft Excel 5.0 Worksheet', '', 0),
        ]),
        new MagicRule('application/vnd.ms-tnef', 50, 5, [
            new MagicMatch(0, 1, "x\x9F>\"", '', 0),
        ]),
        new MagicRule('application/vnd.rn-realmedia', 50, 5, [
            new MagicMatch(0, 1, '.RMF', '', 0),
        ]),
        new MagicRule('application/vnd.smaf', 50, 5, [
            new MagicMatch(0, 1, 'MMMD', '', 0),
        ]),
        new MagicRule('application/vnd.sqlite3', 50, 16, [
            new MagicMatch(0, 1, 'SQLite format 3', '', 0),
        ]),
        new MagicRule('application/vnd.squashfs', 50, 5, [
            new MagicMatch(0, 1, 'sqsh', '', 0),
            new MagicMatch(0, 1, 'hsqs', '', 0),
        ]),
        new MagicRule('application/vnd.symbian.install', 50, 13, [
            new MagicMatch(8, 9, "\x19\x04\x00\x10", '', 0),
        ]),
        new MagicRule('application/vnd.tcpdump.pcap', 50, 5, [
            new MagicMatch(0, 1, "\xA1\xB2\xC3\xD4", '', 4|$swap),
            new MagicMatch(0, 1, "\xD4\xC3\xB2\xA1", '', 4|$swap),
        ]),
        new MagicRule('application/vnd.wordperfect', 50, 5, [
            new MagicMatch(1, 2, 'WPC', '', 0),
        ]),
        new MagicRule('application/winhlp', 50, 5, [
            new MagicMatch(0, 1, "?_\x03\x00", '', 0),
        ]),
        new MagicRule('application/x-abiword', 50, 273, [
            new MagicMatch(0, 256, '<abiword', '', 0),
            new MagicMatch(0, 256, '<!DOCTYPE abiword', '', 0),
        ]),
        new MagicRule('application/x-alz', 50, 4, [
            new MagicMatch(0, 1, 'ALZ', '', 0),
        ]),
        new MagicRule('application/x-amiga-disk-format', 50, 5, [
            new MagicMatch(0, 1, "DOS\x00", '', 0),
        ]),
        new MagicRule('application/x-aportisdoc', 50, 69, [
            new MagicMatch(60, 61, 'TEXtREAd', '', 0),
            new MagicMatch(60, 61, 'TEXtTlDc', '', 0),
        ]),
        new MagicRule('application/x-apple-systemprofiler+xml', 50, 418, [
            new MagicMatch(0, 256, '<plist version="1.0"', '', 0, [new MagicMatch(34, 384, '<key>_SPCommandLineArguments</key>', '', 0)]),
        ]),
        new MagicRule('application/x-applix-spreadsheet', 50, 20, [
            new MagicMatch(0, 1, '*BEGIN SPREADSHEETS', '', 0),
            new MagicMatch(0, 1, '*BEGIN', '', 0, [new MagicMatch(7, 8, 'SPREADSHEETS', '', 0)]),
        ]),
        new MagicRule('application/x-applix-word', 50, 13, [
            new MagicMatch(0, 1, '*BEGIN', '', 0, [new MagicMatch(7, 8, 'WORDS', '', 0)]),
        ]),
        new MagicRule('application/x-arj', 50, 3, [
            new MagicMatch(0, 1, "`\xEA", '', 0),
        ]),
        new MagicRule('application/x-asar', 50, 26, [
            new MagicMatch(0, 1, "\x04\x00\x00\x00", '', 0, [new MagicMatch(16, 17, '{"files":', '', 0)]),
        ]),
        new MagicRule('application/x-atari-7800-rom', 50, 11, [
            new MagicMatch(1, 2, 'ATARI7800', '', 0),
        ]),
        new MagicRule('application/x-atari-lynx-rom', 50, 5, [
            new MagicMatch(0, 1, 'LYNX', '', 0),
        ]),
        new MagicRule('application/x-awk', 50, 23, [
            new MagicMatch(0, 1, '#!/bin/gawk', '', 0),
            new MagicMatch(0, 1, '#! /bin/gawk', '', 0),
            new MagicMatch(0, 1, '#!/usr/bin/gawk', '', 0),
            new MagicMatch(0, 1, '#! /usr/bin/gawk', '', 0),
            new MagicMatch(0, 1, '#!/usr/local/bin/gawk', '', 0),
            new MagicMatch(0, 1, '#! /usr/local/bin/gawk', '', 0),
            new MagicMatch(0, 1, '#!/bin/awk', '', 0),
            new MagicMatch(0, 1, '#! /bin/awk', '', 0),
            new MagicMatch(0, 1, '#!/usr/bin/awk', '', 0),
            new MagicMatch(0, 1, '#! /usr/bin/awk', '', 0),
        ]),
        new MagicRule('application/x-bittorrent', 50, 12, [
            new MagicMatch(0, 1, 'd8:announce', '', 0),
        ]),
        new MagicRule('application/x-blender', 50, 8, [
            new MagicMatch(0, 1, 'BLENDER', '', 0),
        ]),
        new MagicRule('application/x-bps-patch', 50, 5, [
            new MagicMatch(0, 1, 'BPS1', '', 0),
        ]),
        new MagicRule('application/x-bsdiff', 50, 9, [
            new MagicMatch(0, 1, 'BSDIFF40', '', 0),
            new MagicMatch(0, 1, 'BSDIFN40', '', 0),
        ]),
        new MagicRule('application/x-bzip', 50, 4, [
            new MagicMatch(0, 1, 'BZh', '', 0),
        ]),
        new MagicRule('application/x-ccmx', 50, 5, [
            new MagicMatch(0, 1, 'CCMX', '', 0),
        ]),
        new MagicRule('application/x-cdrdao-toc', 50, 24, [
            new MagicMatch(0, 1, "CD_ROM\n", '', 0),
            new MagicMatch(0, 1, "CD_DA\n", '', 0),
            new MagicMatch(0, 1, "CD_ROM_XA\n", '', 0),
            new MagicMatch(0, 1, 'CD_TEXT ', '', 0),
            new MagicMatch(0, 1, 'CATALOG "', '', 0, [new MagicMatch(22, 23, '"', '', 0)]),
        ]),
        new MagicRule('application/x-cisco-vpn-settings', 50, 265, [
            new MagicMatch(0, 1, '[main]', '', 0, [new MagicMatch(0, 256, 'AuthType=', '', 0)]),
        ]),
        new MagicRule('application/x-compress', 50, 3, [
            new MagicMatch(0, 1, "\x1F\x9D", '', 0),
        ]),
        new MagicRule('application/x-compressed-iso', 50, 5, [
            new MagicMatch(0, 1, 'CISO', '', 0),
        ]),
        new MagicRule('application/x-core', 50, 19, [
            new MagicMatch(0, 1, "\x7FELF            \x04", "\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\xFF", 0),
            new MagicMatch(0, 1, "\x7FELF", '', 0, [new MagicMatch(5, 6, "\x01", '', 0, [new MagicMatch(16, 17, "\x04\x00", '', 0)])]),
            new MagicMatch(0, 1, "\x7FELF", '', 0, [new MagicMatch(5, 6, "\x02", '', 0, [new MagicMatch(16, 17, "\x00\x04", '', 0)])]),
            new MagicMatch(0, 1, "Core\x01", '', 0),
            new MagicMatch(0, 1, "Core\x02", '', 0),
        ]),
        new MagicRule('application/x-csh', 50, 29, [
            new MagicMatch(2, 16, '/bin/tcsh', '', 0),
            new MagicMatch(2, 16, '/bin/csh', '', 0),
            new MagicMatch(2, 16, '/bin/env csh', '', 0),
            new MagicMatch(2, 16, '/bin/env tcsh', '', 0),
        ]),
        new MagicRule('application/x-dar', 50, 5, [
            new MagicMatch(0, 1, "\x00\x00\x00{", '', 0),
        ]),
        new MagicRule('application/x-designer', 50, 260, [
            new MagicMatch(0, 256, '<ui ', '', 0),
            new MagicMatch(0, 256, '<UI ', '', 0),
        ]),
        new MagicRule('application/x-desktop', 50, 47, [
            new MagicMatch(0, 32, '[Desktop Entry]', '', 0),
            new MagicMatch(0, 1, '[Desktop Action', '', 0),
            new MagicMatch(0, 1, '[KDE Desktop Entry]', '', 0),
            new MagicMatch(0, 1, '# Config File', '', 0),
            new MagicMatch(0, 1, '# KDE Config File', '', 0),
        ]),
        new MagicRule('application/x-dia-diagram', 50, 105, [
            new MagicMatch(5, 100, '<dia:', '', 0),
        ]),
        new MagicRule('application/x-dia-shape', 50, 106, [
            new MagicMatch(5, 100, '<shape', '', 0),
        ]),
        new MagicRule('application/x-doom-wad', 50, 5, [
            new MagicMatch(0, 1, 'IWAD', '', 0),
            new MagicMatch(0, 1, 'PWAD', '', 0),
        ]),
        new MagicRule('application/x-dreamcast-rom', 50, 32, [
            new MagicMatch(16, 17, 'SEGA SEGAKATANA', '', 0),
        ]),
        new MagicRule('application/x-dvi', 50, 3, [
            new MagicMatch(0, 1, "\xF7\x02", '', 0),
        ]),
        new MagicRule('application/x-fds-disk', 50, 16, [
            new MagicMatch(1, 2, '*NINTENDO-HVC*', '', 0),
        ]),
        new MagicRule('application/x-fluid', 50, 25, [
            new MagicMatch(0, 1, '# data file for the Fltk', '', 0),
        ]),
        new MagicRule('application/x-font-bdf', 50, 11, [
            new MagicMatch(0, 1, 'STARTFONT ', '', 0),
        ]),
        new MagicRule('application/x-font-dos', 50, 12, [
            new MagicMatch(0, 1, "\xFFFON", '', 0),
            new MagicMatch(7, 8, "\x00EGA", '', 0),
            new MagicMatch(7, 8, "\x00VID", '', 0),
        ]),
        new MagicRule('application/x-font-framemaker', 50, 17, [
            new MagicMatch(0, 1, '<MakerScreenFont', '', 0),
        ]),
        new MagicRule('application/x-font-libgrx', 50, 5, [
            new MagicMatch(0, 1, "\x14\x02Y\x19", '', 0),
        ]),
        new MagicRule('application/x-font-linux-psf', 50, 3, [
            new MagicMatch(0, 1, "6\x04", '', 0),
        ]),
        new MagicRule('application/x-font-pcf', 50, 5, [
            new MagicMatch(0, 1, "\x01fcp", '', 0),
        ]),
        new MagicRule('application/x-font-speedo', 50, 6, [
            new MagicMatch(0, 1, "D1.0\r", '', 0),
        ]),
        new MagicRule('application/x-font-sunos-news', 50, 12, [
            new MagicMatch(0, 1, 'StartFont', '', 0),
            new MagicMatch(0, 1, "\x13z)", '', 0),
            new MagicMatch(8, 9, "\x13z+", '', 0),
        ]),
        new MagicRule('application/x-font-tex', 50, 3, [
            new MagicMatch(0, 1, "\xF7\x83", '', 0),
            new MagicMatch(0, 1, "\xF7Y", '', 0),
            new MagicMatch(0, 1, "\xF7\xCA", '', 0),
        ]),
        new MagicRule('application/x-font-tex-tfm', 50, 5, [
            new MagicMatch(2, 3, "\x00\x11", '', 0),
            new MagicMatch(2, 3, "\x00\x12", '', 0),
        ]),
        new MagicRule('application/x-font-ttx', 50, 309, [
            new MagicMatch(0, 256, '<ttFont sfntVersion="\\x00\\x01\\x00\\x00" ttLibVersion="', '', 0),
        ]),
        new MagicRule('application/x-font-vfont', 50, 5, [
            new MagicMatch(0, 1, 'FONT', '', 0),
        ]),
        new MagicRule('application/x-gameboy-color-rom', 50, 325, [
            new MagicMatch(260, 261, "\xCE\xEDff\xCC\r\x00\v\x03s\x00\x83\x00\f\x00\r\x00\x08", '', 0, [new MagicMatch(323, 324, "\x80", "\x80", 0)]),
        ]),
        new MagicRule('application/x-gameboy-rom', 50, 325, [
            new MagicMatch(260, 261, "\xCE\xEDff\xCC\r\x00\v\x03s\x00\x83\x00\f\x00\r\x00\x08\x11\x1F\x88\x89\x00\x0E", '', 0, [new MagicMatch(323, 324, "\x00", "\x80", 0)]),
        ]),
        new MagicRule('application/x-gamecube-rom', 50, 33, [
            new MagicMatch(28, 29, "\xC23\x9F=", '', 0),
        ]),
        new MagicRule('application/x-gdbm', 50, 5, [
            new MagicMatch(0, 1, "\x13W\x9A\xCE", '', 0),
            new MagicMatch(0, 1, "\xCE\x9AW\x13", '', 0),
            new MagicMatch(0, 1, 'GDBM', '', 0),
        ]),
        new MagicRule('application/x-gedcom', 50, 7, [
            new MagicMatch(0, 1, '0 HEAD', '', 0),
        ]),
        new MagicRule('application/x-genesis-32x-rom', 50, 265, [
            new MagicMatch(256, 257, 'SEGA 32X', '', 0),
        ]),
        new MagicRule('application/x-genesis-rom', 50, 645, [
            new MagicMatch(256, 257, 'SEGA GENESIS', '', 0),
            new MagicMatch(256, 257, 'SEGA MEGA DRIVE', '', 0),
            new MagicMatch(256, 257, 'SEGA_MEGA_DRIVE', '', 0),
            new MagicMatch(640, 641, 'EAGN', '', 0),
            new MagicMatch(640, 641, 'EAMG', '', 0),
        ]),
        new MagicRule('application/x-gettext-translation', 50, 5, [
            new MagicMatch(0, 1, "\xDE\x12\x04\x95", '', 0),
            new MagicMatch(0, 1, "\x95\x04\x12\xDE", '', 0),
        ]),
        new MagicRule('application/x-glade', 50, 272, [
            new MagicMatch(0, 256, '<glade-interface', '', 0),
        ]),
        new MagicRule('application/x-gnumeric', 50, 76, [
            new MagicMatch(0, 64, 'gmr:Workbook', '', 0),
            new MagicMatch(0, 64, 'gnm:Workbook', '', 0),
        ]),
        new MagicRule('application/x-go-sgf', 50, 8, [
            new MagicMatch(0, 1, '(;FF[3]', '', 0),
            new MagicMatch(0, 1, '(;FF[4]', '', 0),
        ]),
        new MagicRule('application/x-godot-resource', 50, 14, [
            new MagicMatch(0, 1, '[gd_resource ', '', 0),
        ]),
        new MagicRule('application/x-godot-scene', 50, 11, [
            new MagicMatch(0, 1, '[gd_scene ', '', 0),
        ]),
        new MagicRule('application/x-gtk-builder', 50, 266, [
            new MagicMatch(0, 256, '<interface', '', 0),
        ]),
        new MagicRule('application/x-gtktalog', 50, 14, [
            new MagicMatch(4, 5, 'gtktalog ', '', 0),
        ]),
        new MagicRule('application/x-hdf', 50, 9, [
            new MagicMatch(0, 1, "\x89HDF\r\n\x1A\n", '', 0),
            new MagicMatch(0, 1, "\x0E\x03\x13\x01", '', 0),
        ]),
        new MagicRule('application/x-hfe-floppy-image', 50, 9, [
            new MagicMatch(0, 1, 'HXCPICFE', '', 0),
        ]),
        new MagicRule('application/x-hwp', 50, 18, [
            new MagicMatch(0, 1, 'HWP Document File', '', 0),
        ]),
        new MagicRule('application/x-ipod-firmware', 50, 8, [
            new MagicMatch(0, 1, 'S T O P', '', 0),
        ]),
        new MagicRule('application/x-ips-patch', 50, 6, [
            new MagicMatch(0, 1, 'PATCH', '', 0),
        ]),
        new MagicRule('application/x-ipynb+json', 50, 264, [
            new MagicMatch(0, 1, '{', '', 0, [new MagicMatch(1, 256, '"cells":', '', 0)]),
        ]),
        new MagicRule('application/x-iso9660-appimage', 50, 12, [
            new MagicMatch(1, 2, 'ELF', '', 0, [new MagicMatch(8, 9, 'A', '', 0, [new MagicMatch(9, 10, 'I', '', 0, [new MagicMatch(10, 11, "\x01", '', 0)])])]),
        ]),
        new MagicRule('application/x-it87', 50, 6, [
            new MagicMatch(0, 1, 'IT8.7', '', 0),
        ]),
        new MagicRule('application/x-java', 50, 5, [
            new MagicMatch(0, 1, "\xCA\xFE\xBA\xBE", '', 0),
        ]),
        new MagicRule('application/x-java-jce-keystore', 50, 5, [
            new MagicMatch(0, 1, "\xCE\xCE\xCE\xCE", '', 4|$swap),
        ]),
        new MagicRule('application/x-java-jnlp-file', 50, 261, [
            new MagicMatch(0, 256, '<jnlp', '', 0),
        ]),
        new MagicRule('application/x-java-keystore', 50, 5, [
            new MagicMatch(0, 1, "\xFE\xED\xFE\xED", '', 0),
        ]),
        new MagicRule('application/x-kspread-crypt', 50, 5, [
            new MagicMatch(0, 1, "\r\x1A'\x02", '', 0),
        ]),
        new MagicRule('application/x-ksysv-package', 50, 17, [
            new MagicMatch(4, 5, 'KSysV', '', 0, [new MagicMatch(15, 16, "\x01", '', 0)]),
        ]),
        new MagicRule('application/x-kword-crypt', 50, 5, [
            new MagicMatch(0, 1, "\r\x1A'\x01", '', 0),
        ]),
        new MagicRule('application/x-lyx', 50, 5, [
            new MagicMatch(0, 1, '#LyX', '', 0),
        ]),
        new MagicRule('application/x-macbinary', 50, 107, [
            new MagicMatch(102, 103, 'mBIN', '', 0),
        ]),
        new MagicRule('application/x-mame-chd', 50, 9, [
            new MagicMatch(0, 1, 'MComprHD', '', 0),
        ]),
        new MagicRule('application/x-matroska', 50, 83, [
            new MagicMatch(0, 1, "\x1AE\xDF\xA3", '', 0, [new MagicMatch(5, 65, "B\x82", '', 0, [new MagicMatch(8, 75, 'matroska', '', 0)])]),
        ]),
        new MagicRule('application/x-ms-dos-executable', 50, 3, [
            new MagicMatch(0, 1, 'MZ', '', 0),
        ]),
        new MagicRule('application/x-ms-wim', 50, 9, [
            new MagicMatch(0, 1, "MSWIM\x00\x00\x00", '', 0),
        ]),
        new MagicRule('application/x-mswinurl', 50, 20, [
            new MagicMatch(1, 2, 'InternetShortcut', '', 0),
            new MagicMatch(1, 2, 'DEFAULT', '', 0, [new MagicMatch(11, 12, 'BASEURL=', '', 0)]),
        ]),
        new MagicRule('application/x-n64-rom', 50, 5, [
            new MagicMatch(0, 1, "\x807\x12@", '', 0),
            new MagicMatch(0, 1, "7\x80@\x12", '', 0),
            new MagicMatch(0, 1, "@\x127\x80", '', 0),
        ]),
        new MagicRule('application/x-nautilus-link', 50, 62, [
            new MagicMatch(0, 32, '<nautilus_object nautilus_link', '', 0),
        ]),
        new MagicRule('application/x-navi-animation', 50, 13, [
            new MagicMatch(0, 1, 'RIFF', '', 0, [new MagicMatch(8, 9, 'ACON', '', 0)]),
        ]),
        new MagicRule('application/x-neo-geo-pocket-color-rom', 50, 37, [
            new MagicMatch(35, 36, "\x10", '', 0, [new MagicMatch(0, 1, 'COPYRIGHT BY SNK CORPORATION', '', 0), new MagicMatch(0, 1, ' LICENSED BY SNK CORPORATION', '', 0)]),
        ]),
        new MagicRule('application/x-neo-geo-pocket-rom', 50, 37, [
            new MagicMatch(35, 36, "\x00", '', 0, [new MagicMatch(0, 1, 'COPYRIGHT BY SNK CORPORATION', '', 0), new MagicMatch(0, 1, ' LICENSED BY SNK CORPORATION', '', 0)]),
        ]),
        new MagicRule('application/x-netshow-channel', 50, 10, [
            new MagicMatch(0, 1, '[Address]', '', 0),
        ]),
        new MagicRule('application/x-nintendo-3ds-rom', 50, 261, [
            new MagicMatch(256, 257, 'NCSD', '', 0),
        ]),
        new MagicRule('application/x-object', 50, 19, [
            new MagicMatch(0, 1, "\x7FELF", '', 0, [new MagicMatch(5, 6, "\x01", '', 0, [new MagicMatch(16, 17, "\x01\x00", '', 0)])]),
            new MagicMatch(0, 1, "\x7FELF", '', 0, [new MagicMatch(5, 6, "\x02", '', 0, [new MagicMatch(16, 17, "\x00\x01", '', 0)])]),
        ]),
        new MagicRule('application/x-ole-storage', 50, 9, [
            new MagicMatch(0, 1, "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1", '', 0),
            new MagicMatch(0, 1, "\xD0\xCF\x11\xE0", '', 0),
        ]),
        new MagicRule('application/x-oleo', 50, 36, [
            new MagicMatch(31, 32, 'Oleo', '', 0),
        ]),
        new MagicRule('application/x-openzim', 50, 5, [
            new MagicMatch(0, 1, "ZIM\x04", '', 0),
        ]),
        new MagicRule('application/x-pef-executable', 50, 5, [
            new MagicMatch(0, 1, 'Joy!', '', 0),
        ]),
        new MagicRule('application/x-perl', 50, 266, [
            new MagicMatch(0, 1, 'eval "exec /usr/local/bin/perl', '', 0),
            new MagicMatch(2, 16, '/bin/perl', '', 0),
            new MagicMatch(2, 16, '/bin/env perl', '', 0),
            new MagicMatch(0, 256, 'use Test::', '', 0),
        ]),
        new MagicRule('application/x-pocket-word', 50, 6, [
            new MagicMatch(0, 1, '{\\pwi', '', 0),
        ]),
        new MagicRule('application/x-pyspread-spreadsheet', 50, 29, [
            new MagicMatch(0, 1, '[Pyspread save file version]', '', 0),
        ]),
        new MagicRule('application/x-python-bytecode', 50, 5, [
            new MagicMatch(0, 1, "\x99N\r\n", '', 0),
        ]),
        new MagicRule('application/x-qed-disk', 50, 5, [
            new MagicMatch(0, 1, "QED\x00", '', 0),
        ]),
        new MagicRule('application/x-qemu-disk', 50, 5, [
            new MagicMatch(0, 1, 'QFI', '', 0, [new MagicMatch(3, 4, "\xFB", '', 0)]),
        ]),
        new MagicRule('application/x-qtiplot', 50, 8, [
            new MagicMatch(0, 1, 'QtiPlot', '', 0),
        ]),
        new MagicRule('application/x-rpm', 50, 5, [
            new MagicMatch(0, 1, "\xED\xAB\xEE\xDB", '', 0),
        ]),
        new MagicRule('application/x-ruby', 50, 29, [
            new MagicMatch(2, 16, '/bin/env ruby', '', 0),
            new MagicMatch(2, 16, '/bin/ruby', '', 0),
        ]),
        new MagicRule('application/x-sami', 50, 262, [
            new MagicMatch(0, 256, '<SAMI>', '', 0),
        ]),
        new MagicRule('application/x-saturn-rom', 50, 32, [
            new MagicMatch(0, 1, 'SEGA SEGASATURN', '', 0),
            new MagicMatch(16, 17, 'SEGA SEGASATURN', '', 0),
        ]),
        new MagicRule('application/x-sc', 50, 50, [
            new MagicMatch(38, 39, 'Spreadsheet', '', 0),
        ]),
        new MagicRule('application/x-sega-pico-rom', 50, 266, [
            new MagicMatch(256, 257, 'SEGA PICO', '', 0),
        ]),
        new MagicRule('application/x-sharedlib', 50, 25, [
            new MagicMatch(0, 1, "\x83\x01", '', 0, [new MagicMatch(22, 23, "\x00 ", "\x000", 0)]),
        ]),
        new MagicRule('application/x-shellscript', 50, 36, [
            new MagicMatch(10, 11, '# This is a shell archive', '', 0),
            new MagicMatch(2, 16, '/bin/bash', '', 0),
            new MagicMatch(2, 16, '/bin/nawk', '', 0),
            new MagicMatch(2, 16, '/bin/zsh', '', 0),
            new MagicMatch(2, 16, '/bin/sh', '', 0),
            new MagicMatch(2, 16, '/bin/ksh', '', 0),
            new MagicMatch(2, 16, '/bin/dash', '', 0),
            new MagicMatch(2, 16, '/bin/env sh', '', 0),
            new MagicMatch(2, 16, '/bin/env bash', '', 0),
            new MagicMatch(2, 16, '/bin/env zsh', '', 0),
            new MagicMatch(2, 16, '/bin/env ksh', '', 0),
        ]),
        new MagicRule('application/x-shorten', 50, 5, [
            new MagicMatch(0, 1, 'ajkg', '', 0),
        ]),
        new MagicRule('application/x-spss-por', 50, 61, [
            new MagicMatch(40, 41, 'ASCII SPSS PORT FILE', '', 0),
        ]),
        new MagicRule('application/x-spss-sav', 50, 5, [
            new MagicMatch(0, 1, '$FL2', '', 0),
            new MagicMatch(0, 1, '$FL3', '', 0),
        ]),
        new MagicRule('application/x-sqlite2', 50, 32, [
            new MagicMatch(0, 1, '** This file contains an SQLite', '', 0),
        ]),
        new MagicRule('application/x-subrip', 50, 261, [
            new MagicMatch(0, 1, '1', '', 0, [new MagicMatch(0, 256, ' --> ', '', 0)]),
        ]),
        new MagicRule('application/x-t602', 50, 6, [
            new MagicMatch(0, 1, '@CT 0', '', 0),
            new MagicMatch(0, 1, '@CT 1', '', 0),
            new MagicMatch(0, 1, '@CT 2', '', 0),
        ]),
        new MagicRule('application/x-tgif', 50, 6, [
            new MagicMatch(0, 1, '%TGIF', '', 0),
        ]),
        new MagicRule('application/x-thomson-sap-image', 50, 67, [
            new MagicMatch(1, 2, 'SYSTEME D\'ARCHIVAGE PUKALL S.A.P. (c) Alexandre PUKALL Avril 1998', '', 0),
        ]),
        new MagicRule('application/x-vdi-disk', 50, 41, [
            new MagicMatch(0, 1, "<<< QEMU VM Virtual Disk Image >>>\n", '', 0),
            new MagicMatch(0, 1, "<<< Oracle VM VirtualBox Disk Image >>>\n", '', 0),
            new MagicMatch(0, 1, "<<< Sun VirtualBox Disk Image >>>\n", '', 0),
            new MagicMatch(0, 1, "<<< Sun xVM VirtualBox Disk Image >>>\n", '', 0),
            new MagicMatch(0, 1, '<<< innotek VirtualBox Disk Image >>>', '', 0),
            new MagicMatch(0, 1, "<<< CloneVDI VirtualBox Disk Image >>>\n", '', 0),
        ]),
        new MagicRule('application/x-vhd-disk', 50, 9, [
            new MagicMatch(0, 1, 'conectix', '', 0),
        ]),
        new MagicRule('application/x-vhdx-disk', 50, 9, [
            new MagicMatch(0, 1, 'vhdxfile', '', 0),
        ]),
        new MagicRule('application/x-vmdk-disk', 50, 9, [
            new MagicMatch(0, 1, "KDMV\x01\x00\x00\x00", '', 0),
            new MagicMatch(0, 1, "KDMV\x02\x00\x00\x00", '', 0),
        ]),
        new MagicRule('application/x-wii-rom', 50, 29, [
            new MagicMatch(24, 25, "]\x1C\x9E\xA3", '', 0),
            new MagicMatch(0, 1, 'WBFS', '', 0),
            new MagicMatch(0, 1, "WII\x01DISC", '', 0),
        ]),
        new MagicRule('application/x-wii-wad', 50, 9, [
            new MagicMatch(4, 5, "Is\x00\x00", '', 0),
            new MagicMatch(4, 5, "ib\x00\x00", '', 0),
            new MagicMatch(4, 5, "Bk\x00\x00", '', 0),
        ]),
        new MagicRule('application/x-x509-ca-cert', 50, 36, [
            new MagicMatch(0, 1, '-----BEGIN CA CERTIFICATE-----', '', 0),
            new MagicMatch(0, 1, '-----BEGIN TRUSTED CERTIFICATE-----', '', 0),
        ]),
        new MagicRule('application/x-xbel', 50, 270, [
            new MagicMatch(0, 256, '<!DOCTYPE xbel', '', 0),
        ]),
        new MagicRule('application/x-yaml', 50, 6, [
            new MagicMatch(0, 1, '%YAML', '', 0),
        ]),
        new MagicRule('application/xslt+xml', 50, 271, [
            new MagicMatch(0, 256, '<xsl:stylesheet', '', 0),
        ]),
        new MagicRule('application/xspf+xml', 50, 84, [
            new MagicMatch(0, 64, '<playlist version="1', '', 0),
            new MagicMatch(0, 64, '<playlist version=\'1', '', 0),
        ]),
        new MagicRule('audio/AMR', 50, 13, [
            new MagicMatch(0, 1, "#!AMR\n", '', 0),
            new MagicMatch(0, 1, "#!AMR_MC1.0\n", '', 0),
        ]),
        new MagicRule('audio/AMR-WB', 50, 16, [
            new MagicMatch(0, 1, "#!AMR-WB\n", '', 0),
            new MagicMatch(0, 1, "#!AMR-WB_MC1.0\n", '', 0),
        ]),
        new MagicRule('audio/aac', 50, 5, [
            new MagicMatch(0, 1, 'ADIF', '', 0),
            new MagicMatch(0, 1, "\xFF\xF0", "\xFF\xF6", 0),
        ]),
        new MagicRule('audio/ac3', 50, 3, [
            new MagicMatch(0, 1, "\vw", '', 0),
        ]),
        new MagicRule('audio/annodex', 50, 520, [
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(28, 29, "fishead\x00", '', 0, [new MagicMatch(56, 512, "CMML\x00\x00\x00\x00", '', 0)])]),
        ]),
        new MagicRule('audio/flac', 50, 5, [
            new MagicMatch(0, 1, 'fLaC', '', 0),
        ]),
        new MagicRule('audio/midi', 50, 5, [
            new MagicMatch(0, 1, 'MThd', '', 0),
        ]),
        new MagicRule('audio/mobile-xmf', 50, 13, [
            new MagicMatch(0, 1, "XMF_2.00\x00\x00\x00\x02", '', 0),
        ]),
        new MagicRule('audio/mp4', 50, 12, [
            new MagicMatch(4, 5, 'ftypM4A', '', 0),
        ]),
        new MagicRule('audio/mpeg', 50, 4, [
            new MagicMatch(0, 1, "\xFF\xFA", '', 0),
            new MagicMatch(0, 1, "\xFF\xFB", '', 0),
            new MagicMatch(0, 1, "\xFF\xF3", '', 0),
            new MagicMatch(0, 1, "\xFF\xF2", '', 0),
            new MagicMatch(0, 1, "\xFF\xE3", '', 0),
            new MagicMatch(0, 1, "\xFF\xE2", '', 0),
            new MagicMatch(0, 1, 'ID3', '', 0),
        ]),
        new MagicRule('audio/ogg', 50, 5, [
            new MagicMatch(0, 1, 'OggS', '', 0),
        ]),
        new MagicRule('audio/prs.sid', 50, 5, [
            new MagicMatch(0, 1, 'PSID', '', 0),
        ]),
        new MagicRule('audio/vnd.audible.aax', 50, 13, [
            new MagicMatch(4, 5, 'ftypaax ', '', 0),
        ]),
        new MagicRule('audio/vnd.dts', 50, 5, [
            new MagicMatch(0, 1, "\x7F\xFE\x80\x01", '', 0),
            new MagicMatch(0, 1, "\x80\x01\x7F\xFE", '', 0),
            new MagicMatch(0, 1, "\x1F\xFF\xE8\x00", '', 0),
            new MagicMatch(0, 1, "\xE8\x00\x1F\xFF", '', 0),
        ]),
        new MagicRule('audio/x-adpcm', 50, 17, [
            new MagicMatch(0, 1, '.snd', '', 0, [new MagicMatch(12, 13, "\x00\x00\x00\x17", '', 0)]),
            new MagicMatch(0, 1, ".sd\x00", '', 0, [new MagicMatch(12, 13, "\x01\x00\x00\x00", '', 0), new MagicMatch(12, 13, "\x02\x00\x00\x00", '', 0), new MagicMatch(12, 13, "\x03\x00\x00\x00", '', 0), new MagicMatch(12, 13, "\x04\x00\x00\x00", '', 0), new MagicMatch(12, 13, "\x05\x00\x00\x00", '', 0), new MagicMatch(12, 13, "\x06\x00\x00\x00", '', 0), new MagicMatch(12, 13, "\x07\x00\x00\x00", '', 0), new MagicMatch(12, 13, "\x17\x00\x00\x00", '', 0)]),
        ]),
        new MagicRule('audio/x-aifc', 50, 13, [
            new MagicMatch(8, 9, 'AIFC', '', 0),
        ]),
        new MagicRule('audio/x-aiff', 50, 13, [
            new MagicMatch(8, 9, 'AIFF', '', 0),
            new MagicMatch(8, 9, '8SVX', '', 0),
        ]),
        new MagicRule('audio/x-ape', 50, 5, [
            new MagicMatch(0, 1, 'MAC ', '', 0),
        ]),
        new MagicRule('audio/x-dff', 50, 17, [
            new MagicMatch(0, 1, 'FRM8', '', 0, [new MagicMatch(12, 13, 'DSD ', '', 0)]),
        ]),
        new MagicRule('audio/x-dsf', 50, 85, [
            new MagicMatch(0, 1, 'DSD ', '', 0, [new MagicMatch(28, 29, 'fmt ', '', 0, [new MagicMatch(80, 81, 'data', '', 0)])]),
        ]),
        new MagicRule('audio/x-iriver-pla', 50, 19, [
            new MagicMatch(4, 5, 'iriver UMS PLA', '', 0),
        ]),
        new MagicRule('audio/x-it', 50, 5, [
            new MagicMatch(0, 1, 'IMPM', '', 0),
        ]),
        new MagicRule('audio/x-m4b', 50, 12, [
            new MagicMatch(4, 5, 'ftypM4B', '', 0),
        ]),
        new MagicRule('audio/x-mo3', 50, 4, [
            new MagicMatch(0, 1, 'MO3', '', 0),
        ]),
        new MagicRule('audio/x-mpegurl', 50, 8, [
            new MagicMatch(0, 1, '#EXTM3U', '', 0),
        ]),
        new MagicRule('audio/x-musepack', 50, 5, [
            new MagicMatch(0, 1, 'MP+', '', 0),
            new MagicMatch(0, 1, 'MPCK', '', 0),
        ]),
        new MagicRule('audio/x-pn-audibleaudio', 50, 9, [
            new MagicMatch(4, 5, "W\x90u6", '', 0),
        ]),
        new MagicRule('audio/x-psf', 50, 4, [
            new MagicMatch(0, 1, 'PSF', '', 0),
        ]),
        new MagicRule('audio/x-s3m', 50, 49, [
            new MagicMatch(44, 45, 'SCRM', '', 0),
        ]),
        new MagicRule('audio/x-scpls', 50, 11, [
            new MagicMatch(0, 1, '[playlist]', '', 0),
            new MagicMatch(0, 1, '[Playlist]', '', 0),
            new MagicMatch(0, 1, '[PLAYLIST]', '', 0),
        ]),
        new MagicRule('audio/x-speex', 50, 6, [
            new MagicMatch(0, 1, 'Speex', '', 0),
        ]),
        new MagicRule('audio/x-stm', 50, 30, [
            new MagicMatch(20, 21, "!Scream!\x1A", '', 0),
            new MagicMatch(20, 21, "!SCREAM!\x1A", '', 0),
            new MagicMatch(20, 21, "BMOD2STM\x1A", '', 0),
        ]),
        new MagicRule('audio/x-tak', 50, 5, [
            new MagicMatch(0, 1, 'tBaK', '', 0),
        ]),
        new MagicRule('audio/x-tta', 50, 5, [
            new MagicMatch(0, 1, 'TTA1', '', 0),
        ]),
        new MagicRule('audio/x-wav', 50, 13, [
            new MagicMatch(8, 9, 'WAVE', '', 0),
            new MagicMatch(8, 9, 'WAV ', '', 0),
        ]),
        new MagicRule('audio/x-wavpack', 50, 5, [
            new MagicMatch(0, 1, 'wvpk', '', 0),
        ]),
        new MagicRule('audio/x-wavpack-correction', 50, 5, [
            new MagicMatch(0, 1, 'wvpk', '', 0),
        ]),
        new MagicRule('audio/x-xi', 50, 21, [
            new MagicMatch(0, 1, 'Extended Instrument:', '', 0),
        ]),
        new MagicRule('audio/x-xm', 50, 17, [
            new MagicMatch(0, 1, 'Extended Module:', '', 0),
        ]),
        new MagicRule('audio/x-xmf', 50, 5, [
            new MagicMatch(0, 1, 'XMF_', '', 0),
        ]),
        new MagicRule('font/otf', 50, 5, [
            new MagicMatch(0, 1, 'OTTO', '', 0),
        ]),
        new MagicRule('font/ttf', 50, 70, [
            new MagicMatch(0, 1, 'FFIL', '', 0),
            new MagicMatch(65, 66, 'FFIL', '', 0),
            new MagicMatch(0, 1, "\x00\x01\x00\x00\x00", '', 0),
        ]),
        new MagicRule('font/woff', 50, 5, [
            new MagicMatch(0, 1, 'wOFF', '', 0),
        ]),
        new MagicRule('font/woff2', 50, 5, [
            new MagicMatch(0, 1, 'wOF2', '', 0),
        ]),
        new MagicRule('image/avif', 50, 29, [
            new MagicMatch(4, 5, 'ftypavif', '', 0),
            new MagicMatch(4, 5, 'ftypavis', '', 0),
            new MagicMatch(4, 5, 'ftypmif1', '', 0, [new MagicMatch(16, 17, 'avif', '', 0), new MagicMatch(20, 21, 'avif', '', 0), new MagicMatch(24, 25, 'avif', '', 0)]),
        ]),
        new MagicRule('image/bmp', 50, 16, [
            new MagicMatch(0, 1, "BMxxxx\x00\x00", "\xFF\xFF\x00\x00\x00\x00\xFF\xFF", 0),
            new MagicMatch(0, 1, 'BM', '', 0, [new MagicMatch(14, 15, "\f", '', 0), new MagicMatch(14, 15, '@', '', 0), new MagicMatch(14, 15, '(', '', 0)]),
        ]),
        new MagicRule('image/dpx', 50, 5, [
            new MagicMatch(0, 1, 'SDPX', '', 0),
        ]),
        new MagicRule('image/emf', 50, 61, [
            new MagicMatch(0, 1, "\x01\x00\x00\x00", '', 0, [new MagicMatch(40, 41, ' EMF', '', 0, [new MagicMatch(44, 45, "\x00\x00\x01\x00", '', 0, [new MagicMatch(58, 59, "\x00\x00", '', 0)])])]),
        ]),
        new MagicRule('image/gif', 50, 5, [
            new MagicMatch(0, 1, 'GIF8', '', 0),
        ]),
        new MagicRule('image/jp2', 50, 25, [
            new MagicMatch(0, 1, "\x00\x00\x00\fjP  \r\n\x87\n        jp2 ", "\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\xFF\xFF\xFF\xFF", 0),
        ]),
        new MagicRule('image/jpeg', 50, 4, [
            new MagicMatch(0, 1, "\xFF\xD8\xFF", '', 0),
            new MagicMatch(0, 1, "\xFF\xD8", '', 0),
        ]),
        new MagicRule('image/jpm', 50, 25, [
            new MagicMatch(0, 1, "\x00\x00\x00\fjP  \r\n\x87\n        jpm ", "\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\xFF\xFF\xFF\xFF", 0),
        ]),
        new MagicRule('image/jpx', 50, 25, [
            new MagicMatch(0, 1, "\x00\x00\x00\fjP  \r\n\x87\n        jpx ", "\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\xFF\xFF\xFF\xFF", 0),
        ]),
        new MagicRule('image/jxl', 50, 13, [
            new MagicMatch(0, 1, "\xFF\n", '', 0),
            new MagicMatch(0, 1, "\x00\x00\x00\fJXL \r\n\x87\n", '', 0),
        ]),
        new MagicRule('image/png', 50, 5, [
            new MagicMatch(0, 1, "\x89PNG", '', 0),
        ]),
        new MagicRule('image/tiff', 50, 5, [
            new MagicMatch(0, 1, "MM\x00*", '', 0),
            new MagicMatch(0, 1, "II*\x00", '', 0),
        ]),
        new MagicRule('image/vnd.adobe.photoshop', 50, 11, [
            new MagicMatch(0, 1, "8BPS  \x00\x00\x00\x00", "\xFF\xFF\xFF\xFF\x00\x00\xFF\xFF\xFF\xFF", 0),
        ]),
        new MagicRule('image/vnd.dxf', 50, 74, [
            new MagicMatch(0, 64, "\nHEADER\n", '', 0),
            new MagicMatch(0, 64, "\r\nHEADER\r\n", '', 0),
        ]),
        new MagicRule('image/vnd.microsoft.icon', 50, 7, [
            new MagicMatch(0, 1, "\x00\x00\x01\x00", '', 0, [new MagicMatch(5, 6, "\x00", '', 0)]),
        ]),
        new MagicRule('image/vnd.ms-modi', 50, 5, [
            new MagicMatch(0, 1, "EP*\x00", '', 0),
        ]),
        new MagicRule('image/vnd.zbrush.pcx', 50, 3, [
            new MagicMatch(0, 1, "\n", '', 0, [new MagicMatch(1, 2, "\x00", '', 0), new MagicMatch(1, 2, "\x02", '', 0), new MagicMatch(1, 2, "\x03", '', 0), new MagicMatch(1, 2, "\x05", '', 0)]),
        ]),
        new MagicRule('image/webp', 50, 13, [
            new MagicMatch(0, 1, 'RIFF', '', 0, [new MagicMatch(8, 9, 'WEBP', '', 0)]),
        ]),
        new MagicRule('image/wmf', 50, 27, [
            new MagicMatch(0, 1, "\xD7\xCD\xC6\x9A", '', 0, [new MagicMatch(22, 23, "\x01\x00", '', 0, [new MagicMatch(24, 25, "\t\x00", '', 0)])]),
            new MagicMatch(0, 1, "\x01\x00", '', 0, [new MagicMatch(2, 3, "\t\x00", '', 0)]),
        ]),
        new MagicRule('image/x-applix-graphics', 50, 16, [
            new MagicMatch(0, 1, '*BEGIN', '', 0, [new MagicMatch(7, 8, 'GRAPHICS', '', 0)]),
        ]),
        new MagicRule('image/x-canon-crw', 50, 15, [
            new MagicMatch(0, 1, "II\x1A\x00\x00\x00HEAPCCDR", '', 0),
        ]),
        new MagicRule('image/x-dds', 50, 4, [
            new MagicMatch(0, 1, 'DDS', '', 0),
        ]),
        new MagicRule('image/x-dib', 50, 5, [
            new MagicMatch(0, 1, "(\x00\x00\x00", '', 0),
        ]),
        new MagicRule('image/x-exr', 50, 5, [
            new MagicMatch(0, 1, "v/1\x01", '', 0),
        ]),
        new MagicRule('image/x-fpx', 50, 5, [
            new MagicMatch(0, 1, 'FPix', '', 0),
        ]),
        new MagicRule('image/x-fuji-raf', 50, 17, [
            new MagicMatch(0, 1, 'FUJIFILMCCD-RAW ', '', 0),
        ]),
        new MagicRule('image/x-gimp-gbr', 50, 25, [
            new MagicMatch(20, 21, 'GIMP', '', 0),
        ]),
        new MagicRule('image/x-gimp-pat', 50, 25, [
            new MagicMatch(20, 21, 'GPAT', '', 0),
        ]),
        new MagicRule('image/x-icns', 50, 5, [
            new MagicMatch(0, 1, 'icns', '', 0),
        ]),
        new MagicRule('image/x-ilbm', 50, 13, [
            new MagicMatch(8, 9, 'ILBM', '', 0),
            new MagicMatch(8, 9, 'PBM ', '', 0),
        ]),
        new MagicRule('image/x-jp2-codestream', 50, 5, [
            new MagicMatch(0, 1, "\xFFO\xFFQ", '', 0),
        ]),
        new MagicRule('image/x-minolta-mrw', 50, 5, [
            new MagicMatch(0, 1, "\x00MRM", '', 0),
        ]),
        new MagicRule('image/x-olympus-orf', 50, 9, [
            new MagicMatch(0, 1, "IIRO\x08\x00\x00\x00", '', 0),
        ]),
        new MagicRule('image/x-panasonic-rw', 50, 9, [
            new MagicMatch(0, 1, "IIU\x00\x08\x00\x00\x00", '', 0),
        ]),
        new MagicRule('image/x-panasonic-rw2', 50, 9, [
            new MagicMatch(0, 1, "IIU\x00\x18\x00\x00\x00", '', 0),
        ]),
        new MagicRule('image/x-pict', 50, 19, [
            new MagicMatch(10, 11, "\x00\x11", '', 0, [new MagicMatch(12, 13, "\x02\xFF", '', 0, [new MagicMatch(14, 15, "\f\x00", '', 0, [new MagicMatch(16, 17, "\xFF\xFE", '', 0)])])]),
        ]),
        new MagicRule('image/x-pict', 50, 531, [
            new MagicMatch(522, 523, "\x00\x11", '', 0, [new MagicMatch(524, 525, "\x02\xFF", '', 0, [new MagicMatch(526, 527, "\f\x00", '', 0, [new MagicMatch(528, 529, "\xFF\xFE", '', 0)])])]),
        ]),
        new MagicRule('image/x-portable-bitmap', 50, 4, [
            new MagicMatch(0, 1, 'P1', '', 0, [new MagicMatch(2, 3, "\n", '', 0), new MagicMatch(2, 3, ' ', '', 0), new MagicMatch(2, 3, "\t", '', 0), new MagicMatch(2, 3, "\r", '', 0)]),
            new MagicMatch(0, 1, 'P4', '', 0, [new MagicMatch(2, 3, "\n", '', 0), new MagicMatch(2, 3, ' ', '', 0), new MagicMatch(2, 3, "\t", '', 0), new MagicMatch(2, 3, "\r", '', 0)]),
        ]),
        new MagicRule('image/x-portable-graymap', 50, 4, [
            new MagicMatch(0, 1, 'P2', '', 0, [new MagicMatch(2, 3, "\n", '', 0), new MagicMatch(2, 3, ' ', '', 0), new MagicMatch(2, 3, "\t", '', 0), new MagicMatch(2, 3, "\r", '', 0)]),
            new MagicMatch(0, 1, 'P5', '', 0, [new MagicMatch(2, 3, "\n", '', 0), new MagicMatch(2, 3, ' ', '', 0), new MagicMatch(2, 3, "\t", '', 0), new MagicMatch(2, 3, "\r", '', 0)]),
        ]),
        new MagicRule('image/x-portable-pixmap', 50, 4, [
            new MagicMatch(0, 1, 'P3', '', 0, [new MagicMatch(2, 3, "\n", '', 0), new MagicMatch(2, 3, ' ', '', 0), new MagicMatch(2, 3, "\t", '', 0), new MagicMatch(2, 3, "\r", '', 0)]),
            new MagicMatch(0, 1, 'P6', '', 0, [new MagicMatch(2, 3, "\n", '', 0), new MagicMatch(2, 3, ' ', '', 0), new MagicMatch(2, 3, "\t", '', 0), new MagicMatch(2, 3, "\r", '', 0)]),
        ]),
        new MagicRule('image/x-quicktime', 50, 9, [
            new MagicMatch(4, 5, 'idat', '', 0),
        ]),
        new MagicRule('image/x-sigma-x3f', 50, 9, [
            new MagicMatch(0, 1, 'FOVb', '', 0, [new MagicMatch(4, 5, "\xFF\x00\xFF\x00", "\x00\xFF\x00\xFF", 0)]),
        ]),
        new MagicRule('image/x-skencil', 50, 9, [
            new MagicMatch(0, 1, '##Sketch', '', 0),
        ]),
        new MagicRule('image/x-sun-raster', 50, 5, [
            new MagicMatch(0, 1, "Y\xA6j\x95", '', 0),
        ]),
        new MagicRule('image/x-tga', 50, 18, [
            new MagicMatch(1, 2, "\x00\x02", '', 0, [new MagicMatch(16, 17, "\x08", '', 0), new MagicMatch(16, 17, "\x10", '', 0), new MagicMatch(16, 17, "\x18", '', 0), new MagicMatch(16, 17, ' ', '', 0)]),
        ]),
        new MagicRule('image/x-win-bitmap', 50, 7, [
            new MagicMatch(0, 1, "\x00\x00\x02\x00", '', 0, [new MagicMatch(5, 6, "\x00", '', 0)]),
        ]),
        new MagicRule('image/x-xcf', 50, 14, [
            new MagicMatch(0, 1, 'gimp xcf file', '', 0),
            new MagicMatch(0, 1, 'gimp xcf v', '', 0),
        ]),
        new MagicRule('image/x-xcursor', 50, 5, [
            new MagicMatch(0, 1, 'Xcur', '', 0),
        ]),
        new MagicRule('image/x-xfig', 50, 5, [
            new MagicMatch(0, 1, '#FIG', '', 0),
        ]),
        new MagicRule('image/x-xpixmap', 50, 10, [
            new MagicMatch(0, 1, '/* XPM */', '', 0),
            new MagicMatch(0, 1, "! XPM2\n", '', 0),
        ]),
        new MagicRule('message/news', 50, 8, [
            new MagicMatch(0, 1, 'Article', '', 0),
            new MagicMatch(0, 1, 'Path:', '', 0),
            new MagicMatch(0, 1, 'Xref:', '', 0),
        ]),
        new MagicRule('message/rfc822', 50, 15, [
            new MagicMatch(0, 1, '#! rnews', '', 0),
            new MagicMatch(0, 1, 'Forward to', '', 0),
            new MagicMatch(0, 1, 'From:', '', 0),
            new MagicMatch(0, 1, 'N#! rnews', '', 0),
            new MagicMatch(0, 1, 'Pipe to', '', 0),
            new MagicMatch(0, 1, 'Received:', '', 0),
            new MagicMatch(0, 1, 'Relay-Version:', '', 0),
            new MagicMatch(0, 1, 'Return-Path:', '', 0),
            new MagicMatch(0, 1, 'Return-path:', '', 0),
            new MagicMatch(0, 1, 'Subject: ', '', 0),
        ]),
        new MagicRule('model/gltf-binary', 50, 5, [
            new MagicMatch(0, 1, 'glTF', '', 0),
        ]),
        new MagicRule('model/iges', 50, 82, [
            new MagicMatch(72, 73, "S      1\n", '', 0),
            new MagicMatch(72, 73, "S0000001\n", '', 0),
        ]),
        new MagicRule('model/mtl', 50, 263, [
            new MagicMatch(0, 1, '# Blender MTL File: \'', '', 0),
            new MagicMatch(0, 256, 'newmtl ', '', 0),
        ]),
        new MagicRule('model/obj', 50, 263, [
            new MagicMatch(0, 64, ' OBJ File: \'', '', 0),
            new MagicMatch(0, 256, 'mtllib ', '', 0),
        ]),
        new MagicRule('model/stl', 50, 6, [
            new MagicMatch(0, 1, 'solid', '', 0),
            new MagicMatch(0, 1, 'SOLID', '', 0),
        ]),
        new MagicRule('model/vrml', 50, 7, [
            new MagicMatch(0, 1, '#VRML ', '', 0),
        ]),
        new MagicRule('text/cache-manifest', 50, 16, [
            new MagicMatch(0, 1, 'CACHE MANIFEST', '', 0, [new MagicMatch(14, 15, ' ', '', 0), new MagicMatch(14, 15, "\t", '', 0), new MagicMatch(14, 15, "\n", '', 0), new MagicMatch(14, 15, "\r", '', 0)]),
        ]),
        new MagicRule('text/calendar', 50, 16, [
            new MagicMatch(0, 1, 'BEGIN:VCALENDAR', '', 0),
            new MagicMatch(0, 1, 'begin:vcalendar', '', 0),
        ]),
        new MagicRule('text/html', 50, 270, [
            new MagicMatch(0, 256, '<!DOCTYPE HTML', '', 0),
            new MagicMatch(0, 256, '<!doctype html', '', 0),
            new MagicMatch(0, 256, '<!DOCTYPE html', '', 0),
            new MagicMatch(0, 256, '<HEAD', '', 0),
            new MagicMatch(0, 256, '<head', '', 0),
            new MagicMatch(0, 256, '<HTML', '', 0),
            new MagicMatch(0, 256, '<html', '', 0),
            new MagicMatch(0, 256, '<SCRIPT', '', 0),
            new MagicMatch(0, 256, '<script', '', 0),
            new MagicMatch(0, 1, '<BODY', '', 0),
            new MagicMatch(0, 1, '<body', '', 0),
            new MagicMatch(0, 1, '<h1', '', 0),
            new MagicMatch(0, 1, '<H1', '', 0),
            new MagicMatch(0, 1, '<!doctype HTML', '', 0),
        ]),
        new MagicRule('text/javascript', 50, 30, [
            new MagicMatch(0, 1, '#!/bin/gjs', '', 0),
            new MagicMatch(0, 1, '#! /bin/gjs', '', 0),
            new MagicMatch(0, 1, 'eval "exec /bin/gjs', '', 0),
            new MagicMatch(0, 1, '#!/usr/bin/gjs', '', 0),
            new MagicMatch(0, 1, '#! /usr/bin/gjs', '', 0),
            new MagicMatch(0, 1, 'eval "exec /usr/bin/gjs', '', 0),
            new MagicMatch(0, 1, '#!/usr/local/bin/gjs', '', 0),
            new MagicMatch(0, 1, '#! /usr/local/bin/gjs', '', 0),
            new MagicMatch(0, 1, 'eval "exec /usr/local/bin/gjs', '', 0),
            new MagicMatch(2, 16, '/bin/env gjs', '', 0),
        ]),
        new MagicRule('text/plain', 50, 18, [
            new MagicMatch(0, 1, 'This is TeX,', '', 0),
            new MagicMatch(0, 1, 'This is METAFONT,', '', 0),
        ]),
        new MagicRule('text/spreadsheet', 50, 4, [
            new MagicMatch(0, 1, 'ID;', '', 0),
        ]),
        new MagicRule('text/troff', 50, 5, [
            new MagicMatch(0, 1, '.\\"', '', 0),
            new MagicMatch(0, 1, '\'\\"', '', 0),
            new MagicMatch(0, 1, '\'.\\"', '', 0),
            new MagicMatch(0, 1, '\\"', '', 0),
        ]),
        new MagicRule('text/vcard', 50, 12, [
            new MagicMatch(0, 1, 'BEGIN:VCARD', '', 0),
            new MagicMatch(0, 1, 'begin:vcard', '', 0),
        ]),
        new MagicRule('text/vnd.graphviz', 50, 16, [
            new MagicMatch(0, 1, 'digraph ', '', 0),
            new MagicMatch(0, 1, 'strict digraph ', '', 0),
            new MagicMatch(0, 1, 'graph ', '', 0),
            new MagicMatch(0, 1, 'strict graph ', '', 0),
        ]),
        new MagicRule('text/vnd.sun.j2me.app-descriptor', 50, 8, [
            new MagicMatch(0, 1, 'MIDlet-', '', 0),
        ]),
        new MagicRule('text/vnd.trolltech.linguist', 50, 260, [
            new MagicMatch(0, 256, '<TS ', '', 0),
            new MagicMatch(0, 256, '<TS>', '', 0),
        ]),
        new MagicRule('text/vtt', 50, 7, [
            new MagicMatch(0, 1, 'WEBVTT', '', 0),
        ]),
        new MagicRule('text/x-bibtex', 50, 36, [
            new MagicMatch(0, 1, '% This file was created with JabRef', '', 0),
        ]),
        new MagicRule('text/x-dbus-service', 50, 273, [
            new MagicMatch(0, 256, "\n[D-BUS Service]\n", '', 0),
            new MagicMatch(0, 1, "[D-BUS Service]\n", '', 0),
        ]),
        new MagicRule('text/x-devicetree-binary', 50, 5, [
            new MagicMatch(0, 1, "\xD0\r\xFE\xED", '', 0),
        ]),
        new MagicRule('text/x-devicetree-source', 50, 4088, [
            new MagicMatch(0, 1, "\x00\x00", "\x80\x80", 0, [new MagicMatch(0, 4080, '/dts-v1/', '', 0)]),
        ]),
        new MagicRule('text/x-emacs-lisp', 50, 9, [
            new MagicMatch(0, 1, "\n(", '', 0),
            new MagicMatch(0, 1, ";ELC\x13\x00\x00\x00", '', 0),
        ]),
        new MagicRule('text/x-gcode-gx', 50, 11, [
            new MagicMatch(0, 1, 'xgcode 1.0', '', 0),
        ]),
        new MagicRule('text/x-gettext-translation-template', 50, 304, [
            new MagicMatch(0, 256, "#, fuzzy\nmsgid \"\"\nmsgstr \"\"\n\"Project-Id-Version:", '', 0),
        ]),
        new MagicRule('text/x-google-video-pointer', 50, 40, [
            new MagicMatch(0, 1, '#.download.the.free.Google.Video.Player', '', 0),
            new MagicMatch(0, 1, '# download the free Google Video Player', '', 0),
        ]),
        new MagicRule('text/x-iMelody', 50, 14, [
            new MagicMatch(0, 1, 'BEGIN:IMELODY', '', 0),
        ]),
        new MagicRule('text/x-iptables', 50, 279, [
            new MagicMatch(0, 256, '/etc/sysconfig/iptables', '', 0),
            new MagicMatch(0, 256, '*filter', '', 0, [new MagicMatch(0, 256, ':INPUT', '', 0, [new MagicMatch(0, 256, ':FORWARD', '', 0, [new MagicMatch(0, 256, ':OUTPUT', '', 0)])])]),
            new MagicMatch(0, 256, '-A INPUT', '', 0, [new MagicMatch(0, 256, '-A FORWARD', '', 0, [new MagicMatch(0, 256, '-A OUTPUT', '', 0)])]),
            new MagicMatch(0, 256, '-P INPUT', '', 0, [new MagicMatch(0, 256, '-P FORWARD', '', 0, [new MagicMatch(0, 256, '-P OUTPUT', '', 0)])]),
        ]),
        new MagicRule('text/x-ldif', 50, 10, [
            new MagicMatch(0, 1, 'dn: cn=', '', 0),
            new MagicMatch(0, 1, 'dn: mail=', '', 0),
        ]),
        new MagicRule('text/x-lua', 50, 31, [
            new MagicMatch(2, 16, '/bin/lua', '', 0),
            new MagicMatch(2, 16, '/bin/luajit', '', 0),
            new MagicMatch(2, 16, '/bin/env lua', '', 0),
            new MagicMatch(2, 16, '/bin/env luajit', '', 0),
        ]),
        new MagicRule('text/x-makefile', 50, 17, [
            new MagicMatch(0, 1, '#!/usr/bin/make', '', 0),
            new MagicMatch(0, 1, '#! /usr/bin/make', '', 0),
        ]),
        new MagicRule('text/x-matlab', 50, 9, [
            new MagicMatch(0, 1, 'function', '', 0),
        ]),
        new MagicRule('text/x-microdvd', 50, 8, [
            new MagicMatch(0, 1, '{1}', '', 0),
            new MagicMatch(0, 1, '{0}', '', 0),
            new MagicMatch(0, 6, '}{', '', 0),
        ]),
        new MagicRule('text/x-modelica', 50, 9, [
            new MagicMatch(0, 1, 'function', '', 0),
        ]),
        new MagicRule('text/x-modelica', 50, 6, [
            new MagicMatch(0, 1, 'class', '', 0),
        ]),
        new MagicRule('text/x-modelica', 50, 6, [
            new MagicMatch(0, 1, 'model', '', 0),
        ]),
        new MagicRule('text/x-modelica', 50, 7, [
            new MagicMatch(0, 1, 'record', '', 0),
        ]),
        new MagicRule('text/x-mpl2', 50, 8, [
            new MagicMatch(0, 1, '[1]', '', 0),
            new MagicMatch(0, 1, '[0]', '', 0),
            new MagicMatch(0, 6, '][', '', 0),
        ]),
        new MagicRule('text/x-mpsub', 50, 263, [
            new MagicMatch(0, 256, 'FORMAT=', '', 0),
        ]),
        new MagicRule('text/x-mrml', 50, 7, [
            new MagicMatch(0, 1, '<mrml ', '', 0),
        ]),
        new MagicRule('text/x-ms-regedit', 50, 49, [
            new MagicMatch(0, 1, 'REGEDIT', '', 0),
            new MagicMatch(0, 1, 'Windows Registry Editor Version 5.00', '', 0),
            new MagicMatch(0, 1, "\xFF\xFEW\x00i\x00n\x00d\x00o\x00w\x00s\x00 \x00R\x00e\x00g\x00i\x00s\x00t\x00r\x00y\x00 \x00E\x00d\x00i\x00t\x00o\x00r\x00", '', 0),
        ]),
        new MagicRule('text/x-mup', 50, 7, [
            new MagicMatch(0, 1, '//!Mup', '', 0),
        ]),
        new MagicRule('text/x-patch', 50, 24, [
            new MagicMatch(0, 1, "diff\t", '', 0),
            new MagicMatch(0, 1, 'diff ', '', 0),
            new MagicMatch(0, 1, "***\t", '', 0),
            new MagicMatch(0, 1, '*** ', '', 0),
            new MagicMatch(0, 1, '=== ', '', 0),
            new MagicMatch(0, 1, '--- ', '', 0),
            new MagicMatch(0, 1, "Only in\t", '', 0),
            new MagicMatch(0, 1, 'Only in ', '', 0),
            new MagicMatch(0, 1, 'Common subdirectories: ', '', 0),
            new MagicMatch(0, 1, 'Index:', '', 0),
        ]),
        new MagicRule('text/x-python', 50, 33, [
            new MagicMatch(0, 1, '#!/bin/python', '', 0),
            new MagicMatch(0, 1, '#! /bin/python', '', 0),
            new MagicMatch(0, 1, 'eval "exec /bin/python', '', 0),
            new MagicMatch(0, 1, '#!/usr/bin/python', '', 0),
            new MagicMatch(0, 1, '#! /usr/bin/python', '', 0),
            new MagicMatch(0, 1, 'eval "exec /usr/bin/python', '', 0),
            new MagicMatch(0, 1, '#!/usr/local/bin/python', '', 0),
            new MagicMatch(0, 1, '#! /usr/local/bin/python', '', 0),
            new MagicMatch(0, 1, 'eval "exec /usr/local/bin/python', '', 0),
            new MagicMatch(2, 16, '/bin/env python', '', 0),
        ]),
        new MagicRule('text/x-qml', 50, 3010, [
            new MagicMatch(2, 16, '/bin/env qml', '', 0),
            new MagicMatch(0, 3000, 'import Qt', '', 0, [new MagicMatch(9, 3009, '{', '', 0)]),
            new MagicMatch(0, 3000, 'import Qml', '', 0, [new MagicMatch(9, 3009, '{', '', 0)]),
        ]),
        new MagicRule('text/x-rpm-spec', 50, 10, [
            new MagicMatch(0, 1, 'Summary: ', '', 0),
            new MagicMatch(0, 1, '%define ', '', 0),
        ]),
        new MagicRule('text/x-ssa', 50, 269, [
            new MagicMatch(0, 256, '[Script Info]', '', 0),
            new MagicMatch(0, 256, 'Dialogue: ', '', 0),
        ]),
        new MagicRule('text/x-subviewer', 50, 14, [
            new MagicMatch(0, 1, '[INFORMATION]', '', 0),
        ]),
        new MagicRule('text/x-systemd-unit', 50, 269, [
            new MagicMatch(0, 256, "\n[Unit]\n", '', 0),
            new MagicMatch(0, 256, "\n[Install]\n", '', 0),
            new MagicMatch(0, 256, "\n[Automount]\n", '', 0),
            new MagicMatch(0, 256, "\n[Mount]\n", '', 0),
            new MagicMatch(0, 256, "\n[Path]\n", '', 0),
            new MagicMatch(0, 256, "\n[Scope]\n", '', 0),
            new MagicMatch(0, 256, "\n[Service]\n", '', 0),
            new MagicMatch(0, 256, "\n[Slice]\n", '', 0),
            new MagicMatch(0, 256, "\n[Socket]\n", '', 0),
            new MagicMatch(0, 256, "\n[Swap]\n", '', 0),
            new MagicMatch(0, 256, "\n[Timer]\n", '', 0),
            new MagicMatch(0, 1, "[Unit]\n", '', 0),
            new MagicMatch(0, 1, "[Install]\n", '', 0),
            new MagicMatch(0, 1, "[Automount]\n", '', 0),
            new MagicMatch(0, 1, "[Mount]\n", '', 0),
            new MagicMatch(0, 1, "[Path]\n", '', 0),
            new MagicMatch(0, 1, "[Scope]\n", '', 0),
            new MagicMatch(0, 1, "[Service]\n", '', 0),
            new MagicMatch(0, 1, "[Slice]\n", '', 0),
            new MagicMatch(0, 1, "[Socket]\n", '', 0),
            new MagicMatch(0, 1, "[Swap]\n", '', 0),
            new MagicMatch(0, 1, "[Timer]\n", '', 0),
        ]),
        new MagicRule('text/x-tex', 50, 15, [
            new MagicMatch(1, 2, 'documentclass', '', 0),
        ]),
        new MagicRule('text/x-uuencode', 50, 7, [
            new MagicMatch(0, 1, 'begin ', '', 0),
        ]),
        new MagicRule('text/xmcd', 50, 7, [
            new MagicMatch(0, 1, '# xmcd', '', 0),
        ]),
        new MagicRule('video/3gpp', 50, 12, [
            new MagicMatch(4, 5, 'ftyp3ge', '', 0),
            new MagicMatch(4, 5, 'ftyp3gg', '', 0),
            new MagicMatch(4, 5, 'ftyp3gp', '', 0),
            new MagicMatch(4, 5, 'ftyp3gs', '', 0),
        ]),
        new MagicRule('video/3gpp2', 50, 12, [
            new MagicMatch(4, 5, 'ftyp3g2', '', 0),
        ]),
        new MagicRule('video/annodex', 50, 520, [
            new MagicMatch(0, 1, 'OggS', '', 0, [new MagicMatch(28, 29, "fishead\x00", '', 0, [new MagicMatch(56, 512, "CMML\x00\x00\x00\x00", '', 0)])]),
        ]),
        new MagicRule('video/dv', 50, 5, [
            new MagicMatch(0, 1, "\x1F\x07\x00\x00", "\xFF\xFF\xFF\x00", 0),
        ]),
        new MagicRule('video/mj2', 50, 25, [
            new MagicMatch(0, 1, "\x00\x00\x00\fjP  \r\n\x87\n        mjp2", "\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\xFF\xFF\xFF\xFF", 0),
        ]),
        new MagicRule('video/mp2t', 50, 774, [
            new MagicMatch(0, 1, 'G', '', 0, [new MagicMatch(188, 189, 'G', '', 0, [new MagicMatch(376, 377, 'G', '', 0, [new MagicMatch(564, 565, 'G', '', 0, [new MagicMatch(752, 753, 'G', '', 0)])])])]),
            new MagicMatch(4, 5, 'G', '', 0, [new MagicMatch(196, 197, 'G', '', 0, [new MagicMatch(388, 389, 'G', '', 0, [new MagicMatch(580, 581, 'G', '', 0, [new MagicMatch(772, 773, 'G', '', 0)])])])]),
        ]),
        new MagicRule('video/mp4', 50, 13, [
            new MagicMatch(4, 5, 'ftypisom', '', 0),
            new MagicMatch(4, 5, 'ftypmp41', '', 0),
            new MagicMatch(4, 5, 'ftypmp42', '', 0),
            new MagicMatch(4, 5, 'ftypMSNV', '', 0),
            new MagicMatch(4, 5, 'ftypM4V ', '', 0),
            new MagicMatch(4, 5, 'ftypf4v ', '', 0),
        ]),
        new MagicRule('video/mpeg', 50, 5, [
            new MagicMatch(0, 1, "G?\xFF\x10", '', 0),
            new MagicMatch(0, 1, "\x00\x00\x01\xB3", '', 0),
            new MagicMatch(0, 1, "\x00\x00\x01\xBA", '', 0),
        ]),
        new MagicRule('video/ogg', 50, 5, [
            new MagicMatch(0, 1, 'OggS', '', 0),
        ]),
        new MagicRule('video/quicktime', 50, 17, [
            new MagicMatch(12, 13, 'mdat', '', 0),
            new MagicMatch(4, 5, 'mdat', '', 0),
            new MagicMatch(4, 5, 'moov', '', 0),
            new MagicMatch(4, 5, 'ftypqt', '', 0),
        ]),
        new MagicRule('video/vnd.mpegurl', 50, 8, [
            new MagicMatch(0, 1, '#EXTM4U', '', 0),
        ]),
        new MagicRule('video/vnd.radgamettools.bink', 50, 5, [
            new MagicMatch(0, 1, 'BIK', '', 0, [new MagicMatch(3, 4, 'b', '', 0), new MagicMatch(3, 4, 'f', '', 0), new MagicMatch(3, 4, 'g', '', 0), new MagicMatch(3, 4, 'h', '', 0), new MagicMatch(3, 4, 'i', '', 0)]),
            new MagicMatch(0, 1, 'KB2', '', 0, [new MagicMatch(3, 4, 'a', '', 0), new MagicMatch(3, 4, 'd', '', 0), new MagicMatch(3, 4, 'f', '', 0), new MagicMatch(3, 4, 'g', '', 0), new MagicMatch(3, 4, 'h', '', 0), new MagicMatch(3, 4, 'i', '', 0), new MagicMatch(3, 4, 'j', '', 0), new MagicMatch(3, 4, 'k', '', 0)]),
        ]),
        new MagicRule('video/vnd.radgamettools.smacker', 50, 5, [
            new MagicMatch(0, 1, 'SMK', '', 0, [new MagicMatch(3, 4, '2', '', 0), new MagicMatch(3, 4, '4', '', 0)]),
        ]),
        new MagicRule('video/vnd.youtube.yt', 50, 13, [
            new MagicMatch(4, 5, 'ftypyt4 ', '', 0),
        ]),
        new MagicRule('video/webm', 50, 79, [
            new MagicMatch(0, 1, "\x1AE\xDF\xA3", '', 0, [new MagicMatch(5, 65, "B\x82", '', 0, [new MagicMatch(8, 75, 'webm', '', 0)])]),
        ]),
        new MagicRule('video/x-flic', 50, 3, [
            new MagicMatch(0, 1, "\x11\xAF", '', 0),
            new MagicMatch(0, 1, "\x12\xAF", '', 0),
        ]),
        new MagicRule('video/x-flv', 50, 4, [
            new MagicMatch(0, 1, 'FLV', '', 0),
        ]),
        new MagicRule('video/x-mng', 50, 9, [
            new MagicMatch(0, 1, "\x8AMNG\r\n\x1A\n", '', 0),
        ]),
        new MagicRule('video/x-msvideo', 50, 13, [
            new MagicMatch(0, 1, 'RIFF', '', 0, [new MagicMatch(8, 9, 'AVI ', '', 0)]),
            new MagicMatch(0, 1, 'AVF0', '', 0, [new MagicMatch(8, 9, 'AVI ', '', 0)]),
        ]),
        new MagicRule('video/x-nsv', 50, 5, [
            new MagicMatch(0, 1, 'NSVf', '', 0),
        ]),
        new MagicRule('video/x-sgi-movie', 50, 5, [
            new MagicMatch(0, 1, 'MOVI', '', 0),
        ]),
        new MagicRule('x-epoc/x-sisx-app', 50, 5, [
            new MagicMatch(0, 1, "z\x1A \x10", '', 0),
        ]),
        new MagicRule('application/x-archive', 45, 8, [
            new MagicMatch(0, 1, '<ar>', '', 0),
            new MagicMatch(0, 1, '!<arch>', '', 0),
        ]),
        new MagicRule('application/x-riff', 45, 5, [
            new MagicMatch(0, 1, 'RIFF', '', 0),
        ]),
        new MagicRule('image/svg+xml', 45, 260, [
            new MagicMatch(1, 256, '<svg', '', 0),
        ]),
        new MagicRule('application/sparql-query', 40, 7, [
            new MagicMatch(0, 1, 'PREFIX', '', 0),
        ]),
        new MagicRule('application/x-executable', 40, 7, [
            new MagicMatch(0, 1, "\x7FELF", '', 0, [new MagicMatch(5, 6, "\x01", '', 0)]),
            new MagicMatch(0, 1, "\x7FELF", '', 0, [new MagicMatch(5, 6, "\x02", '', 0)]),
            new MagicMatch(0, 1, 'MZ', '', 0),
            new MagicMatch(0, 1, "\x1CR", '', 0),
            new MagicMatch(0, 1, "\x01\x10", '', 2|$swap),
            new MagicMatch(0, 1, "\x01\x11", '', 2|$swap),
            new MagicMatch(0, 1, "\x83\x01", '', 0),
        ]),
        new MagicRule('application/x-iff', 40, 5, [
            new MagicMatch(0, 1, 'FORM', '', 0),
        ]),
        new MagicRule('application/x-nintendo-3ds-executable', 40, 5, [
            new MagicMatch(0, 1, '3DSX', '', 0),
        ]),
        new MagicRule('application/x-perl', 40, 275, [
            new MagicMatch(0, 256, 'use strict', '', 0),
            new MagicMatch(0, 256, 'use warnings', '', 0),
            new MagicMatch(0, 256, 'use diagnostics', '', 0),
            new MagicMatch(0, 256, "\n=pod", '', 0),
            new MagicMatch(0, 256, "\n=head1 NAME", '', 0),
            new MagicMatch(0, 256, "\n=head1 DESCRIPTION", '', 0),
            new MagicMatch(0, 256, 'BEGIN {', '', 0),
        ]),
        new MagicRule('application/xml', 40, 6, [
            new MagicMatch(0, 1, '<?xml', '', 0),
        ]),
        new MagicRule('audio/basic', 40, 5, [
            new MagicMatch(0, 1, '.snd', '', 0),
        ]),
        new MagicRule('audio/x-mod', 40, 1085, [
            new MagicMatch(0, 1, 'MTM', '', 0),
            new MagicMatch(0, 1, 'MMD0', '', 0),
            new MagicMatch(0, 1, 'MMD1', '', 0),
            new MagicMatch(112, 113, "\x00", "\x80", 0, [new MagicMatch(0, 1, 'if', '', 0, [new MagicMatch(368, 369, "\x00", "\xE0", 0, [new MagicMatch(110, 111, "\x00", "\xC0", 0, [new MagicMatch(111, 112, "\x00", "\x80", 0), new MagicMatch(111, 112, "\x80", '', 0)]), new MagicMatch(110, 111, '@', '', 0, [new MagicMatch(111, 112, "\x00", "\x80", 0), new MagicMatch(111, 112, "\x80", '', 0)])]), new MagicMatch(368, 369, ' ', '', 0, [new MagicMatch(110, 111, "\x00", "\xC0", 0, [new MagicMatch(111, 112, "\x00", "\x80", 0), new MagicMatch(111, 112, "\x80", '', 0)]), new MagicMatch(110, 111, '@', '', 0, [new MagicMatch(111, 112, "\x00", "\x80", 0), new MagicMatch(111, 112, "\x80", '', 0)])])]), new MagicMatch(0, 1, 'JN', '', 0, [new MagicMatch(368, 369, "\x00", "\xE0", 0, [new MagicMatch(110, 111, "\x00", "\xC0", 0, [new MagicMatch(111, 112, "\x00", "\x80", 0), new MagicMatch(111, 112, "\x80", '', 0)])]), new MagicMatch(368, 369, ' ', '', 0, [new MagicMatch(110, 111, '@', '', 0, [new MagicMatch(111, 112, "\x00", "\x80", 0), new MagicMatch(111, 112, "\x80", '', 0)])])])]),
            new MagicMatch(0, 1, 'MAS_UTrack_V00', '', 0),
            new MagicMatch(1080, 1081, 'M.K.', '', 0),
            new MagicMatch(1080, 1081, 'M!K!', '', 0),
        ]),
        new MagicRule('image/heif', 40, 13, [
            new MagicMatch(4, 5, 'ftypmif1', '', 0),
            new MagicMatch(4, 5, 'ftypmsf1', '', 0),
            new MagicMatch(4, 5, 'ftypheic', '', 0),
            new MagicMatch(4, 5, 'ftypheix', '', 0),
            new MagicMatch(4, 5, 'ftyphevc', '', 0),
            new MagicMatch(4, 5, 'ftyphevx', '', 0),
        ]),
        new MagicRule('text/html', 40, 262, [
            new MagicMatch(0, 1, '<!--', '', 0),
            new MagicMatch(0, 256, '<TITLE', '', 0),
            new MagicMatch(0, 256, '<title', '', 0),
        ]),
        new MagicRule('text/x-devicetree-source', 40, 4094, [
            new MagicMatch(0, 1, "\x00\x00", "\x80\x80", 0, [new MagicMatch(0, 4090, '/ {', '', 0), new MagicMatch(0, 4080, 'include ', '', 0, [new MagicMatch(10, 4090, '.dts', '', 0)])]),
        ]),
        new MagicRule('video/x-javafx', 40, 4, [
            new MagicMatch(0, 1, 'FLV', '', 0),
        ]),
        new MagicRule('application/x-mobipocket-ebook', 30, 69, [
            new MagicMatch(60, 61, 'TEXtREAd', '', 0),
        ]),
        new MagicRule('image/x-3ds', 30, 3, [
            new MagicMatch(0, 1, 'MM', '', 0),
        ]),
        new MagicRule('text/x-csrc', 30, 9, [
            new MagicMatch(0, 1, '/*', '', 0),
            new MagicMatch(0, 1, '//', '', 0),
            new MagicMatch(0, 1, '#include', '', 0),
        ]),
        new MagicRule('text/x-objcsrc', 30, 8, [
            new MagicMatch(0, 1, '#import', '', 0),
        ]),
        new MagicRule('application/mbox', 20, 6, [
            new MagicMatch(0, 1, 'From ', '', 0),
        ]),
        new MagicRule('image/x-tga', 10, 4, [
            new MagicMatch(1, 2, "\x01\x01", '', 0),
            new MagicMatch(1, 2, "\x01\t", '', 0),
            new MagicMatch(1, 2, "\x00\x03", '', 0),
            new MagicMatch(1, 2, "\x00\n", '', 0),
            new MagicMatch(1, 2, "\x00\v", '', 0),
        ]),
        new MagicRule('text/x-matlab', 10, 2, [
            new MagicMatch(0, 1, '%', '', 0),
        ]),
        new MagicRule('text/x-matlab', 10, 3, [
            new MagicMatch(0, 1, '##', '', 0),
        ]),
        new MagicRule('text/x-modelica', 10, 3, [
            new MagicMatch(0, 1, '//', '', 0),
        ]),
        new MagicRule('text/x-tex', 10, 2, [
            new MagicMatch(0, 1, '%', '', 0),
        ]),
    ],
);
