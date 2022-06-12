<?php

use ju1ius\XDGMime\Runtime\MagicMatch;
use ju1ius\XDGMime\Runtime\MagicRule;

return new ju1ius\XDGMime\Runtime\MagicDatabase(
    lookupBufferSize: 18729,
    rules: [
        new MagicRule('application/vnd.stardivision.writer', 90, [
            new MagicMatch(2089, 2090, 'StarWriter', '', 1, []),
        ]),
        new MagicRule('application/x-docbook+xml', 90, [
            new MagicMatch(0, 1, '<?xml', '', 1, [new MagicMatch(0, 100, '-//OASIS//DTD DocBook XML', '', 1, []), new MagicMatch(0, 100, '-//KDE//DTD DocBook XML', '', 1, [])]),
        ]),
        new MagicRule('image/x-eps', 90, [
            new MagicMatch(0, 1, '%!', '', 1, [new MagicMatch(15, 16, 'EPS', '', 1, [])]),
            new MagicMatch(0, 1, "\x04%!", '', 1, [new MagicMatch(16, 17, 'EPS', '', 1, [])]),
            new MagicMatch(0, 1, "\xC5\xD0\xD3\xC6", '', 1, []),
        ]),
        new MagicRule('application/prs.plucker', 80, [
            new MagicMatch(60, 61, 'DataPlkr', '', 1, []),
        ]),
        new MagicRule('application/schema+json', 80, [
            new MagicMatch(0, 1, '{', '', 1, [new MagicMatch(1, 256, '"$schema":', '', 1, [])]),
        ]),
        new MagicRule('application/vnd.corel-draw', 80, [
            new MagicMatch(8, 9, 'CDRXvrsn', "\xFF\xFF\xFF\x00\xFF\xFF\xFF\xFF", 1, []),
        ]),
        new MagicRule('application/x-fictionbook+xml', 80, [
            new MagicMatch(0, 256, '<FictionBook', '', 1, []),
        ]),
        new MagicRule('application/x-mobipocket-ebook', 80, [
            new MagicMatch(60, 61, 'BOOKMOBI', '', 1, []),
        ]),
        new MagicRule('application/x-mozilla-bookmarks', 80, [
            new MagicMatch(0, 64, '<!DOCTYPE NETSCAPE-Bookmark-file-1>', '', 1, []),
        ]),
        new MagicRule('application/x-nzb', 80, [
            new MagicMatch(0, 256, '<nzb', '', 1, []),
        ]),
        new MagicRule('application/x-pak', 80, [
            new MagicMatch(0, 1, 'PACK', '', 1, []),
        ]),
        new MagicRule('application/x-php', 80, [
            new MagicMatch(0, 64, '<?php', '', 1, []),
        ]),
        new MagicRule('application/xliff+xml', 80, [
            new MagicMatch(0, 256, '<xliff', '', 1, []),
        ]),
        new MagicRule('audio/x-flac+ogg', 80, [
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(28, 29, 'fLaC', '', 1, [])]),
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(28, 29, "\x7FFLAC", '', 1, [])]),
        ]),
        new MagicRule('audio/x-opus+ogg', 80, [
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(28, 29, 'OpusHead', '', 1, [])]),
        ]),
        new MagicRule('audio/x-speex+ogg', 80, [
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(28, 29, 'Speex  ', '', 1, [])]),
        ]),
        new MagicRule('audio/x-vorbis+ogg', 80, [
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(28, 29, "\x01vorbis", '', 1, [])]),
        ]),
        new MagicRule('image/astc', 80, [
            new MagicMatch(0, 1, "\x13\xAB\xA1\\", '', 1, []),
        ]),
        new MagicRule('image/ktx', 80, [
            new MagicMatch(0, 1, "\xABKTX", '', 1, [new MagicMatch(4, 5, " 11\xBB", '', 1, [new MagicMatch(8, 9, "\r\n\x1A\n", '', 1, [])])]),
        ]),
        new MagicRule('image/ktx2', 80, [
            new MagicMatch(0, 1, "\xABKTX", '', 1, [new MagicMatch(4, 5, " 20\xBB", '', 1, [new MagicMatch(8, 9, "\r\n\x1A\n", '', 1, [])])]),
        ]),
        new MagicRule('image/svg+xml', 80, [
            new MagicMatch(0, 256, '<!DOCTYPE svg', '', 1, []),
        ]),
        new MagicRule('image/svg+xml', 80, [
            new MagicMatch(0, 1, '<!-- Created with Inkscape', '', 1, []),
            new MagicMatch(0, 1, '<svg', '', 1, []),
        ]),
        new MagicRule('image/vnd.djvu', 80, [
            new MagicMatch(0, 1, 'AT&TFORM', '', 1, [new MagicMatch(12, 13, 'DJVU', '', 1, [])]),
            new MagicMatch(0, 1, 'FORM', '', 1, [new MagicMatch(8, 9, 'DJVU', '', 1, [])]),
        ]),
        new MagicRule('image/vnd.djvu+multipage', 80, [
            new MagicMatch(0, 1, 'AT&TFORM', '', 1, [new MagicMatch(12, 13, 'DJVM', '', 1, [])]),
            new MagicMatch(0, 1, 'FORM', '', 1, [new MagicMatch(8, 9, 'DJVM', '', 1, [])]),
        ]),
        new MagicRule('image/x-kodak-kdc', 80, [
            new MagicMatch(242, 243, 'EASTMAN KODAK COMPANY', '', 1, []),
        ]),
        new MagicRule('image/x-niff', 80, [
            new MagicMatch(0, 1, 'IIN1', '', 1, []),
        ]),
        new MagicRule('video/x-ogm+ogg', 80, [
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(29, 30, 'video', '', 1, [])]),
        ]),
        new MagicRule('video/x-theora+ogg', 80, [
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(28, 29, "\x80theora", '', 1, [])]),
        ]),
        new MagicRule('application/atom+xml', 70, [
            new MagicMatch(0, 256, '<feed ', '', 1, []),
        ]),
        new MagicRule('application/epub+zip', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/epub+zip', '', 1, []), new MagicMatch(43, 44, 'application/epub+zip', '', 1, [])])]),
        ]),
        new MagicRule('application/rss+xml', 70, [
            new MagicMatch(0, 256, '<rss ', '', 1, []),
            new MagicMatch(0, 256, '<RSS ', '', 1, []),
        ]),
        new MagicRule('application/vnd.apple.keynote', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'index.apxl', '', 1, [])]),
        ]),
        new MagicRule('application/vnd.apple.mpegurl', 70, [
            new MagicMatch(0, 1, '#EXTM3U', '', 1, [new MagicMatch(0, 128, '#EXT-X-TARGETDURATION', '', 1, []), new MagicMatch(0, 128, '#EXT-X-STREAM-INF', '', 1, [])]),
        ]),
        new MagicRule('application/vnd.apple.pages', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'index.xml', '', 1, []), new MagicMatch(30, 31, 'Index/Document.iwa', '', 1, [])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.chart', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.chart', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.chart-template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.chart-template', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.database', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.base', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.formula', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.formula', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.formula-template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.formula-template', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.graphics', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.graphics', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.graphics-template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.graphics-template', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.image', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.image', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.presentation', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.presentation', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.presentation-template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.presentation-template', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.spreadsheet', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.spreadsheet', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.spreadsheet-template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.spreadsheet-template', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.text', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text-master', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.text-master', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text-template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.text-template', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text-web', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.oasis.opendocument.text-web', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.calc', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.calc', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.calc.template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.calc', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.draw', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.draw', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.draw.template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.draw', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.impress', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.impress', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.impress.template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.impress', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.math', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.math', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.writer', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.writer', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.writer.global', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.writer', '', 1, [])])]),
        ]),
        new MagicRule('application/vnd.sun.xml.writer.template', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/vnd.sun.xml.writer', '', 1, [])])]),
        ]),
        new MagicRule('application/x-zip-compressed-fb2', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 256, '.fb2', '', 1, [])]),
        ]),
        new MagicRule('image/openraster', 70, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'image/openraster', '', 1, [])])]),
        ]),
        new MagicRule('text/x-opml+xml', 70, [
            new MagicMatch(0, 256, '<opml ', '', 1, []),
        ]),
        new MagicRule('application/vnd.apple.numbers', 65, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'index.xml', '', 1, []), new MagicMatch(30, 31, 'Index/Document.iwa', '', 1, [])]),
        ]),
        new MagicRule('application/vnd.apple.pkpass', 65, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'pass.json', '', 1, [])]),
        ]),
        new MagicRule('application/msword', 60, [
            new MagicMatch(0, 1, "1\xBE\x00\x00", '', 1, []),
            new MagicMatch(0, 1, 'PO^Q`', '', 1, []),
            new MagicMatch(0, 1, "\xFE7\x00#", '', 1, []),
            new MagicMatch(0, 1, "\xDB\xA5-\x00\x00\x00", '', 1, []),
            new MagicMatch(2112, 2113, 'MSWordDoc', '', 1, []),
            new MagicMatch(2108, 2109, 'MSWordDoc', '', 1, []),
            new MagicMatch(2112, 2113, 'Microsoft Word document data', '', 1, []),
            new MagicMatch(546, 547, 'bjbj', '', 1, []),
            new MagicMatch(546, 547, 'jbjb', '', 1, []),
        ]),
        new MagicRule('application/ovf', 60, [
            new MagicMatch(1, 256, '.ovf', '', 1, [new MagicMatch(257, 258, "ustar\x00", '', 1, []), new MagicMatch(257, 258, "ustar  \x00", '', 1, [])]),
        ]),
        new MagicRule('application/vnd.ms-cab-compressed', 60, [
            new MagicMatch(0, 1, "MSCF\x00\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('application/vnd.ms-wpl', 60, [
            new MagicMatch(0, 256, '<?wpl', '', 1, []),
        ]),
        new MagicRule('application/vnd.rar', 60, [
            new MagicMatch(0, 1, 'Rar!', '', 1, []),
        ]),
        new MagicRule('application/x-7z-compressed', 60, [
            new MagicMatch(0, 1, "7z\xBC\xAF'\x1C", '', 1, []),
        ]),
        new MagicRule('application/x-ace', 60, [
            new MagicMatch(7, 8, '**ACE**', '', 1, []),
        ]),
        new MagicRule('application/x-arc', 60, [
            new MagicMatch(0, 1, "\x1A\x08\x00\x00", "\xFF\xFF\x80\x80", 1, []),
            new MagicMatch(0, 1, "\x1A\t\x00\x00", "\xFF\xFF\x80\x80", 1, []),
            new MagicMatch(0, 1, "\x1A\x02\x00\x00", "\xFF\xFF\x80\x80", 1, []),
            new MagicMatch(0, 1, "\x1A\x03\x00\x00", "\xFF\xFF\x80\x80", 1, []),
            new MagicMatch(0, 1, "\x1A\x04\x00\x00", "\xFF\xFF\x80\x80", 1, []),
            new MagicMatch(0, 1, "\x1A\x06\x00\x00", "\xFF\xFF\x80\x80", 1, []),
        ]),
        new MagicRule('application/x-cpio', 60, [
            new MagicMatch(0, 1, "q\xC7", '', 2, []),
            new MagicMatch(0, 1, '070701', '', 1, []),
            new MagicMatch(0, 1, '070702', '', 1, []),
            new MagicMatch(0, 1, "\xC7q", '', 2, []),
        ]),
        new MagicRule('application/x-font-type1', 60, [
            new MagicMatch(0, 1, 'LWFN', '', 1, []),
            new MagicMatch(65, 66, 'LWFN', '', 1, []),
            new MagicMatch(0, 1, '%!PS-AdobeFont-1.', '', 1, []),
            new MagicMatch(6, 7, '%!PS-AdobeFont-1.', '', 1, []),
            new MagicMatch(0, 1, '%!FontType1-1.', '', 1, []),
            new MagicMatch(6, 7, '%!FontType1-1.', '', 1, []),
        ]),
        new MagicRule('application/x-java-pack200', 60, [
            new MagicMatch(0, 1, "\xCA\xFE\xD0\r", '', 1, []),
        ]),
        new MagicRule('application/x-karbon', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-karbon\x04\x06", '', 1, [])])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/x-karbon', '', 1, [])])]),
        ]),
        new MagicRule('application/x-kchart', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-kchart\x04\x06", '', 1, [])])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/x-kchart', '', 1, [])])]),
        ]),
        new MagicRule('application/x-kformula', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-kformula\x04\x06", '', 1, [])])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/x-kformula', '', 1, [])])]),
        ]),
        new MagicRule('application/x-killustrator', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-killustrator\x04\x06", '', 1, [])])]),
        ]),
        new MagicRule('application/x-kivio', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-kivio\x04\x06", '', 1, [])])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/x-kivio', '', 1, [])])]),
        ]),
        new MagicRule('application/x-kontour', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-kontour\x04\x06", '', 1, [])])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/x-kontour', '', 1, [])])]),
        ]),
        new MagicRule('application/x-kpresenter', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-kpresenter\x04\x06", '', 1, [])])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/x-kpresenter', '', 1, [])])]),
        ]),
        new MagicRule('application/x-krita', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-krita\x04\x06", '', 1, [])])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/x-krita', '', 1, []), new MagicMatch(42, 43, 'application/x-krita', '', 1, []), new MagicMatch(63, 64, 'application/x-krita', '', 1, [])])]),
        ]),
        new MagicRule('application/x-kspread', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-kspread\x04\x06", '', 1, [])])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/x-kspread', '', 1, [])])]),
        ]),
        new MagicRule('application/x-kword', 60, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, [new MagicMatch(10, 11, 'KOffice', '', 1, [new MagicMatch(18, 19, "application/x-kword\x04\x06", '', 1, [])])]),
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, [new MagicMatch(30, 31, 'mimetype', '', 1, [new MagicMatch(38, 39, 'application/x-kword', '', 1, [])])]),
        ]),
        new MagicRule('application/x-lha', 60, [
            new MagicMatch(2, 3, '-lh -', '', 1, []),
            new MagicMatch(2, 3, '-lh0-', '', 1, []),
            new MagicMatch(2, 3, '-lh1-', '', 1, []),
            new MagicMatch(2, 3, '-lh2-', '', 1, []),
            new MagicMatch(2, 3, '-lh3-', '', 1, []),
            new MagicMatch(2, 3, '-lh4-', '', 1, []),
            new MagicMatch(2, 3, '-lh5-', '', 1, []),
            new MagicMatch(2, 3, '-lh40-', '', 1, []),
            new MagicMatch(2, 3, '-lhd-', '', 1, []),
            new MagicMatch(2, 3, '-lz4-', '', 1, []),
            new MagicMatch(2, 3, '-lz5-', '', 1, []),
            new MagicMatch(2, 3, '-lzs-', '', 1, []),
        ]),
        new MagicRule('application/x-lrzip', 60, [
            new MagicMatch(0, 1, 'LRZI', '', 1, []),
        ]),
        new MagicRule('application/x-lz4', 60, [
            new MagicMatch(0, 1, "\x04\"M\x18", '', 1, []),
            new MagicMatch(0, 1, "\x02!L\x18", '', 1, []),
        ]),
        new MagicRule('application/x-lzip', 60, [
            new MagicMatch(0, 1, 'LZIP', '', 1, []),
        ]),
        new MagicRule('application/x-lzop', 60, [
            new MagicMatch(0, 1, "\x89LZO\x00\r\n\x1A\n", '', 1, []),
        ]),
        new MagicRule('application/x-par2', 60, [
            new MagicMatch(0, 1, 'PAR2', '', 1, []),
        ]),
        new MagicRule('application/x-qpress', 60, [
            new MagicMatch(0, 1, 'qpress10', '', 1, []),
        ]),
        new MagicRule('application/x-quicktime-media-link', 60, [
            new MagicMatch(0, 1, '<?xml', '', 1, [new MagicMatch(0, 64, '<?quicktime', '', 1, [])]),
            new MagicMatch(0, 1, 'RTSPtext', '', 1, []),
            new MagicMatch(0, 1, 'rtsptext', '', 1, []),
            new MagicMatch(0, 1, 'SMILtext', '', 1, []),
        ]),
        new MagicRule('application/x-sega-cd-rom', 60, [
            new MagicMatch(0, 1, 'SEGADISCSYSTEM', '', 1, [new MagicMatch(256, 257, 'SEGA', '', 1, [])]),
            new MagicMatch(16, 17, 'SEGADISCSYSTEM', '', 1, [new MagicMatch(272, 273, 'SEGA', '', 1, [])]),
        ]),
        new MagicRule('application/x-stuffit', 60, [
            new MagicMatch(0, 1, 'StuffIt ', '', 1, []),
            new MagicMatch(0, 1, 'SIT!', '', 1, []),
        ]),
        new MagicRule('application/x-tar', 60, [
            new MagicMatch(257, 258, "ustar\x00", '', 1, []),
            new MagicMatch(257, 258, "ustar  \x00", '', 1, []),
        ]),
        new MagicRule('application/x-xar', 60, [
            new MagicMatch(0, 1, 'xar!', '', 1, []),
        ]),
        new MagicRule('application/x-xz', 60, [
            new MagicMatch(0, 1, "\xFD7zXZ\x00", '', 1, []),
        ]),
        new MagicRule('application/x-zoo', 60, [
            new MagicMatch(20, 21, "\xDC\xA7\xC4\xFD", '', 1, []),
        ]),
        new MagicRule('application/xhtml+xml', 60, [
            new MagicMatch(0, 256, '//W3C//DTD XHTML ', '', 1, []),
            new MagicMatch(0, 256, 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd', '', 1, []),
            new MagicMatch(0, 256, '<html xmlns="http://www.w3.org/1999/xhtml', '', 1, []),
            new MagicMatch(0, 256, '<HTML xmlns="http://www.w3.org/1999/xhtml', '', 1, []),
        ]),
        new MagicRule('application/zip', 60, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 1, []),
        ]),
        new MagicRule('application/zstd', 60, [
            new MagicMatch(0, 1, "(\xB5/\xFD", '', 1, []),
        ]),
        new MagicRule('audio/vnd.dts.hd', 60, [
            new MagicMatch(0, 1, "\x7F\xFE\x80\x01", '', 1, [new MagicMatch(4, 18725, 'dX %', '', 1, [])]),
        ]),
        new MagicRule('text/x-python3', 60, [
            new MagicMatch(0, 1, '#!/bin/python3', '', 1, []),
            new MagicMatch(0, 1, '#! /bin/python3', '', 1, []),
            new MagicMatch(0, 1, 'eval "exec /bin/python3', '', 1, []),
            new MagicMatch(0, 1, '#!/usr/bin/python3', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/bin/python3', '', 1, []),
            new MagicMatch(0, 1, 'eval "exec /usr/bin/python3', '', 1, []),
            new MagicMatch(0, 1, '#!/usr/local/bin/python3', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/local/bin/python3', '', 1, []),
            new MagicMatch(0, 1, 'eval "exec /usr/local/bin/python3', '', 1, []),
            new MagicMatch(2, 16, '/bin/env python3', '', 1, []),
        ]),
        new MagicRule('text/x-txt2tags', 60, [
            new MagicMatch(0, 1, '%!postproc', '', 1, []),
            new MagicMatch(0, 1, '%!encoding', '', 1, []),
        ]),
        new MagicRule('application/smil+xml', 55, [
            new MagicMatch(0, 256, '<smil', '', 1, []),
        ]),
        new MagicRule('audio/x-ms-asx', 51, [
            new MagicMatch(0, 1, 'ASF ', '', 1, []),
            new MagicMatch(0, 64, '<ASX', '', 1, []),
            new MagicMatch(0, 64, '<asx', '', 1, []),
            new MagicMatch(0, 64, '<Asx', '', 1, []),
        ]),
        new MagicRule('application/annodex', 50, [
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(28, 29, "fishead\x00", '', 1, [new MagicMatch(56, 512, "CMML\x00\x00\x00\x00", '', 1, [])])]),
        ]),
        new MagicRule('application/dicom', 50, [
            new MagicMatch(128, 129, 'DICM', '', 1, []),
        ]),
        new MagicRule('application/fits', 50, [
            new MagicMatch(0, 1, 'SIMPLE  =', '', 1, []),
        ]),
        new MagicRule('application/gnunet-directory', 50, [
            new MagicMatch(0, 1, "\x89GND\r\n\x1A\n", '', 1, []),
        ]),
        new MagicRule('application/gzip', 50, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 1, []),
        ]),
        new MagicRule('application/javascript', 50, [
            new MagicMatch(0, 1, '#!/bin/gjs', '', 1, []),
            new MagicMatch(0, 1, '#! /bin/gjs', '', 1, []),
            new MagicMatch(0, 1, 'eval "exec /bin/gjs', '', 1, []),
            new MagicMatch(0, 1, '#!/usr/bin/gjs', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/bin/gjs', '', 1, []),
            new MagicMatch(0, 1, 'eval "exec /usr/bin/gjs', '', 1, []),
            new MagicMatch(0, 1, '#!/usr/local/bin/gjs', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/local/bin/gjs', '', 1, []),
            new MagicMatch(0, 1, 'eval "exec /usr/local/bin/gjs', '', 1, []),
            new MagicMatch(2, 16, '/bin/env gjs', '', 1, []),
        ]),
        new MagicRule('application/mac-binhex40', 50, [
            new MagicMatch(11, 12, 'must be converted with BinHex', '', 1, []),
        ]),
        new MagicRule('application/mathematica', 50, [
            new MagicMatch(0, 1, '(************** Content-type: application/mathematica', '', 1, []),
            new MagicMatch(100, 256, 'This notebook can be used on any computer system with Mathematica', '', 1, []),
            new MagicMatch(10, 256, 'This is a Mathematica Notebook file.  It contains ASCII text', '', 1, []),
        ]),
        new MagicRule('application/metalink+xml', 50, [
            new MagicMatch(0, 256, '<metalink version="3.0"', '', 1, []),
        ]),
        new MagicRule('application/metalink4+xml', 50, [
            new MagicMatch(0, 256, '<metalink xmlns="urn', '', 1, []),
        ]),
        new MagicRule('application/mxf', 50, [
            new MagicMatch(0, 256, "\x06\x0E+4\x02\x05\x01\x01\r\x01\x02\x01\x01\x02", '', 1, []),
        ]),
        new MagicRule('application/ogg', 50, [
            new MagicMatch(0, 1, 'OggS', '', 1, []),
        ]),
        new MagicRule('application/owl+xml', 50, [
            new MagicMatch(0, 256, '<Ontology', '', 1, []),
        ]),
        new MagicRule('application/pdf', 50, [
            new MagicMatch(0, 1024, '%PDF-', '', 1, []),
        ]),
        new MagicRule('application/pgp-encrypted', 50, [
            new MagicMatch(0, 1, '-----BEGIN PGP MESSAGE-----', '', 1, []),
        ]),
        new MagicRule('application/pgp-keys', 50, [
            new MagicMatch(0, 1, '-----BEGIN PGP PUBLIC KEY BLOCK-----', '', 1, []),
            new MagicMatch(0, 1, '-----BEGIN PGP PRIVATE KEY BLOCK-----', '', 1, []),
            new MagicMatch(0, 1, "\x95\x01", '', 1, []),
            new MagicMatch(0, 1, "\x95\x00", '', 1, []),
            new MagicMatch(0, 1, "\x99\x00", '', 1, []),
            new MagicMatch(0, 1, "\x99\x01", '', 1, []),
        ]),
        new MagicRule('application/pgp-signature', 50, [
            new MagicMatch(0, 1, '-----BEGIN PGP SIGNATURE-----', '', 1, []),
        ]),
        new MagicRule('application/pkix-cert', 50, [
            new MagicMatch(0, 1, '-----BEGIN CERTIFICATE-----', '', 1, []),
            new MagicMatch(0, 1, '-----BEGIN X509 CERTIFICATE-----', '', 1, []),
        ]),
        new MagicRule('application/pkix-crl', 50, [
            new MagicMatch(0, 1, '-----BEGIN X509 CRL-----', '', 1, []),
        ]),
        new MagicRule('application/postscript', 50, [
            new MagicMatch(0, 1, "\x04%!", '', 1, []),
            new MagicMatch(0, 1, '%!', '', 1, []),
        ]),
        new MagicRule('application/raml+yaml', 50, [
            new MagicMatch(0, 1, '#%RAML ', '', 1, []),
        ]),
        new MagicRule('application/rtf', 50, [
            new MagicMatch(0, 1, '{\\rtf', '', 1, []),
        ]),
        new MagicRule('application/sdp', 50, [
            new MagicMatch(0, 1, 'v=', '', 1, [new MagicMatch(0, 256, 's=', '', 1, [])]),
        ]),
        new MagicRule('application/vnd.adobe.flash.movie', 50, [
            new MagicMatch(0, 1, 'FWS', '', 1, []),
            new MagicMatch(0, 1, 'CWS', '', 1, []),
        ]),
        new MagicRule('application/vnd.appimage', 50, [
            new MagicMatch(1, 2, 'ELF', '', 1, [new MagicMatch(8, 9, 'A', '', 1, [new MagicMatch(9, 10, 'I', '', 1, [new MagicMatch(10, 11, "\x02", '', 1, [])])])]),
        ]),
        new MagicRule('application/vnd.chess-pgn', 50, [
            new MagicMatch(0, 1, '[Event ', '', 1, []),
        ]),
        new MagicRule('application/vnd.debian.binary-package', 50, [
            new MagicMatch(0, 1, '!<arch>', '', 1, [new MagicMatch(8, 9, 'debian', '', 1, [])]),
        ]),
        new MagicRule('application/vnd.emusic-emusic_package', 50, [
            new MagicMatch(0, 1, 'nF7YLao', '', 1, []),
        ]),
        new MagicRule('application/vnd.flatpak', 50, [
            new MagicMatch(0, 1, "xdg-app\x00\x01\x00\x89\xE5", '', 1, []),
            new MagicMatch(0, 1, "flatpak\x00\x01\x00\x89\xE5", '', 1, []),
        ]),
        new MagicRule('application/vnd.flatpak.ref', 50, [
            new MagicMatch(0, 256, '[Flatpak Ref]', '', 1, []),
        ]),
        new MagicRule('application/vnd.flatpak.repo', 50, [
            new MagicMatch(0, 256, '[Flatpak Repo]', '', 1, []),
        ]),
        new MagicRule('application/vnd.framemaker', 50, [
            new MagicMatch(0, 1, '<MakerFile', '', 1, []),
            new MagicMatch(0, 1, '<MIFFile', '', 1, []),
            new MagicMatch(0, 1, '<MakerDictionary', '', 1, []),
            new MagicMatch(0, 1, '<MakerScreenFon', '', 1, []),
            new MagicMatch(0, 1, '<MML', '', 1, []),
            new MagicMatch(0, 1, '<Book', '', 1, []),
            new MagicMatch(0, 1, '<Maker', '', 1, []),
        ]),
        new MagicRule('application/vnd.iccprofile', 50, [
            new MagicMatch(36, 37, 'acsp', '', 1, []),
        ]),
        new MagicRule('application/vnd.lotus-1-2-3', 50, [
            new MagicMatch(0, 1, "\x00\x00\x02\x00\x06\x04\x06\x00\x08\x00\x00\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('application/vnd.lotus-wordpro', 50, [
            new MagicMatch(0, 1, 'WordPro', '', 1, []),
        ]),
        new MagicRule('application/vnd.ms-access', 50, [
            new MagicMatch(0, 1, "\x00\x01\x00\x00Standard Jet DB", '', 1, []),
        ]),
        new MagicRule('application/vnd.ms-asf', 50, [
            new MagicMatch(0, 1, "0&\xB2u", '', 1, []),
            new MagicMatch(0, 1, '[Reference]', '', 1, []),
        ]),
        new MagicRule('application/vnd.ms-excel', 50, [
            new MagicMatch(2080, 2081, 'Microsoft Excel 5.0 Worksheet', '', 1, []),
        ]),
        new MagicRule('application/vnd.ms-tnef', 50, [
            new MagicMatch(0, 1, "x\x9F>\"", '', 1, []),
        ]),
        new MagicRule('application/vnd.rn-realmedia', 50, [
            new MagicMatch(0, 1, '.RMF', '', 1, []),
        ]),
        new MagicRule('application/vnd.smaf', 50, [
            new MagicMatch(0, 1, 'MMMD', '', 1, []),
        ]),
        new MagicRule('application/vnd.sqlite3', 50, [
            new MagicMatch(0, 1, 'SQLite format 3', '', 1, []),
        ]),
        new MagicRule('application/vnd.squashfs', 50, [
            new MagicMatch(0, 1, 'sqsh', '', 1, []),
            new MagicMatch(0, 1, 'hsqs', '', 1, []),
        ]),
        new MagicRule('application/vnd.symbian.install', 50, [
            new MagicMatch(8, 9, "\x19\x04\x00\x10", '', 1, []),
        ]),
        new MagicRule('application/vnd.tcpdump.pcap', 50, [
            new MagicMatch(0, 1, "\xA1\xB2\xC3\xD4", '', 4, []),
            new MagicMatch(0, 1, "\xD4\xC3\xB2\xA1", '', 4, []),
        ]),
        new MagicRule('application/vnd.wordperfect', 50, [
            new MagicMatch(1, 2, 'WPC', '', 1, []),
        ]),
        new MagicRule('application/winhlp', 50, [
            new MagicMatch(0, 1, "?_\x03\x00", '', 1, []),
        ]),
        new MagicRule('application/x-abiword', 50, [
            new MagicMatch(0, 256, '<abiword', '', 1, []),
            new MagicMatch(0, 256, '<!DOCTYPE abiword', '', 1, []),
        ]),
        new MagicRule('application/x-alz', 50, [
            new MagicMatch(0, 1, 'ALZ', '', 1, []),
        ]),
        new MagicRule('application/x-amiga-disk-format', 50, [
            new MagicMatch(0, 1, "DOS\x00", '', 1, []),
        ]),
        new MagicRule('application/x-aportisdoc', 50, [
            new MagicMatch(60, 61, 'TEXtREAd', '', 1, []),
            new MagicMatch(60, 61, 'TEXtTlDc', '', 1, []),
        ]),
        new MagicRule('application/x-apple-systemprofiler+xml', 50, [
            new MagicMatch(0, 256, '<plist version="1.0"', '', 1, [new MagicMatch(34, 384, '<key>_SPCommandLineArguments</key>', '', 1, [])]),
        ]),
        new MagicRule('application/x-applix-spreadsheet', 50, [
            new MagicMatch(0, 1, '*BEGIN SPREADSHEETS', '', 1, []),
            new MagicMatch(0, 1, '*BEGIN', '', 1, [new MagicMatch(7, 8, 'SPREADSHEETS', '', 1, [])]),
        ]),
        new MagicRule('application/x-applix-word', 50, [
            new MagicMatch(0, 1, '*BEGIN', '', 1, [new MagicMatch(7, 8, 'WORDS', '', 1, [])]),
        ]),
        new MagicRule('application/x-arj', 50, [
            new MagicMatch(0, 1, "`\xEA", '', 1, []),
        ]),
        new MagicRule('application/x-asar', 50, [
            new MagicMatch(0, 1, "\x04\x00\x00\x00", '', 1, [new MagicMatch(16, 17, '{"files":', '', 1, [])]),
        ]),
        new MagicRule('application/x-atari-7800-rom', 50, [
            new MagicMatch(1, 2, 'ATARI7800', '', 1, []),
        ]),
        new MagicRule('application/x-atari-lynx-rom', 50, [
            new MagicMatch(0, 1, 'LYNX', '', 1, []),
        ]),
        new MagicRule('application/x-awk', 50, [
            new MagicMatch(0, 1, '#!/bin/gawk', '', 1, []),
            new MagicMatch(0, 1, '#! /bin/gawk', '', 1, []),
            new MagicMatch(0, 1, '#!/usr/bin/gawk', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/bin/gawk', '', 1, []),
            new MagicMatch(0, 1, '#!/usr/local/bin/gawk', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/local/bin/gawk', '', 1, []),
            new MagicMatch(0, 1, '#!/bin/awk', '', 1, []),
            new MagicMatch(0, 1, '#! /bin/awk', '', 1, []),
            new MagicMatch(0, 1, '#!/usr/bin/awk', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/bin/awk', '', 1, []),
        ]),
        new MagicRule('application/x-bittorrent', 50, [
            new MagicMatch(0, 1, 'd8:announce', '', 1, []),
        ]),
        new MagicRule('application/x-blender', 50, [
            new MagicMatch(0, 1, 'BLENDER', '', 1, []),
        ]),
        new MagicRule('application/x-bps-patch', 50, [
            new MagicMatch(0, 1, 'BPS1', '', 1, []),
        ]),
        new MagicRule('application/x-bsdiff', 50, [
            new MagicMatch(0, 1, 'BSDIFF40', '', 1, []),
            new MagicMatch(0, 1, 'BSDIFN40', '', 1, []),
        ]),
        new MagicRule('application/x-bzip', 50, [
            new MagicMatch(0, 1, 'BZh', '', 1, []),
        ]),
        new MagicRule('application/x-ccmx', 50, [
            new MagicMatch(0, 1, 'CCMX', '', 1, []),
        ]),
        new MagicRule('application/x-cdrdao-toc', 50, [
            new MagicMatch(0, 1, "CD_ROM\n", '', 1, []),
            new MagicMatch(0, 1, "CD_DA\n", '', 1, []),
            new MagicMatch(0, 1, "CD_ROM_XA\n", '', 1, []),
            new MagicMatch(0, 1, 'CD_TEXT ', '', 1, []),
            new MagicMatch(0, 1, 'CATALOG "', '', 1, [new MagicMatch(22, 23, '"', '', 1, [])]),
        ]),
        new MagicRule('application/x-cisco-vpn-settings', 50, [
            new MagicMatch(0, 1, '[main]', '', 1, [new MagicMatch(0, 256, 'AuthType=', '', 1, [])]),
        ]),
        new MagicRule('application/x-compress', 50, [
            new MagicMatch(0, 1, "\x1F\x9D", '', 1, []),
        ]),
        new MagicRule('application/x-compressed-iso', 50, [
            new MagicMatch(0, 1, 'CISO', '', 1, []),
        ]),
        new MagicRule('application/x-core', 50, [
            new MagicMatch(0, 1, "\x7FELF            \x04", "\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\xFF", 1, []),
            new MagicMatch(0, 1, "\x7FELF", '', 1, [new MagicMatch(5, 6, "\x01", '', 1, [new MagicMatch(16, 17, "\x04\x00", '', 1, [])])]),
            new MagicMatch(0, 1, "\x7FELF", '', 1, [new MagicMatch(5, 6, "\x02", '', 1, [new MagicMatch(16, 17, "\x00\x04", '', 1, [])])]),
            new MagicMatch(0, 1, "Core\x01", '', 1, []),
            new MagicMatch(0, 1, "Core\x02", '', 1, []),
        ]),
        new MagicRule('application/x-csh', 50, [
            new MagicMatch(2, 16, '/bin/tcsh', '', 1, []),
            new MagicMatch(2, 16, '/bin/csh', '', 1, []),
            new MagicMatch(2, 16, '/bin/env csh', '', 1, []),
            new MagicMatch(2, 16, '/bin/env tcsh', '', 1, []),
        ]),
        new MagicRule('application/x-dar', 50, [
            new MagicMatch(0, 1, "\x00\x00\x00{", '', 1, []),
        ]),
        new MagicRule('application/x-designer', 50, [
            new MagicMatch(0, 256, '<ui ', '', 1, []),
            new MagicMatch(0, 256, '<UI ', '', 1, []),
        ]),
        new MagicRule('application/x-desktop', 50, [
            new MagicMatch(0, 32, '[Desktop Entry]', '', 1, []),
            new MagicMatch(0, 1, '[Desktop Action', '', 1, []),
            new MagicMatch(0, 1, '[KDE Desktop Entry]', '', 1, []),
            new MagicMatch(0, 1, '# Config File', '', 1, []),
            new MagicMatch(0, 1, '# KDE Config File', '', 1, []),
        ]),
        new MagicRule('application/x-dia-diagram', 50, [
            new MagicMatch(5, 100, '<dia:', '', 1, []),
        ]),
        new MagicRule('application/x-dia-shape', 50, [
            new MagicMatch(5, 100, '<shape', '', 1, []),
        ]),
        new MagicRule('application/x-doom-wad', 50, [
            new MagicMatch(0, 1, 'IWAD', '', 1, []),
            new MagicMatch(0, 1, 'PWAD', '', 1, []),
        ]),
        new MagicRule('application/x-dreamcast-rom', 50, [
            new MagicMatch(16, 17, 'SEGA SEGAKATANA', '', 1, []),
        ]),
        new MagicRule('application/x-dvi', 50, [
            new MagicMatch(0, 1, "\xF7\x02", '', 1, []),
        ]),
        new MagicRule('application/x-fds-disk', 50, [
            new MagicMatch(1, 2, '*NINTENDO-HVC*', '', 1, []),
        ]),
        new MagicRule('application/x-fluid', 50, [
            new MagicMatch(0, 1, '# data file for the Fltk', '', 1, []),
        ]),
        new MagicRule('application/x-font-bdf', 50, [
            new MagicMatch(0, 1, 'STARTFONT ', '', 1, []),
        ]),
        new MagicRule('application/x-font-dos', 50, [
            new MagicMatch(0, 1, "\xFFFON", '', 1, []),
            new MagicMatch(7, 8, "\x00EGA", '', 1, []),
            new MagicMatch(7, 8, "\x00VID", '', 1, []),
        ]),
        new MagicRule('application/x-font-framemaker', 50, [
            new MagicMatch(0, 1, '<MakerScreenFont', '', 1, []),
        ]),
        new MagicRule('application/x-font-libgrx', 50, [
            new MagicMatch(0, 1, "\x14\x02Y\x19", '', 1, []),
        ]),
        new MagicRule('application/x-font-linux-psf', 50, [
            new MagicMatch(0, 1, "6\x04", '', 1, []),
        ]),
        new MagicRule('application/x-font-pcf', 50, [
            new MagicMatch(0, 1, "\x01fcp", '', 1, []),
        ]),
        new MagicRule('application/x-font-speedo', 50, [
            new MagicMatch(0, 1, "D1.0\r", '', 1, []),
        ]),
        new MagicRule('application/x-font-sunos-news', 50, [
            new MagicMatch(0, 1, 'StartFont', '', 1, []),
            new MagicMatch(0, 1, "\x13z)", '', 1, []),
            new MagicMatch(8, 9, "\x13z+", '', 1, []),
        ]),
        new MagicRule('application/x-font-tex', 50, [
            new MagicMatch(0, 1, "\xF7\x83", '', 1, []),
            new MagicMatch(0, 1, "\xF7Y", '', 1, []),
            new MagicMatch(0, 1, "\xF7\xCA", '', 1, []),
        ]),
        new MagicRule('application/x-font-tex-tfm', 50, [
            new MagicMatch(2, 3, "\x00\x11", '', 1, []),
            new MagicMatch(2, 3, "\x00\x12", '', 1, []),
        ]),
        new MagicRule('application/x-font-ttx', 50, [
            new MagicMatch(0, 256, '<ttFont sfntVersion="\\x00\\x01\\x00\\x00" ttLibVersion="', '', 1, []),
        ]),
        new MagicRule('application/x-font-vfont', 50, [
            new MagicMatch(0, 1, 'FONT', '', 1, []),
        ]),
        new MagicRule('application/x-gameboy-color-rom', 50, [
            new MagicMatch(260, 261, "\xCE\xEDff\xCC\r\x00\v\x03s\x00\x83\x00\f\x00\r\x00\x08", '', 1, [new MagicMatch(323, 324, "\x80", "\x80", 1, [])]),
        ]),
        new MagicRule('application/x-gameboy-rom', 50, [
            new MagicMatch(260, 261, "\xCE\xEDff\xCC\r\x00\v\x03s\x00\x83\x00\f\x00\r\x00\x08\x11\x1F\x88\x89\x00\x0E", '', 1, [new MagicMatch(323, 324, "\x00", "\x80", 1, [])]),
        ]),
        new MagicRule('application/x-gamecube-rom', 50, [
            new MagicMatch(28, 29, "\xC23\x9F=", '', 1, []),
        ]),
        new MagicRule('application/x-gdbm', 50, [
            new MagicMatch(0, 1, "\x13W\x9A\xCE", '', 1, []),
            new MagicMatch(0, 1, "\xCE\x9AW\x13", '', 1, []),
            new MagicMatch(0, 1, 'GDBM', '', 1, []),
        ]),
        new MagicRule('application/x-gedcom', 50, [
            new MagicMatch(0, 1, '0 HEAD', '', 1, []),
        ]),
        new MagicRule('application/x-genesis-32x-rom', 50, [
            new MagicMatch(256, 257, 'SEGA 32X', '', 1, []),
        ]),
        new MagicRule('application/x-genesis-rom', 50, [
            new MagicMatch(256, 257, 'SEGA GENESIS', '', 1, []),
            new MagicMatch(256, 257, 'SEGA MEGA DRIVE', '', 1, []),
            new MagicMatch(256, 257, 'SEGA_MEGA_DRIVE', '', 1, []),
            new MagicMatch(640, 641, 'EAGN', '', 1, []),
            new MagicMatch(640, 641, 'EAMG', '', 1, []),
        ]),
        new MagicRule('application/x-gettext-translation', 50, [
            new MagicMatch(0, 1, "\xDE\x12\x04\x95", '', 1, []),
            new MagicMatch(0, 1, "\x95\x04\x12\xDE", '', 1, []),
        ]),
        new MagicRule('application/x-glade', 50, [
            new MagicMatch(0, 256, '<glade-interface', '', 1, []),
        ]),
        new MagicRule('application/x-gnumeric', 50, [
            new MagicMatch(0, 64, 'gmr:Workbook', '', 1, []),
            new MagicMatch(0, 64, 'gnm:Workbook', '', 1, []),
        ]),
        new MagicRule('application/x-go-sgf', 50, [
            new MagicMatch(0, 1, '(;FF[3]', '', 1, []),
            new MagicMatch(0, 1, '(;FF[4]', '', 1, []),
        ]),
        new MagicRule('application/x-godot-resource', 50, [
            new MagicMatch(0, 1, '[gd_resource ', '', 1, []),
        ]),
        new MagicRule('application/x-godot-scene', 50, [
            new MagicMatch(0, 1, '[gd_scene ', '', 1, []),
        ]),
        new MagicRule('application/x-gtk-builder', 50, [
            new MagicMatch(0, 256, '<interface', '', 1, []),
        ]),
        new MagicRule('application/x-gtktalog', 50, [
            new MagicMatch(4, 5, 'gtktalog ', '', 1, []),
        ]),
        new MagicRule('application/x-hdf', 50, [
            new MagicMatch(0, 1, "\x89HDF\r\n\x1A\n", '', 1, []),
            new MagicMatch(0, 1, "\x0E\x03\x13\x01", '', 1, []),
        ]),
        new MagicRule('application/x-hfe-floppy-image', 50, [
            new MagicMatch(0, 1, 'HXCPICFE', '', 1, []),
        ]),
        new MagicRule('application/x-hwp', 50, [
            new MagicMatch(0, 1, 'HWP Document File', '', 1, []),
        ]),
        new MagicRule('application/x-ipod-firmware', 50, [
            new MagicMatch(0, 1, 'S T O P', '', 1, []),
        ]),
        new MagicRule('application/x-ips-patch', 50, [
            new MagicMatch(0, 1, 'PATCH', '', 1, []),
        ]),
        new MagicRule('application/x-ipynb+json', 50, [
            new MagicMatch(0, 1, '{', '', 1, [new MagicMatch(1, 256, '"cells":', '', 1, [])]),
        ]),
        new MagicRule('application/x-iso9660-appimage', 50, [
            new MagicMatch(1, 2, 'ELF', '', 1, [new MagicMatch(8, 9, 'A', '', 1, [new MagicMatch(9, 10, 'I', '', 1, [new MagicMatch(10, 11, "\x01", '', 1, [])])])]),
        ]),
        new MagicRule('application/x-it87', 50, [
            new MagicMatch(0, 1, 'IT8.7', '', 1, []),
        ]),
        new MagicRule('application/x-java', 50, [
            new MagicMatch(0, 1, "\xCA\xFE\xBA\xBE", '', 1, []),
        ]),
        new MagicRule('application/x-java-jce-keystore', 50, [
            new MagicMatch(0, 1, "\xCE\xCE\xCE\xCE", '', 4, []),
        ]),
        new MagicRule('application/x-java-jnlp-file', 50, [
            new MagicMatch(0, 256, '<jnlp', '', 1, []),
        ]),
        new MagicRule('application/x-java-keystore', 50, [
            new MagicMatch(0, 1, "\xFE\xED\xFE\xED", '', 1, []),
        ]),
        new MagicRule('application/x-kspread-crypt', 50, [
            new MagicMatch(0, 1, "\r\x1A'\x02", '', 1, []),
        ]),
        new MagicRule('application/x-ksysv-package', 50, [
            new MagicMatch(4, 5, 'KSysV', '', 1, [new MagicMatch(15, 16, "\x01", '', 1, [])]),
        ]),
        new MagicRule('application/x-kword-crypt', 50, [
            new MagicMatch(0, 1, "\r\x1A'\x01", '', 1, []),
        ]),
        new MagicRule('application/x-lyx', 50, [
            new MagicMatch(0, 1, '#LyX', '', 1, []),
        ]),
        new MagicRule('application/x-macbinary', 50, [
            new MagicMatch(102, 103, 'mBIN', '', 1, []),
        ]),
        new MagicRule('application/x-mame-chd', 50, [
            new MagicMatch(0, 1, 'MComprHD', '', 1, []),
        ]),
        new MagicRule('application/x-matroska', 50, [
            new MagicMatch(0, 1, "\x1AE\xDF\xA3", '', 1, [new MagicMatch(5, 65, "B\x82", '', 1, [new MagicMatch(8, 75, 'matroska', '', 1, [])])]),
        ]),
        new MagicRule('application/x-ms-dos-executable', 50, [
            new MagicMatch(0, 1, 'MZ', '', 1, []),
        ]),
        new MagicRule('application/x-ms-wim', 50, [
            new MagicMatch(0, 1, "MSWIM\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('application/x-mswinurl', 50, [
            new MagicMatch(1, 2, 'InternetShortcut', '', 1, []),
            new MagicMatch(1, 2, 'DEFAULT', '', 1, [new MagicMatch(11, 12, 'BASEURL=', '', 1, [])]),
        ]),
        new MagicRule('application/x-n64-rom', 50, [
            new MagicMatch(0, 1, "\x807\x12@", '', 1, []),
            new MagicMatch(0, 1, "7\x80@\x12", '', 1, []),
            new MagicMatch(0, 1, "@\x127\x80", '', 1, []),
        ]),
        new MagicRule('application/x-nautilus-link', 50, [
            new MagicMatch(0, 32, '<nautilus_object nautilus_link', '', 1, []),
        ]),
        new MagicRule('application/x-navi-animation', 50, [
            new MagicMatch(0, 1, 'RIFF', '', 1, [new MagicMatch(8, 9, 'ACON', '', 1, [])]),
        ]),
        new MagicRule('application/x-neo-geo-pocket-color-rom', 50, [
            new MagicMatch(35, 36, "\x10", '', 1, [new MagicMatch(0, 1, 'COPYRIGHT BY SNK CORPORATION', '', 1, []), new MagicMatch(0, 1, ' LICENSED BY SNK CORPORATION', '', 1, [])]),
        ]),
        new MagicRule('application/x-neo-geo-pocket-rom', 50, [
            new MagicMatch(35, 36, "\x00", '', 1, [new MagicMatch(0, 1, 'COPYRIGHT BY SNK CORPORATION', '', 1, []), new MagicMatch(0, 1, ' LICENSED BY SNK CORPORATION', '', 1, [])]),
        ]),
        new MagicRule('application/x-netshow-channel', 50, [
            new MagicMatch(0, 1, '[Address]', '', 1, []),
        ]),
        new MagicRule('application/x-nintendo-3ds-rom', 50, [
            new MagicMatch(256, 257, 'NCSD', '', 1, []),
        ]),
        new MagicRule('application/x-object', 50, [
            new MagicMatch(0, 1, "\x7FELF", '', 1, [new MagicMatch(5, 6, "\x01", '', 1, [new MagicMatch(16, 17, "\x01\x00", '', 1, [])])]),
            new MagicMatch(0, 1, "\x7FELF", '', 1, [new MagicMatch(5, 6, "\x02", '', 1, [new MagicMatch(16, 17, "\x00\x01", '', 1, [])])]),
        ]),
        new MagicRule('application/x-ole-storage', 50, [
            new MagicMatch(0, 1, "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1", '', 1, []),
            new MagicMatch(0, 1, "\xD0\xCF\x11\xE0", '', 1, []),
        ]),
        new MagicRule('application/x-oleo', 50, [
            new MagicMatch(31, 32, 'Oleo', '', 1, []),
        ]),
        new MagicRule('application/x-openzim', 50, [
            new MagicMatch(0, 1, "ZIM\x04", '', 1, []),
        ]),
        new MagicRule('application/x-pef-executable', 50, [
            new MagicMatch(0, 1, 'Joy!', '', 1, []),
        ]),
        new MagicRule('application/x-perl', 50, [
            new MagicMatch(0, 1, 'eval "exec /usr/local/bin/perl', '', 1, []),
            new MagicMatch(2, 16, '/bin/perl', '', 1, []),
            new MagicMatch(2, 16, '/bin/env perl', '', 1, []),
            new MagicMatch(0, 256, 'use Test::', '', 1, []),
        ]),
        new MagicRule('application/x-pocket-word', 50, [
            new MagicMatch(0, 1, '{\\pwi', '', 1, []),
        ]),
        new MagicRule('application/x-pyspread-spreadsheet', 50, [
            new MagicMatch(0, 1, '[Pyspread save file version]', '', 1, []),
        ]),
        new MagicRule('application/x-python-bytecode', 50, [
            new MagicMatch(0, 1, "\x99N\r\n", '', 1, []),
        ]),
        new MagicRule('application/x-qed-disk', 50, [
            new MagicMatch(0, 1, "QED\x00", '', 1, []),
        ]),
        new MagicRule('application/x-qemu-disk', 50, [
            new MagicMatch(0, 1, 'QFI', '', 1, [new MagicMatch(3, 4, "\xFB", '', 1, [])]),
        ]),
        new MagicRule('application/x-qtiplot', 50, [
            new MagicMatch(0, 1, 'QtiPlot', '', 1, []),
        ]),
        new MagicRule('application/x-rpm', 50, [
            new MagicMatch(0, 1, "\xED\xAB\xEE\xDB", '', 1, []),
        ]),
        new MagicRule('application/x-ruby', 50, [
            new MagicMatch(2, 16, '/bin/env ruby', '', 1, []),
            new MagicMatch(2, 16, '/bin/ruby', '', 1, []),
        ]),
        new MagicRule('application/x-sami', 50, [
            new MagicMatch(0, 256, '<SAMI>', '', 1, []),
        ]),
        new MagicRule('application/x-saturn-rom', 50, [
            new MagicMatch(0, 1, 'SEGA SEGASATURN', '', 1, []),
            new MagicMatch(16, 17, 'SEGA SEGASATURN', '', 1, []),
        ]),
        new MagicRule('application/x-sc', 50, [
            new MagicMatch(38, 39, 'Spreadsheet', '', 1, []),
        ]),
        new MagicRule('application/x-sega-pico-rom', 50, [
            new MagicMatch(256, 257, 'SEGA PICO', '', 1, []),
        ]),
        new MagicRule('application/x-sharedlib', 50, [
            new MagicMatch(0, 1, "\x83\x01", '', 1, [new MagicMatch(22, 23, "\x00 ", "\x000", 1, [])]),
        ]),
        new MagicRule('application/x-shellscript', 50, [
            new MagicMatch(10, 11, '# This is a shell archive', '', 1, []),
            new MagicMatch(2, 16, '/bin/bash', '', 1, []),
            new MagicMatch(2, 16, '/bin/nawk', '', 1, []),
            new MagicMatch(2, 16, '/bin/zsh', '', 1, []),
            new MagicMatch(2, 16, '/bin/sh', '', 1, []),
            new MagicMatch(2, 16, '/bin/ksh', '', 1, []),
            new MagicMatch(2, 16, '/bin/dash', '', 1, []),
            new MagicMatch(2, 16, '/bin/env sh', '', 1, []),
            new MagicMatch(2, 16, '/bin/env bash', '', 1, []),
            new MagicMatch(2, 16, '/bin/env zsh', '', 1, []),
            new MagicMatch(2, 16, '/bin/env ksh', '', 1, []),
        ]),
        new MagicRule('application/x-shorten', 50, [
            new MagicMatch(0, 1, 'ajkg', '', 1, []),
        ]),
        new MagicRule('application/x-spss-por', 50, [
            new MagicMatch(40, 41, 'ASCII SPSS PORT FILE', '', 1, []),
        ]),
        new MagicRule('application/x-spss-sav', 50, [
            new MagicMatch(0, 1, '$FL2', '', 1, []),
            new MagicMatch(0, 1, '$FL3', '', 1, []),
        ]),
        new MagicRule('application/x-sqlite2', 50, [
            new MagicMatch(0, 1, '** This file contains an SQLite', '', 1, []),
        ]),
        new MagicRule('application/x-subrip', 50, [
            new MagicMatch(0, 1, '1', '', 1, [new MagicMatch(0, 256, ' --> ', '', 1, [])]),
        ]),
        new MagicRule('application/x-t602', 50, [
            new MagicMatch(0, 1, '@CT 0', '', 1, []),
            new MagicMatch(0, 1, '@CT 1', '', 1, []),
            new MagicMatch(0, 1, '@CT 2', '', 1, []),
        ]),
        new MagicRule('application/x-tgif', 50, [
            new MagicMatch(0, 1, '%TGIF', '', 1, []),
        ]),
        new MagicRule('application/x-thomson-sap-image', 50, [
            new MagicMatch(1, 2, 'SYSTEME D\'ARCHIVAGE PUKALL S.A.P. (c) Alexandre PUKALL Avril 1998', '', 1, []),
        ]),
        new MagicRule('application/x-vdi-disk', 50, [
            new MagicMatch(0, 1, "<<< QEMU VM Virtual Disk Image >>>\n", '', 1, []),
            new MagicMatch(0, 1, "<<< Oracle VM VirtualBox Disk Image >>>\n", '', 1, []),
            new MagicMatch(0, 1, "<<< Sun VirtualBox Disk Image >>>\n", '', 1, []),
            new MagicMatch(0, 1, "<<< Sun xVM VirtualBox Disk Image >>>\n", '', 1, []),
            new MagicMatch(0, 1, '<<< innotek VirtualBox Disk Image >>>', '', 1, []),
            new MagicMatch(0, 1, "<<< CloneVDI VirtualBox Disk Image >>>\n", '', 1, []),
        ]),
        new MagicRule('application/x-vhd-disk', 50, [
            new MagicMatch(0, 1, 'conectix', '', 1, []),
        ]),
        new MagicRule('application/x-vhdx-disk', 50, [
            new MagicMatch(0, 1, 'vhdxfile', '', 1, []),
        ]),
        new MagicRule('application/x-vmdk-disk', 50, [
            new MagicMatch(0, 1, "KDMV\x01\x00\x00\x00", '', 1, []),
            new MagicMatch(0, 1, "KDMV\x02\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('application/x-wii-rom', 50, [
            new MagicMatch(24, 25, "]\x1C\x9E\xA3", '', 1, []),
            new MagicMatch(0, 1, 'WBFS', '', 1, []),
            new MagicMatch(0, 1, "WII\x01DISC", '', 1, []),
        ]),
        new MagicRule('application/x-wii-wad', 50, [
            new MagicMatch(4, 5, "Is\x00\x00", '', 1, []),
            new MagicMatch(4, 5, "ib\x00\x00", '', 1, []),
            new MagicMatch(4, 5, "Bk\x00\x00", '', 1, []),
        ]),
        new MagicRule('application/x-x509-ca-cert', 50, [
            new MagicMatch(0, 1, '-----BEGIN CA CERTIFICATE-----', '', 1, []),
            new MagicMatch(0, 1, '-----BEGIN TRUSTED CERTIFICATE-----', '', 1, []),
        ]),
        new MagicRule('application/x-xbel', 50, [
            new MagicMatch(0, 256, '<!DOCTYPE xbel', '', 1, []),
        ]),
        new MagicRule('application/x-yaml', 50, [
            new MagicMatch(0, 1, '%YAML', '', 1, []),
        ]),
        new MagicRule('application/xslt+xml', 50, [
            new MagicMatch(0, 256, '<xsl:stylesheet', '', 1, []),
        ]),
        new MagicRule('application/xspf+xml', 50, [
            new MagicMatch(0, 64, '<playlist version="1', '', 1, []),
            new MagicMatch(0, 64, '<playlist version=\'1', '', 1, []),
        ]),
        new MagicRule('audio/AMR', 50, [
            new MagicMatch(0, 1, "#!AMR\n", '', 1, []),
            new MagicMatch(0, 1, "#!AMR_MC1.0\n", '', 1, []),
        ]),
        new MagicRule('audio/AMR-WB', 50, [
            new MagicMatch(0, 1, "#!AMR-WB\n", '', 1, []),
            new MagicMatch(0, 1, "#!AMR-WB_MC1.0\n", '', 1, []),
        ]),
        new MagicRule('audio/aac', 50, [
            new MagicMatch(0, 1, 'ADIF', '', 1, []),
            new MagicMatch(0, 1, "\xFF\xF0", "\xFF\xF6", 1, []),
        ]),
        new MagicRule('audio/ac3', 50, [
            new MagicMatch(0, 1, "\vw", '', 1, []),
        ]),
        new MagicRule('audio/annodex', 50, [
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(28, 29, "fishead\x00", '', 1, [new MagicMatch(56, 512, "CMML\x00\x00\x00\x00", '', 1, [])])]),
        ]),
        new MagicRule('audio/flac', 50, [
            new MagicMatch(0, 1, 'fLaC', '', 1, []),
        ]),
        new MagicRule('audio/midi', 50, [
            new MagicMatch(0, 1, 'MThd', '', 1, []),
        ]),
        new MagicRule('audio/mobile-xmf', 50, [
            new MagicMatch(0, 1, "XMF_2.00\x00\x00\x00\x02", '', 1, []),
        ]),
        new MagicRule('audio/mp4', 50, [
            new MagicMatch(4, 5, 'ftypM4A', '', 1, []),
        ]),
        new MagicRule('audio/mpeg', 50, [
            new MagicMatch(0, 1, "\xFF\xFA", '', 1, []),
            new MagicMatch(0, 1, "\xFF\xFB", '', 1, []),
            new MagicMatch(0, 1, "\xFF\xF3", '', 1, []),
            new MagicMatch(0, 1, "\xFF\xF2", '', 1, []),
            new MagicMatch(0, 1, "\xFF\xE3", '', 1, []),
            new MagicMatch(0, 1, "\xFF\xE2", '', 1, []),
            new MagicMatch(0, 1, 'ID3', '', 1, []),
        ]),
        new MagicRule('audio/ogg', 50, [
            new MagicMatch(0, 1, 'OggS', '', 1, []),
        ]),
        new MagicRule('audio/prs.sid', 50, [
            new MagicMatch(0, 1, 'PSID', '', 1, []),
        ]),
        new MagicRule('audio/vnd.audible.aax', 50, [
            new MagicMatch(4, 5, 'ftypaax ', '', 1, []),
        ]),
        new MagicRule('audio/vnd.dts', 50, [
            new MagicMatch(0, 1, "\x7F\xFE\x80\x01", '', 1, []),
            new MagicMatch(0, 1, "\x80\x01\x7F\xFE", '', 1, []),
            new MagicMatch(0, 1, "\x1F\xFF\xE8\x00", '', 1, []),
            new MagicMatch(0, 1, "\xE8\x00\x1F\xFF", '', 1, []),
        ]),
        new MagicRule('audio/x-adpcm', 50, [
            new MagicMatch(0, 1, '.snd', '', 1, [new MagicMatch(12, 13, "\x00\x00\x00\x17", '', 1, [])]),
            new MagicMatch(0, 1, ".sd\x00", '', 1, [new MagicMatch(12, 13, "\x01\x00\x00\x00", '', 1, []), new MagicMatch(12, 13, "\x02\x00\x00\x00", '', 1, []), new MagicMatch(12, 13, "\x03\x00\x00\x00", '', 1, []), new MagicMatch(12, 13, "\x04\x00\x00\x00", '', 1, []), new MagicMatch(12, 13, "\x05\x00\x00\x00", '', 1, []), new MagicMatch(12, 13, "\x06\x00\x00\x00", '', 1, []), new MagicMatch(12, 13, "\x07\x00\x00\x00", '', 1, []), new MagicMatch(12, 13, "\x17\x00\x00\x00", '', 1, [])]),
        ]),
        new MagicRule('audio/x-aifc', 50, [
            new MagicMatch(8, 9, 'AIFC', '', 1, []),
        ]),
        new MagicRule('audio/x-aiff', 50, [
            new MagicMatch(8, 9, 'AIFF', '', 1, []),
            new MagicMatch(8, 9, '8SVX', '', 1, []),
        ]),
        new MagicRule('audio/x-ape', 50, [
            new MagicMatch(0, 1, 'MAC ', '', 1, []),
        ]),
        new MagicRule('audio/x-dff', 50, [
            new MagicMatch(0, 1, 'FRM8', '', 1, [new MagicMatch(12, 13, 'DSD ', '', 1, [])]),
        ]),
        new MagicRule('audio/x-dsf', 50, [
            new MagicMatch(0, 1, 'DSD ', '', 1, [new MagicMatch(28, 29, 'fmt ', '', 1, [new MagicMatch(80, 81, 'data', '', 1, [])])]),
        ]),
        new MagicRule('audio/x-iriver-pla', 50, [
            new MagicMatch(4, 5, 'iriver UMS PLA', '', 1, []),
        ]),
        new MagicRule('audio/x-it', 50, [
            new MagicMatch(0, 1, 'IMPM', '', 1, []),
        ]),
        new MagicRule('audio/x-m4b', 50, [
            new MagicMatch(4, 5, 'ftypM4B', '', 1, []),
        ]),
        new MagicRule('audio/x-mo3', 50, [
            new MagicMatch(0, 1, 'MO3', '', 1, []),
        ]),
        new MagicRule('audio/x-mpegurl', 50, [
            new MagicMatch(0, 1, '#EXTM3U', '', 1, []),
        ]),
        new MagicRule('audio/x-musepack', 50, [
            new MagicMatch(0, 1, 'MP+', '', 1, []),
            new MagicMatch(0, 1, 'MPCK', '', 1, []),
        ]),
        new MagicRule('audio/x-pn-audibleaudio', 50, [
            new MagicMatch(4, 5, "W\x90u6", '', 1, []),
        ]),
        new MagicRule('audio/x-psf', 50, [
            new MagicMatch(0, 1, 'PSF', '', 1, []),
        ]),
        new MagicRule('audio/x-s3m', 50, [
            new MagicMatch(44, 45, 'SCRM', '', 1, []),
        ]),
        new MagicRule('audio/x-scpls', 50, [
            new MagicMatch(0, 1, '[playlist]', '', 1, []),
            new MagicMatch(0, 1, '[Playlist]', '', 1, []),
            new MagicMatch(0, 1, '[PLAYLIST]', '', 1, []),
        ]),
        new MagicRule('audio/x-speex', 50, [
            new MagicMatch(0, 1, 'Speex', '', 1, []),
        ]),
        new MagicRule('audio/x-stm', 50, [
            new MagicMatch(20, 21, "!Scream!\x1A", '', 1, []),
            new MagicMatch(20, 21, "!SCREAM!\x1A", '', 1, []),
            new MagicMatch(20, 21, "BMOD2STM\x1A", '', 1, []),
        ]),
        new MagicRule('audio/x-tak', 50, [
            new MagicMatch(0, 1, 'tBaK', '', 1, []),
        ]),
        new MagicRule('audio/x-tta', 50, [
            new MagicMatch(0, 1, 'TTA1', '', 1, []),
        ]),
        new MagicRule('audio/x-wav', 50, [
            new MagicMatch(8, 9, 'WAVE', '', 1, []),
            new MagicMatch(8, 9, 'WAV ', '', 1, []),
        ]),
        new MagicRule('audio/x-wavpack', 50, [
            new MagicMatch(0, 1, 'wvpk', '', 1, []),
        ]),
        new MagicRule('audio/x-wavpack-correction', 50, [
            new MagicMatch(0, 1, 'wvpk', '', 1, []),
        ]),
        new MagicRule('audio/x-xi', 50, [
            new MagicMatch(0, 1, 'Extended Instrument:', '', 1, []),
        ]),
        new MagicRule('audio/x-xm', 50, [
            new MagicMatch(0, 1, 'Extended Module:', '', 1, []),
        ]),
        new MagicRule('audio/x-xmf', 50, [
            new MagicMatch(0, 1, 'XMF_', '', 1, []),
        ]),
        new MagicRule('font/otf', 50, [
            new MagicMatch(0, 1, 'OTTO', '', 1, []),
        ]),
        new MagicRule('font/ttf', 50, [
            new MagicMatch(0, 1, 'FFIL', '', 1, []),
            new MagicMatch(65, 66, 'FFIL', '', 1, []),
            new MagicMatch(0, 1, "\x00\x01\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('font/woff', 50, [
            new MagicMatch(0, 1, 'wOFF', '', 1, []),
        ]),
        new MagicRule('font/woff2', 50, [
            new MagicMatch(0, 1, 'wOF2', '', 1, []),
        ]),
        new MagicRule('image/avif', 50, [
            new MagicMatch(4, 5, 'ftypavif', '', 1, []),
            new MagicMatch(4, 5, 'ftypavis', '', 1, []),
            new MagicMatch(4, 5, 'ftypmif1', '', 1, [new MagicMatch(16, 17, 'avif', '', 1, []), new MagicMatch(20, 21, 'avif', '', 1, []), new MagicMatch(24, 25, 'avif', '', 1, [])]),
        ]),
        new MagicRule('image/bmp', 50, [
            new MagicMatch(0, 1, "BMxxxx\x00\x00", "\xFF\xFF\x00\x00\x00\x00\xFF\xFF", 1, []),
            new MagicMatch(0, 1, 'BM', '', 1, [new MagicMatch(14, 15, "\f", '', 1, []), new MagicMatch(14, 15, '@', '', 1, []), new MagicMatch(14, 15, '(', '', 1, [])]),
        ]),
        new MagicRule('image/dpx', 50, [
            new MagicMatch(0, 1, 'SDPX', '', 1, []),
        ]),
        new MagicRule('image/emf', 50, [
            new MagicMatch(0, 1, "\x01\x00\x00\x00", '', 1, [new MagicMatch(40, 41, ' EMF', '', 1, [new MagicMatch(44, 45, "\x00\x00\x01\x00", '', 1, [new MagicMatch(58, 59, "\x00\x00", '', 1, [])])])]),
        ]),
        new MagicRule('image/gif', 50, [
            new MagicMatch(0, 1, 'GIF8', '', 1, []),
        ]),
        new MagicRule('image/jp2', 50, [
            new MagicMatch(0, 1, "\x00\x00\x00\fjP  \r\n\x87\n        jp2 ", "\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\xFF\xFF\xFF\xFF", 1, []),
        ]),
        new MagicRule('image/jpeg', 50, [
            new MagicMatch(0, 1, "\xFF\xD8\xFF", '', 1, []),
            new MagicMatch(0, 1, "\xFF\xD8", '', 1, []),
        ]),
        new MagicRule('image/jpm', 50, [
            new MagicMatch(0, 1, "\x00\x00\x00\fjP  \r\n\x87\n        jpm ", "\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\xFF\xFF\xFF\xFF", 1, []),
        ]),
        new MagicRule('image/jpx', 50, [
            new MagicMatch(0, 1, "\x00\x00\x00\fjP  \r\n\x87\n        jpx ", "\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\xFF\xFF\xFF\xFF", 1, []),
        ]),
        new MagicRule('image/jxl', 50, [
            new MagicMatch(0, 1, "\xFF\n", '', 1, []),
            new MagicMatch(0, 1, "\x00\x00\x00\fJXL \r\n\x87\n", '', 1, []),
        ]),
        new MagicRule('image/png', 50, [
            new MagicMatch(0, 1, "\x89PNG", '', 1, []),
        ]),
        new MagicRule('image/tiff', 50, [
            new MagicMatch(0, 1, "MM\x00*", '', 1, []),
            new MagicMatch(0, 1, "II*\x00", '', 1, []),
        ]),
        new MagicRule('image/vnd.adobe.photoshop', 50, [
            new MagicMatch(0, 1, "8BPS  \x00\x00\x00\x00", "\xFF\xFF\xFF\xFF\x00\x00\xFF\xFF\xFF\xFF", 1, []),
        ]),
        new MagicRule('image/vnd.dxf', 50, [
            new MagicMatch(0, 64, "\nHEADER\n", '', 1, []),
            new MagicMatch(0, 64, "\r\nHEADER\r\n", '', 1, []),
        ]),
        new MagicRule('image/vnd.microsoft.icon', 50, [
            new MagicMatch(0, 1, "\x00\x00\x01\x00", '', 1, [new MagicMatch(5, 6, "\x00", '', 1, [])]),
        ]),
        new MagicRule('image/vnd.ms-modi', 50, [
            new MagicMatch(0, 1, "EP*\x00", '', 1, []),
        ]),
        new MagicRule('image/vnd.zbrush.pcx', 50, [
            new MagicMatch(0, 1, "\n", '', 1, [new MagicMatch(1, 2, "\x00", '', 1, []), new MagicMatch(1, 2, "\x02", '', 1, []), new MagicMatch(1, 2, "\x03", '', 1, []), new MagicMatch(1, 2, "\x05", '', 1, [])]),
        ]),
        new MagicRule('image/webp', 50, [
            new MagicMatch(0, 1, 'RIFF', '', 1, [new MagicMatch(8, 9, 'WEBP', '', 1, [])]),
        ]),
        new MagicRule('image/wmf', 50, [
            new MagicMatch(0, 1, "\xD7\xCD\xC6\x9A", '', 1, [new MagicMatch(22, 23, "\x01\x00", '', 1, [new MagicMatch(24, 25, "\t\x00", '', 1, [])])]),
            new MagicMatch(0, 1, "\x01\x00", '', 1, [new MagicMatch(2, 3, "\t\x00", '', 1, [])]),
        ]),
        new MagicRule('image/x-applix-graphics', 50, [
            new MagicMatch(0, 1, '*BEGIN', '', 1, [new MagicMatch(7, 8, 'GRAPHICS', '', 1, [])]),
        ]),
        new MagicRule('image/x-canon-crw', 50, [
            new MagicMatch(0, 1, "II\x1A\x00\x00\x00HEAPCCDR", '', 1, []),
        ]),
        new MagicRule('image/x-dds', 50, [
            new MagicMatch(0, 1, 'DDS', '', 1, []),
        ]),
        new MagicRule('image/x-dib', 50, [
            new MagicMatch(0, 1, "(\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('image/x-exr', 50, [
            new MagicMatch(0, 1, "v/1\x01", '', 1, []),
        ]),
        new MagicRule('image/x-fpx', 50, [
            new MagicMatch(0, 1, 'FPix', '', 1, []),
        ]),
        new MagicRule('image/x-fuji-raf', 50, [
            new MagicMatch(0, 1, 'FUJIFILMCCD-RAW ', '', 1, []),
        ]),
        new MagicRule('image/x-gimp-gbr', 50, [
            new MagicMatch(20, 21, 'GIMP', '', 1, []),
        ]),
        new MagicRule('image/x-gimp-pat', 50, [
            new MagicMatch(20, 21, 'GPAT', '', 1, []),
        ]),
        new MagicRule('image/x-icns', 50, [
            new MagicMatch(0, 1, 'icns', '', 1, []),
        ]),
        new MagicRule('image/x-ilbm', 50, [
            new MagicMatch(8, 9, 'ILBM', '', 1, []),
            new MagicMatch(8, 9, 'PBM ', '', 1, []),
        ]),
        new MagicRule('image/x-jp2-codestream', 50, [
            new MagicMatch(0, 1, "\xFFO\xFFQ", '', 1, []),
        ]),
        new MagicRule('image/x-minolta-mrw', 50, [
            new MagicMatch(0, 1, "\x00MRM", '', 1, []),
        ]),
        new MagicRule('image/x-olympus-orf', 50, [
            new MagicMatch(0, 1, "IIRO\x08\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('image/x-panasonic-rw', 50, [
            new MagicMatch(0, 1, "IIU\x00\x08\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('image/x-panasonic-rw2', 50, [
            new MagicMatch(0, 1, "IIU\x00\x18\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('image/x-pict', 50, [
            new MagicMatch(10, 11, "\x00\x11", '', 1, [new MagicMatch(12, 13, "\x02\xFF", '', 1, [new MagicMatch(14, 15, "\f\x00", '', 1, [new MagicMatch(16, 17, "\xFF\xFE", '', 1, [])])])]),
        ]),
        new MagicRule('image/x-pict', 50, [
            new MagicMatch(522, 523, "\x00\x11", '', 1, [new MagicMatch(524, 525, "\x02\xFF", '', 1, [new MagicMatch(526, 527, "\f\x00", '', 1, [new MagicMatch(528, 529, "\xFF\xFE", '', 1, [])])])]),
        ]),
        new MagicRule('image/x-portable-bitmap', 50, [
            new MagicMatch(0, 1, 'P1', '', 1, [new MagicMatch(2, 3, "\n", '', 1, []), new MagicMatch(2, 3, ' ', '', 1, []), new MagicMatch(2, 3, "\t", '', 1, []), new MagicMatch(2, 3, "\r", '', 1, [])]),
            new MagicMatch(0, 1, 'P4', '', 1, [new MagicMatch(2, 3, "\n", '', 1, []), new MagicMatch(2, 3, ' ', '', 1, []), new MagicMatch(2, 3, "\t", '', 1, []), new MagicMatch(2, 3, "\r", '', 1, [])]),
        ]),
        new MagicRule('image/x-portable-graymap', 50, [
            new MagicMatch(0, 1, 'P2', '', 1, [new MagicMatch(2, 3, "\n", '', 1, []), new MagicMatch(2, 3, ' ', '', 1, []), new MagicMatch(2, 3, "\t", '', 1, []), new MagicMatch(2, 3, "\r", '', 1, [])]),
            new MagicMatch(0, 1, 'P5', '', 1, [new MagicMatch(2, 3, "\n", '', 1, []), new MagicMatch(2, 3, ' ', '', 1, []), new MagicMatch(2, 3, "\t", '', 1, []), new MagicMatch(2, 3, "\r", '', 1, [])]),
        ]),
        new MagicRule('image/x-portable-pixmap', 50, [
            new MagicMatch(0, 1, 'P3', '', 1, [new MagicMatch(2, 3, "\n", '', 1, []), new MagicMatch(2, 3, ' ', '', 1, []), new MagicMatch(2, 3, "\t", '', 1, []), new MagicMatch(2, 3, "\r", '', 1, [])]),
            new MagicMatch(0, 1, 'P6', '', 1, [new MagicMatch(2, 3, "\n", '', 1, []), new MagicMatch(2, 3, ' ', '', 1, []), new MagicMatch(2, 3, "\t", '', 1, []), new MagicMatch(2, 3, "\r", '', 1, [])]),
        ]),
        new MagicRule('image/x-quicktime', 50, [
            new MagicMatch(4, 5, 'idat', '', 1, []),
        ]),
        new MagicRule('image/x-sigma-x3f', 50, [
            new MagicMatch(0, 1, 'FOVb', '', 1, [new MagicMatch(4, 5, "\xFF\x00\xFF\x00", "\x00\xFF\x00\xFF", 1, [])]),
        ]),
        new MagicRule('image/x-skencil', 50, [
            new MagicMatch(0, 1, '##Sketch', '', 1, []),
        ]),
        new MagicRule('image/x-sun-raster', 50, [
            new MagicMatch(0, 1, "Y\xA6j\x95", '', 1, []),
        ]),
        new MagicRule('image/x-tga', 50, [
            new MagicMatch(1, 2, "\x00\x02", '', 1, [new MagicMatch(16, 17, "\x08", '', 1, []), new MagicMatch(16, 17, "\x10", '', 1, []), new MagicMatch(16, 17, "\x18", '', 1, []), new MagicMatch(16, 17, ' ', '', 1, [])]),
        ]),
        new MagicRule('image/x-win-bitmap', 50, [
            new MagicMatch(0, 1, "\x00\x00\x02\x00", '', 1, [new MagicMatch(5, 6, "\x00", '', 1, [])]),
        ]),
        new MagicRule('image/x-xcf', 50, [
            new MagicMatch(0, 1, 'gimp xcf file', '', 1, []),
            new MagicMatch(0, 1, 'gimp xcf v', '', 1, []),
        ]),
        new MagicRule('image/x-xcursor', 50, [
            new MagicMatch(0, 1, 'Xcur', '', 1, []),
        ]),
        new MagicRule('image/x-xfig', 50, [
            new MagicMatch(0, 1, '#FIG', '', 1, []),
        ]),
        new MagicRule('image/x-xpixmap', 50, [
            new MagicMatch(0, 1, '/* XPM */', '', 1, []),
            new MagicMatch(0, 1, "! XPM2\n", '', 1, []),
        ]),
        new MagicRule('message/news', 50, [
            new MagicMatch(0, 1, 'Article', '', 1, []),
            new MagicMatch(0, 1, 'Path:', '', 1, []),
            new MagicMatch(0, 1, 'Xref:', '', 1, []),
        ]),
        new MagicRule('message/rfc822', 50, [
            new MagicMatch(0, 1, '#! rnews', '', 1, []),
            new MagicMatch(0, 1, 'Forward to', '', 1, []),
            new MagicMatch(0, 1, 'From:', '', 1, []),
            new MagicMatch(0, 1, 'N#! rnews', '', 1, []),
            new MagicMatch(0, 1, 'Pipe to', '', 1, []),
            new MagicMatch(0, 1, 'Received:', '', 1, []),
            new MagicMatch(0, 1, 'Relay-Version:', '', 1, []),
            new MagicMatch(0, 1, 'Return-Path:', '', 1, []),
            new MagicMatch(0, 1, 'Return-path:', '', 1, []),
            new MagicMatch(0, 1, 'Subject: ', '', 1, []),
        ]),
        new MagicRule('model/gltf-binary', 50, [
            new MagicMatch(0, 1, 'glTF', '', 1, []),
        ]),
        new MagicRule('model/iges', 50, [
            new MagicMatch(72, 73, "S      1\n", '', 1, []),
            new MagicMatch(72, 73, "S0000001\n", '', 1, []),
        ]),
        new MagicRule('model/mtl', 50, [
            new MagicMatch(0, 1, '# Blender MTL File: \'', '', 1, []),
            new MagicMatch(0, 256, 'newmtl ', '', 1, []),
        ]),
        new MagicRule('model/obj', 50, [
            new MagicMatch(0, 64, ' OBJ File: \'', '', 1, []),
            new MagicMatch(0, 256, 'mtllib ', '', 1, []),
        ]),
        new MagicRule('model/stl', 50, [
            new MagicMatch(0, 1, 'solid', '', 1, []),
            new MagicMatch(0, 1, 'SOLID', '', 1, []),
        ]),
        new MagicRule('model/vrml', 50, [
            new MagicMatch(0, 1, '#VRML ', '', 1, []),
        ]),
        new MagicRule('text/cache-manifest', 50, [
            new MagicMatch(0, 1, 'CACHE MANIFEST', '', 1, [new MagicMatch(14, 15, ' ', '', 1, []), new MagicMatch(14, 15, "\t", '', 1, []), new MagicMatch(14, 15, "\n", '', 1, []), new MagicMatch(14, 15, "\r", '', 1, [])]),
        ]),
        new MagicRule('text/calendar', 50, [
            new MagicMatch(0, 1, 'BEGIN:VCALENDAR', '', 1, []),
            new MagicMatch(0, 1, 'begin:vcalendar', '', 1, []),
        ]),
        new MagicRule('text/html', 50, [
            new MagicMatch(0, 256, '<!DOCTYPE HTML', '', 1, []),
            new MagicMatch(0, 256, '<!doctype html', '', 1, []),
            new MagicMatch(0, 256, '<!DOCTYPE html', '', 1, []),
            new MagicMatch(0, 256, '<HEAD', '', 1, []),
            new MagicMatch(0, 256, '<head', '', 1, []),
            new MagicMatch(0, 256, '<HTML', '', 1, []),
            new MagicMatch(0, 256, '<html', '', 1, []),
            new MagicMatch(0, 256, '<SCRIPT', '', 1, []),
            new MagicMatch(0, 256, '<script', '', 1, []),
            new MagicMatch(0, 1, '<BODY', '', 1, []),
            new MagicMatch(0, 1, '<body', '', 1, []),
            new MagicMatch(0, 1, '<h1', '', 1, []),
            new MagicMatch(0, 1, '<H1', '', 1, []),
            new MagicMatch(0, 1, '<!doctype HTML', '', 1, []),
        ]),
        new MagicRule('text/plain', 50, [
            new MagicMatch(0, 1, 'This is TeX,', '', 1, []),
            new MagicMatch(0, 1, 'This is METAFONT,', '', 1, []),
        ]),
        new MagicRule('text/spreadsheet', 50, [
            new MagicMatch(0, 1, 'ID;', '', 1, []),
        ]),
        new MagicRule('text/troff', 50, [
            new MagicMatch(0, 1, '.\\"', '', 1, []),
            new MagicMatch(0, 1, '\'\\"', '', 1, []),
            new MagicMatch(0, 1, '\'.\\"', '', 1, []),
            new MagicMatch(0, 1, '\\"', '', 1, []),
        ]),
        new MagicRule('text/vcard', 50, [
            new MagicMatch(0, 1, 'BEGIN:VCARD', '', 1, []),
            new MagicMatch(0, 1, 'begin:vcard', '', 1, []),
        ]),
        new MagicRule('text/vnd.graphviz', 50, [
            new MagicMatch(0, 1, 'digraph ', '', 1, []),
            new MagicMatch(0, 1, 'strict digraph ', '', 1, []),
            new MagicMatch(0, 1, 'graph ', '', 1, []),
            new MagicMatch(0, 1, 'strict graph ', '', 1, []),
        ]),
        new MagicRule('text/vnd.sun.j2me.app-descriptor', 50, [
            new MagicMatch(0, 1, 'MIDlet-', '', 1, []),
        ]),
        new MagicRule('text/vnd.trolltech.linguist', 50, [
            new MagicMatch(0, 256, '<TS ', '', 1, []),
            new MagicMatch(0, 256, '<TS>', '', 1, []),
        ]),
        new MagicRule('text/vtt', 50, [
            new MagicMatch(0, 1, 'WEBVTT', '', 1, []),
        ]),
        new MagicRule('text/x-bibtex', 50, [
            new MagicMatch(0, 1, '% This file was created with JabRef', '', 1, []),
        ]),
        new MagicRule('text/x-dbus-service', 50, [
            new MagicMatch(0, 256, "\n[D-BUS Service]\n", '', 1, []),
            new MagicMatch(0, 1, "[D-BUS Service]\n", '', 1, []),
        ]),
        new MagicRule('text/x-devicetree-binary', 50, [
            new MagicMatch(0, 1, "\xD0\r\xFE\xED", '', 1, []),
        ]),
        new MagicRule('text/x-devicetree-source', 50, [
            new MagicMatch(0, 1, "\x00\x00", "\x80\x80", 1, [new MagicMatch(0, 4080, '/dts-v1/', '', 1, [])]),
        ]),
        new MagicRule('text/x-emacs-lisp', 50, [
            new MagicMatch(0, 1, "\n(", '', 1, []),
            new MagicMatch(0, 1, ";ELC\x13\x00\x00\x00", '', 1, []),
        ]),
        new MagicRule('text/x-gcode-gx', 50, [
            new MagicMatch(0, 1, 'xgcode 1.0', '', 1, []),
        ]),
        new MagicRule('text/x-gettext-translation-template', 50, [
            new MagicMatch(0, 256, "#, fuzzy\nmsgid \"\"\nmsgstr \"\"\n\"Project-Id-Version:", '', 1, []),
        ]),
        new MagicRule('text/x-google-video-pointer', 50, [
            new MagicMatch(0, 1, '#.download.the.free.Google.Video.Player', '', 1, []),
            new MagicMatch(0, 1, '# download the free Google Video Player', '', 1, []),
        ]),
        new MagicRule('text/x-iMelody', 50, [
            new MagicMatch(0, 1, 'BEGIN:IMELODY', '', 1, []),
        ]),
        new MagicRule('text/x-iptables', 50, [
            new MagicMatch(0, 256, '/etc/sysconfig/iptables', '', 1, []),
            new MagicMatch(0, 256, '*filter', '', 1, [new MagicMatch(0, 256, ':INPUT', '', 1, [new MagicMatch(0, 256, ':FORWARD', '', 1, [new MagicMatch(0, 256, ':OUTPUT', '', 1, [])])])]),
            new MagicMatch(0, 256, '-A INPUT', '', 1, [new MagicMatch(0, 256, '-A FORWARD', '', 1, [new MagicMatch(0, 256, '-A OUTPUT', '', 1, [])])]),
            new MagicMatch(0, 256, '-P INPUT', '', 1, [new MagicMatch(0, 256, '-P FORWARD', '', 1, [new MagicMatch(0, 256, '-P OUTPUT', '', 1, [])])]),
        ]),
        new MagicRule('text/x-ldif', 50, [
            new MagicMatch(0, 1, 'dn: cn=', '', 1, []),
            new MagicMatch(0, 1, 'dn: mail=', '', 1, []),
        ]),
        new MagicRule('text/x-lua', 50, [
            new MagicMatch(2, 16, '/bin/lua', '', 1, []),
            new MagicMatch(2, 16, '/bin/luajit', '', 1, []),
            new MagicMatch(2, 16, '/bin/env lua', '', 1, []),
            new MagicMatch(2, 16, '/bin/env luajit', '', 1, []),
        ]),
        new MagicRule('text/x-makefile', 50, [
            new MagicMatch(0, 1, '#!/usr/bin/make', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/bin/make', '', 1, []),
        ]),
        new MagicRule('text/x-matlab', 50, [
            new MagicMatch(0, 1, 'function', '', 1, []),
        ]),
        new MagicRule('text/x-microdvd', 50, [
            new MagicMatch(0, 1, '{1}', '', 1, []),
            new MagicMatch(0, 1, '{0}', '', 1, []),
            new MagicMatch(0, 6, '}{', '', 1, []),
        ]),
        new MagicRule('text/x-modelica', 50, [
            new MagicMatch(0, 1, 'function', '', 1, []),
        ]),
        new MagicRule('text/x-modelica', 50, [
            new MagicMatch(0, 1, 'class', '', 1, []),
        ]),
        new MagicRule('text/x-modelica', 50, [
            new MagicMatch(0, 1, 'model', '', 1, []),
        ]),
        new MagicRule('text/x-modelica', 50, [
            new MagicMatch(0, 1, 'record', '', 1, []),
        ]),
        new MagicRule('text/x-mpl2', 50, [
            new MagicMatch(0, 1, '[1]', '', 1, []),
            new MagicMatch(0, 1, '[0]', '', 1, []),
            new MagicMatch(0, 6, '][', '', 1, []),
        ]),
        new MagicRule('text/x-mpsub', 50, [
            new MagicMatch(0, 256, 'FORMAT=', '', 1, []),
        ]),
        new MagicRule('text/x-mrml', 50, [
            new MagicMatch(0, 1, '<mrml ', '', 1, []),
        ]),
        new MagicRule('text/x-ms-regedit', 50, [
            new MagicMatch(0, 1, 'REGEDIT', '', 1, []),
            new MagicMatch(0, 1, 'Windows Registry Editor Version 5.00', '', 1, []),
            new MagicMatch(0, 1, "\xFF\xFEW\x00i\x00n\x00d\x00o\x00w\x00s\x00 \x00R\x00e\x00g\x00i\x00s\x00t\x00r\x00y\x00 \x00E\x00d\x00i\x00t\x00o\x00r\x00", '', 1, []),
        ]),
        new MagicRule('text/x-mup', 50, [
            new MagicMatch(0, 1, '//!Mup', '', 1, []),
        ]),
        new MagicRule('text/x-patch', 50, [
            new MagicMatch(0, 1, "diff\t", '', 1, []),
            new MagicMatch(0, 1, 'diff ', '', 1, []),
            new MagicMatch(0, 1, "***\t", '', 1, []),
            new MagicMatch(0, 1, '*** ', '', 1, []),
            new MagicMatch(0, 1, '=== ', '', 1, []),
            new MagicMatch(0, 1, '--- ', '', 1, []),
            new MagicMatch(0, 1, "Only in\t", '', 1, []),
            new MagicMatch(0, 1, 'Only in ', '', 1, []),
            new MagicMatch(0, 1, 'Common subdirectories: ', '', 1, []),
            new MagicMatch(0, 1, 'Index:', '', 1, []),
        ]),
        new MagicRule('text/x-python', 50, [
            new MagicMatch(0, 1, '#!/bin/python', '', 1, []),
            new MagicMatch(0, 1, '#! /bin/python', '', 1, []),
            new MagicMatch(0, 1, 'eval "exec /bin/python', '', 1, []),
            new MagicMatch(0, 1, '#!/usr/bin/python', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/bin/python', '', 1, []),
            new MagicMatch(0, 1, 'eval "exec /usr/bin/python', '', 1, []),
            new MagicMatch(0, 1, '#!/usr/local/bin/python', '', 1, []),
            new MagicMatch(0, 1, '#! /usr/local/bin/python', '', 1, []),
            new MagicMatch(0, 1, 'eval "exec /usr/local/bin/python', '', 1, []),
            new MagicMatch(2, 16, '/bin/env python', '', 1, []),
        ]),
        new MagicRule('text/x-qml', 50, [
            new MagicMatch(2, 16, '/bin/env qml', '', 1, []),
            new MagicMatch(0, 3000, 'import Qt', '', 1, [new MagicMatch(9, 3009, '{', '', 1, [])]),
            new MagicMatch(0, 3000, 'import Qml', '', 1, [new MagicMatch(9, 3009, '{', '', 1, [])]),
        ]),
        new MagicRule('text/x-rpm-spec', 50, [
            new MagicMatch(0, 1, 'Summary: ', '', 1, []),
            new MagicMatch(0, 1, '%define ', '', 1, []),
        ]),
        new MagicRule('text/x-ssa', 50, [
            new MagicMatch(0, 256, '[Script Info]', '', 1, []),
            new MagicMatch(0, 256, 'Dialogue: ', '', 1, []),
        ]),
        new MagicRule('text/x-subviewer', 50, [
            new MagicMatch(0, 1, '[INFORMATION]', '', 1, []),
        ]),
        new MagicRule('text/x-systemd-unit', 50, [
            new MagicMatch(0, 256, "\n[Unit]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Install]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Automount]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Mount]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Path]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Scope]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Service]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Slice]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Socket]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Swap]\n", '', 1, []),
            new MagicMatch(0, 256, "\n[Timer]\n", '', 1, []),
            new MagicMatch(0, 1, "[Unit]\n", '', 1, []),
            new MagicMatch(0, 1, "[Install]\n", '', 1, []),
            new MagicMatch(0, 1, "[Automount]\n", '', 1, []),
            new MagicMatch(0, 1, "[Mount]\n", '', 1, []),
            new MagicMatch(0, 1, "[Path]\n", '', 1, []),
            new MagicMatch(0, 1, "[Scope]\n", '', 1, []),
            new MagicMatch(0, 1, "[Service]\n", '', 1, []),
            new MagicMatch(0, 1, "[Slice]\n", '', 1, []),
            new MagicMatch(0, 1, "[Socket]\n", '', 1, []),
            new MagicMatch(0, 1, "[Swap]\n", '', 1, []),
            new MagicMatch(0, 1, "[Timer]\n", '', 1, []),
        ]),
        new MagicRule('text/x-tex', 50, [
            new MagicMatch(1, 2, 'documentclass', '', 1, []),
        ]),
        new MagicRule('text/x-uuencode', 50, [
            new MagicMatch(0, 1, 'begin ', '', 1, []),
        ]),
        new MagicRule('text/xmcd', 50, [
            new MagicMatch(0, 1, '# xmcd', '', 1, []),
        ]),
        new MagicRule('video/3gpp', 50, [
            new MagicMatch(4, 5, 'ftyp3ge', '', 1, []),
            new MagicMatch(4, 5, 'ftyp3gg', '', 1, []),
            new MagicMatch(4, 5, 'ftyp3gp', '', 1, []),
            new MagicMatch(4, 5, 'ftyp3gs', '', 1, []),
        ]),
        new MagicRule('video/3gpp2', 50, [
            new MagicMatch(4, 5, 'ftyp3g2', '', 1, []),
        ]),
        new MagicRule('video/annodex', 50, [
            new MagicMatch(0, 1, 'OggS', '', 1, [new MagicMatch(28, 29, "fishead\x00", '', 1, [new MagicMatch(56, 512, "CMML\x00\x00\x00\x00", '', 1, [])])]),
        ]),
        new MagicRule('video/dv', 50, [
            new MagicMatch(0, 1, "\x1F\x07\x00\x00", "\xFF\xFF\xFF\x00", 1, []),
        ]),
        new MagicRule('video/mj2', 50, [
            new MagicMatch(0, 1, "\x00\x00\x00\fjP  \r\n\x87\n        mjp2", "\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\xFF\x00\x00\x00\x00\x00\x00\x00\x00\xFF\xFF\xFF\xFF", 1, []),
        ]),
        new MagicRule('video/mp2t', 50, [
            new MagicMatch(0, 1, 'G', '', 1, [new MagicMatch(188, 189, 'G', '', 1, [new MagicMatch(376, 377, 'G', '', 1, [new MagicMatch(564, 565, 'G', '', 1, [new MagicMatch(752, 753, 'G', '', 1, [])])])])]),
            new MagicMatch(4, 5, 'G', '', 1, [new MagicMatch(196, 197, 'G', '', 1, [new MagicMatch(388, 389, 'G', '', 1, [new MagicMatch(580, 581, 'G', '', 1, [new MagicMatch(772, 773, 'G', '', 1, [])])])])]),
        ]),
        new MagicRule('video/mp4', 50, [
            new MagicMatch(4, 5, 'ftypisom', '', 1, []),
            new MagicMatch(4, 5, 'ftypmp41', '', 1, []),
            new MagicMatch(4, 5, 'ftypmp42', '', 1, []),
            new MagicMatch(4, 5, 'ftypMSNV', '', 1, []),
            new MagicMatch(4, 5, 'ftypM4V ', '', 1, []),
            new MagicMatch(4, 5, 'ftypf4v ', '', 1, []),
        ]),
        new MagicRule('video/mpeg', 50, [
            new MagicMatch(0, 1, "G?\xFF\x10", '', 1, []),
            new MagicMatch(0, 1, "\x00\x00\x01\xB3", '', 1, []),
            new MagicMatch(0, 1, "\x00\x00\x01\xBA", '', 1, []),
        ]),
        new MagicRule('video/ogg', 50, [
            new MagicMatch(0, 1, 'OggS', '', 1, []),
        ]),
        new MagicRule('video/quicktime', 50, [
            new MagicMatch(12, 13, 'mdat', '', 1, []),
            new MagicMatch(4, 5, 'mdat', '', 1, []),
            new MagicMatch(4, 5, 'moov', '', 1, []),
            new MagicMatch(4, 5, 'ftypqt', '', 1, []),
        ]),
        new MagicRule('video/vnd.mpegurl', 50, [
            new MagicMatch(0, 1, '#EXTM4U', '', 1, []),
        ]),
        new MagicRule('video/vnd.radgamettools.bink', 50, [
            new MagicMatch(0, 1, 'BIK', '', 1, [new MagicMatch(3, 4, 'b', '', 1, []), new MagicMatch(3, 4, 'f', '', 1, []), new MagicMatch(3, 4, 'g', '', 1, []), new MagicMatch(3, 4, 'h', '', 1, []), new MagicMatch(3, 4, 'i', '', 1, [])]),
            new MagicMatch(0, 1, 'KB2', '', 1, [new MagicMatch(3, 4, 'a', '', 1, []), new MagicMatch(3, 4, 'd', '', 1, []), new MagicMatch(3, 4, 'f', '', 1, []), new MagicMatch(3, 4, 'g', '', 1, []), new MagicMatch(3, 4, 'h', '', 1, []), new MagicMatch(3, 4, 'i', '', 1, []), new MagicMatch(3, 4, 'j', '', 1, []), new MagicMatch(3, 4, 'k', '', 1, [])]),
        ]),
        new MagicRule('video/vnd.radgamettools.smacker', 50, [
            new MagicMatch(0, 1, 'SMK', '', 1, [new MagicMatch(3, 4, '2', '', 1, []), new MagicMatch(3, 4, '4', '', 1, [])]),
        ]),
        new MagicRule('video/vnd.youtube.yt', 50, [
            new MagicMatch(4, 5, 'ftypyt4 ', '', 1, []),
        ]),
        new MagicRule('video/webm', 50, [
            new MagicMatch(0, 1, "\x1AE\xDF\xA3", '', 1, [new MagicMatch(5, 65, "B\x82", '', 1, [new MagicMatch(8, 75, 'webm', '', 1, [])])]),
        ]),
        new MagicRule('video/x-flic', 50, [
            new MagicMatch(0, 1, "\x11\xAF", '', 1, []),
            new MagicMatch(0, 1, "\x12\xAF", '', 1, []),
        ]),
        new MagicRule('video/x-flv', 50, [
            new MagicMatch(0, 1, 'FLV', '', 1, []),
        ]),
        new MagicRule('video/x-mng', 50, [
            new MagicMatch(0, 1, "\x8AMNG\r\n\x1A\n", '', 1, []),
        ]),
        new MagicRule('video/x-msvideo', 50, [
            new MagicMatch(0, 1, 'RIFF', '', 1, [new MagicMatch(8, 9, 'AVI ', '', 1, [])]),
            new MagicMatch(0, 1, 'AVF0', '', 1, [new MagicMatch(8, 9, 'AVI ', '', 1, [])]),
        ]),
        new MagicRule('video/x-nsv', 50, [
            new MagicMatch(0, 1, 'NSVf', '', 1, []),
        ]),
        new MagicRule('video/x-sgi-movie', 50, [
            new MagicMatch(0, 1, 'MOVI', '', 1, []),
        ]),
        new MagicRule('x-epoc/x-sisx-app', 50, [
            new MagicMatch(0, 1, "z\x1A \x10", '', 1, []),
        ]),
        new MagicRule('application/x-archive', 45, [
            new MagicMatch(0, 1, '<ar>', '', 1, []),
            new MagicMatch(0, 1, '!<arch>', '', 1, []),
        ]),
        new MagicRule('application/x-riff', 45, [
            new MagicMatch(0, 1, 'RIFF', '', 1, []),
        ]),
        new MagicRule('image/svg+xml', 45, [
            new MagicMatch(1, 256, '<svg', '', 1, []),
        ]),
        new MagicRule('application/sparql-query', 40, [
            new MagicMatch(0, 1, 'PREFIX', '', 1, []),
        ]),
        new MagicRule('application/x-executable', 40, [
            new MagicMatch(0, 1, "\x7FELF", '', 1, [new MagicMatch(5, 6, "\x01", '', 1, [])]),
            new MagicMatch(0, 1, "\x7FELF", '', 1, [new MagicMatch(5, 6, "\x02", '', 1, [])]),
            new MagicMatch(0, 1, 'MZ', '', 1, []),
            new MagicMatch(0, 1, "\x1CR", '', 1, []),
            new MagicMatch(0, 1, "\x01\x10", '', 2, []),
            new MagicMatch(0, 1, "\x01\x11", '', 2, []),
            new MagicMatch(0, 1, "\x83\x01", '', 1, []),
        ]),
        new MagicRule('application/x-iff', 40, [
            new MagicMatch(0, 1, 'FORM', '', 1, []),
        ]),
        new MagicRule('application/x-nintendo-3ds-executable', 40, [
            new MagicMatch(0, 1, '3DSX', '', 1, []),
        ]),
        new MagicRule('application/x-perl', 40, [
            new MagicMatch(0, 256, 'use strict', '', 1, []),
            new MagicMatch(0, 256, 'use warnings', '', 1, []),
            new MagicMatch(0, 256, 'use diagnostics', '', 1, []),
            new MagicMatch(0, 256, "\n=pod", '', 1, []),
            new MagicMatch(0, 256, "\n=head1 NAME", '', 1, []),
            new MagicMatch(0, 256, "\n=head1 DESCRIPTION", '', 1, []),
            new MagicMatch(0, 256, 'BEGIN {', '', 1, []),
        ]),
        new MagicRule('application/xml', 40, [
            new MagicMatch(0, 1, '<?xml', '', 1, []),
        ]),
        new MagicRule('audio/basic', 40, [
            new MagicMatch(0, 1, '.snd', '', 1, []),
        ]),
        new MagicRule('audio/x-mod', 40, [
            new MagicMatch(0, 1, 'MTM', '', 1, []),
            new MagicMatch(0, 1, 'MMD0', '', 1, []),
            new MagicMatch(0, 1, 'MMD1', '', 1, []),
            new MagicMatch(112, 113, "\x00", "\x80", 1, [new MagicMatch(0, 1, 'if', '', 1, [new MagicMatch(368, 369, "\x00", "\xE0", 1, [new MagicMatch(110, 111, "\x00", "\xC0", 1, [new MagicMatch(111, 112, "\x00", "\x80", 1, []), new MagicMatch(111, 112, "\x80", '', 1, [])]), new MagicMatch(110, 111, '@', '', 1, [new MagicMatch(111, 112, "\x00", "\x80", 1, []), new MagicMatch(111, 112, "\x80", '', 1, [])])]), new MagicMatch(368, 369, ' ', '', 1, [new MagicMatch(110, 111, "\x00", "\xC0", 1, [new MagicMatch(111, 112, "\x00", "\x80", 1, []), new MagicMatch(111, 112, "\x80", '', 1, [])]), new MagicMatch(110, 111, '@', '', 1, [new MagicMatch(111, 112, "\x00", "\x80", 1, []), new MagicMatch(111, 112, "\x80", '', 1, [])])])]), new MagicMatch(0, 1, 'JN', '', 1, [new MagicMatch(368, 369, "\x00", "\xE0", 1, [new MagicMatch(110, 111, "\x00", "\xC0", 1, [new MagicMatch(111, 112, "\x00", "\x80", 1, []), new MagicMatch(111, 112, "\x80", '', 1, [])])]), new MagicMatch(368, 369, ' ', '', 1, [new MagicMatch(110, 111, '@', '', 1, [new MagicMatch(111, 112, "\x00", "\x80", 1, []), new MagicMatch(111, 112, "\x80", '', 1, [])])])])]),
            new MagicMatch(0, 1, 'MAS_UTrack_V00', '', 1, []),
            new MagicMatch(1080, 1081, 'M.K.', '', 1, []),
            new MagicMatch(1080, 1081, 'M!K!', '', 1, []),
        ]),
        new MagicRule('image/heif', 40, [
            new MagicMatch(4, 5, 'ftypmif1', '', 1, []),
            new MagicMatch(4, 5, 'ftypmsf1', '', 1, []),
            new MagicMatch(4, 5, 'ftypheic', '', 1, []),
            new MagicMatch(4, 5, 'ftypheix', '', 1, []),
            new MagicMatch(4, 5, 'ftyphevc', '', 1, []),
            new MagicMatch(4, 5, 'ftyphevx', '', 1, []),
        ]),
        new MagicRule('text/html', 40, [
            new MagicMatch(0, 1, '<!--', '', 1, []),
            new MagicMatch(0, 256, '<TITLE', '', 1, []),
            new MagicMatch(0, 256, '<title', '', 1, []),
        ]),
        new MagicRule('text/x-devicetree-source', 40, [
            new MagicMatch(0, 1, "\x00\x00", "\x80\x80", 1, [new MagicMatch(0, 4090, '/ {', '', 1, []), new MagicMatch(0, 4080, 'include ', '', 1, [new MagicMatch(10, 4090, '.dts', '', 1, [])])]),
        ]),
        new MagicRule('video/x-javafx', 40, [
            new MagicMatch(0, 1, 'FLV', '', 1, []),
        ]),
        new MagicRule('application/x-mobipocket-ebook', 30, [
            new MagicMatch(60, 61, 'TEXtREAd', '', 1, []),
        ]),
        new MagicRule('image/x-3ds', 30, [
            new MagicMatch(0, 1, 'MM', '', 1, []),
        ]),
        new MagicRule('text/x-csrc', 30, [
            new MagicMatch(0, 1, '/*', '', 1, []),
            new MagicMatch(0, 1, '//', '', 1, []),
            new MagicMatch(0, 1, '#include', '', 1, []),
        ]),
        new MagicRule('text/x-objcsrc', 30, [
            new MagicMatch(0, 1, '#import', '', 1, []),
        ]),
        new MagicRule('application/mbox', 20, [
            new MagicMatch(0, 1, 'From ', '', 1, []),
        ]),
        new MagicRule('image/x-tga', 10, [
            new MagicMatch(1, 2, "\x01\x01", '', 1, []),
            new MagicMatch(1, 2, "\x01\t", '', 1, []),
            new MagicMatch(1, 2, "\x00\x03", '', 1, []),
            new MagicMatch(1, 2, "\x00\n", '', 1, []),
            new MagicMatch(1, 2, "\x00\v", '', 1, []),
        ]),
        new MagicRule('text/x-matlab', 10, [
            new MagicMatch(0, 1, '%', '', 1, []),
        ]),
        new MagicRule('text/x-matlab', 10, [
            new MagicMatch(0, 1, '##', '', 1, []),
        ]),
        new MagicRule('text/x-modelica', 10, [
            new MagicMatch(0, 1, '//', '', 1, []),
        ]),
        new MagicRule('text/x-tex', 10, [
            new MagicMatch(0, 1, '%', '', 1, []),
        ]),
    ],
);
