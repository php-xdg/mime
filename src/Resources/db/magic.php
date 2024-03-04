<?php declare(strict_types=1);

use Xdg\Mime\Runtime\MagicDatabase;
use Xdg\Mime\Runtime\MagicMatch;
use Xdg\Mime\Runtime\MagicRegex;
use Xdg\Mime\Runtime\MagicRule;
use Xdg\Mime\Utils\Bytes;

$swap = Bytes::isLittleEndianPlatform() ? 1 : 0;

return new MagicDatabase(
    lookupBufferSize: 18730,
    rules: [
        new MagicRule('application/vnd.stardivision.writer', 90, 8209, [
            new MagicRegex('~(?n)\A((?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}@\~\\\\\xDC\\\\\xB3\x1B\x10\x99a\x04\x02\x1C\x00p\x02|.{592}.{0,7600}\xB0\xE9\x04\x8B\x0EB\xD0\x11\xA4\^\x00\xA0\$\x9DW\xB1|.{592}.{0,7600}\xD1\xF9\f\xC2\xAE\x85\xD1\x11\xAA\xB4\x00\x06\t\}V\x1A)|(*FAIL))|.{2089}StarWriter)~Ss'),
        ]),
        new MagicRule('application/x-docbook+xml', 90, 126, [
            new MagicRegex('~(?n)\A(?(?=\<\?xml)(.{0,100}\-//OASIS//DTD DocBook XML|.{0,100}\-//KDE//DTD DocBook XML)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-eris-link+cbor', 90, 10, [
            new MagicMatch(0, 1, "\xD9\xD9\xF7\x84\xD9\x01\x14XB", '', 0),
        ]),
        new MagicRule('image/x-eps', 90, 20, [
            new MagicRegex('~(?n)\A((?(?=%\!).{15}EPS|(*FAIL))|(?(?=\x04%\!).{16}EPS|(*FAIL))|\xC5\xD0\xD3\xC6)~Ss'),
        ]),
        new MagicRule('application/prs.plucker', 80, 69, [
            new MagicMatch(60, 1, 'DataPlkr', '', 0),
        ]),
        new MagicRule('application/schema+json', 80, 267, [
            new MagicRegex('~(?n)\A(?(?=\{).{1}.{0,255}"\$schema"\:|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.corel-draw', 80, 17, [
            new MagicRegex('~(?n)\A.{8}CDR.vrsn~Ss'),
        ]),
        new MagicRule('application/vnd.microsoft.portable-executable', 80, 261, [
            new MagicRegex('~(?n)\A(?(?=MZ).{64}.{0,192}PE\x00\x00|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-fictionbook+xml', 80, 269, [
            new MagicRegex('~(?n)\A.{0,256}\<FictionBook~Ss'),
        ]),
        new MagicRule('application/x-mobipocket-ebook', 80, 69, [
            new MagicMatch(60, 1, 'BOOKMOBI', '', 0),
        ]),
        new MagicRule('application/x-mozilla-bookmarks', 80, 100, [
            new MagicRegex('~(?n)\A.{0,64}\<\!DOCTYPE NETSCAPE\-Bookmark\-file\-1\>~Ss'),
        ]),
        new MagicRule('application/x-nzb', 80, 261, [
            new MagicRegex('~(?n)\A.{0,256}\<nzb~Ss'),
        ]),
        new MagicRule('application/x-php', 80, 70, [
            new MagicRegex('~(?n)\A.{0,64}\<\?php~Ss'),
        ]),
        new MagicRule('application/xliff+xml', 80, 263, [
            new MagicRegex('~(?n)\A.{0,256}\<xliff~Ss'),
        ]),
        new MagicRule('audio/x-flac+ogg', 80, 34, [
            new MagicRegex('~(?n)\A((?(?=OggS).{28}fLaC|(*FAIL))|(?(?=OggS).{28}\x7FFLAC|(*FAIL)))~Ss'),
        ]),
        new MagicRule('audio/x-opus+ogg', 80, 37, [
            new MagicRegex('~(?n)\A(?(?=OggS).{28}OpusHead|(*FAIL))~Ss'),
        ]),
        new MagicRule('audio/x-speex+ogg', 80, 36, [
            new MagicRegex('~(?n)\A(?(?=OggS).{28}Speex  |(*FAIL))~Ss'),
        ]),
        new MagicRule('audio/x-vorbis+ogg', 80, 36, [
            new MagicRegex('~(?n)\A(?(?=OggS).{28}\x01vorbis|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/astc', 80, 5, [
            new MagicMatch(0, 1, "\x13\xAB\xA1\\", '', 0),
        ]),
        new MagicRule('image/ktx', 80, 13, [
            new MagicRegex('~(?n)\A(?(?=\xABKTX)(?(?=.{4} 11\xBB).{8}\r\n\x1A\n|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/ktx2', 80, 13, [
            new MagicRegex('~(?n)\A(?(?=\xABKTX)(?(?=.{4} 20\xBB).{8}\r\n\x1A\n|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/svg+xml', 80, 270, [
            new MagicRegex('~(?n)\A.{0,256}\<\!DOCTYPE svg~Ss'),
        ]),
        new MagicRule('image/svg+xml', 80, 27, [
            new MagicRegex('~(?n)\A(\<\!\-\- Created with Inkscape|\<svg)~Ss'),
        ]),
        new MagicRule('image/vnd.djvu', 80, 17, [
            new MagicRegex('~(?n)\A((?(?=AT&TFORM).{12}DJVU|(*FAIL))|(?(?=FORM).{8}DJVU|(*FAIL)))~Ss'),
        ]),
        new MagicRule('image/vnd.djvu+multipage', 80, 17, [
            new MagicRegex('~(?n)\A((?(?=AT&TFORM).{12}DJVM|(*FAIL))|(?(?=FORM).{8}DJVM|(*FAIL)))~Ss'),
        ]),
        new MagicRule('image/x-kodak-kdc', 80, 264, [
            new MagicMatch(242, 1, 'EASTMAN KODAK COMPANY', '', 0),
        ]),
        new MagicRule('image/x-niff', 80, 5, [
            new MagicMatch(0, 1, 'IIN1', '', 0),
        ]),
        new MagicRule('video/x-ogm+ogg', 80, 35, [
            new MagicRegex('~(?n)\A(?(?=OggS).{29}video|(*FAIL))~Ss'),
        ]),
        new MagicRule('video/x-theora+ogg', 80, 36, [
            new MagicRegex('~(?n)\A(?(?=OggS).{28}\x80theora|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/atom+xml', 70, 263, [
            new MagicRegex('~(?n)\A.{0,256}\<feed ~Ss'),
        ]),
        new MagicRule('application/epub+zip', 70, 64, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype)(.{38}application/epub\+zip|.{43}application/epub\+zip)|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/rss+xml', 70, 262, [
            new MagicRegex('~(?n)\A(.{0,256}\<rss |.{0,256}\<RSS )~Ss'),
        ]),
        new MagicRule('application/vnd.apple.keynote', 70, 41, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04).{30}index\.apxl|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.apple.mpegurl', 70, 150, [
            new MagicRegex('~(?n)\A(?(?=\#EXTM3U)(.{0,128}\#EXT\-X\-TARGETDURATION|.{0,128}\#EXT\-X\-STREAM\-INF)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.apple.pages', 70, 49, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(.{30}index\.xml|.{30}Index/Document\.iwa)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.chart', 70, 79, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.chart|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.chart-template', 70, 88, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.chart\-template|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.database', 70, 78, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.base|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.formula', 70, 81, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.formula|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.formula-template', 70, 90, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.formula\-template|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.graphics', 70, 82, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.graphics|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.graphics-template', 70, 91, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.graphics\-template|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.image', 70, 79, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.image|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.presentation', 70, 86, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.presentation|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.presentation-template', 70, 95, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.presentation\-template|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.spreadsheet', 70, 85, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.spreadsheet|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.spreadsheet-template', 70, 94, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.spreadsheet\-template|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text', 70, 78, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.text|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text-master', 70, 85, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.text\-master|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text-template', 70, 87, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.text\-template|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.oasis.opendocument.text-web', 70, 82, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.oasis\.opendocument\.text\-web|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.stardivision.impress', 70, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}\!r\\\\V\xBC\x85\xD1\x11\x89\xD0\x00\x80\)\xE4\xB0\xB1|.{592}.{0,7600}\xC0\<\-\x01\x16B\xD0\x11\x89\xCB\x00\x80\)\xE4\xB0\xB1|.{592}.{0,7600}\xE0\xAA\x10\xAFm\xB3\x1B\x10\x99a\x04\x02\x1C\x00p\x02)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.calc', 70, 67, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.calc|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.calc.template', 70, 67, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.calc|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.draw', 70, 67, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.draw|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.draw.template', 70, 67, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.draw|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.impress', 70, 70, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.impress|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.impress.template', 70, 70, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.impress|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.math', 70, 67, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.math|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.writer', 70, 69, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.writer|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.writer.global', 70, 69, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.writer|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.sun.xml.writer.template', 70, 69, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/vnd\.sun\.xml\.writer|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-ms-ne-executable', 70, 259, [
            new MagicRegex('~(?n)\A(?(?=MZ).{64}.{0,192}NE|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-zip-compressed-fb2', 70, 261, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04).{30}.{0,226}\.fb2|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/openraster', 70, 55, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}image/openraster|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('text/x-opml+xml', 70, 263, [
            new MagicRegex('~(?n)\A.{0,256}\<opml ~Ss'),
        ]),
        new MagicRule('application/vnd.apple.numbers', 65, 49, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04)(.{30}index\.xml|.{30}Index/Document\.iwa)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.apple.pkpass', 65, 40, [
            new MagicRegex('~(?n)\A(?(?=PK\x03\x04).{30}pass\.json|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/ovf', 62, 266, [
            new MagicRegex('~(?n)\A(?(?=.{1}.{0,255}\.ovf)(.{257}ustar\x00|.{257}ustar  \x00)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/hta', 60, 273, [
            new MagicRegex('~(?n)\A(.{0,256}\<hta\:application|.{0,256}\<HTA\:APPLICATION)~Ss'),
        ]),
        new MagicRule('application/microsoftpatch', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1).{592}.{0,7600}\x86\x10\f\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/msword', 60, 8209, [
            new MagicRegex('~(?n)\A((?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}\x00\t\x02\x00\x00\x00\x00\x00\x00\xC0F\x00\x00\x00\x00\x00|.{592}.{0,7600}\x06\t\x02\x00\x00\x00\x00\x00\x00\xC0F\x00\x00\x00\x00\x00)|(*FAIL))|1\xBE\x00\x00|PO\^Q`|\xFE7\x00\#|\xDB\xA5\-\x00\x00\x00|.{2112}MSWordDoc|.{2108}MSWordDoc|.{2112}Microsoft Word document data|.{546}bjbj|.{546}jbjb)~Ss'),
        ]),
        new MagicRule('application/vnd.ms-cab-compressed', 60, 9, [
            new MagicMatch(0, 1, "MSCF\x00\x00\x00\x00", '', 0),
        ]),
        new MagicRule('application/vnd.ms-excel', 60, 8209, [
            new MagicRegex('~(?n)\A((?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}\x10\x08\x02\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F|.{592}.{0,7600} \x08\x02\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F)|(*FAIL))|.{2080}Microsoft Excel 5\.0 Worksheet)~Ss'),
        ]),
        new MagicRule('application/vnd.ms-powerpoint', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}\x10\x8D\x81d\x9BO\xCF\x11\x86\xEA\x00\xAA\x00\xB9\)\xE8|.{592}.{0,7600}p\xAE\{\xEA;\xFB\xCD\x11\xA9\x03\x00\xAA\x00Q\x0E\xA3)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.ms-publisher', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1).{592}.{0,7600}\x01\x12\x02\x00\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00F|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.ms-works', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}\x02\x13\x02\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F|.{592}.{0,7600}\x03\x13\x02\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F|.{592}.{0,7600}\xB2Z\xA4\x0E\n\x9E\xD1\x11\xA4\x07\x00\xC0O\xB92\xBA|.{592}.{0,7600}\xC0\xC7&n\xB9\x8C\xD3\x11\xA1\xC8\x00\xC0Oa\$R|.{592}.{0,7600}\xC2\xDB\xCD\(\xE2\n\xCE\x11\xA2\x9A\x00\xAA\x00J\x1Ar|.{592}.{0,7600}\xC3\xDB\xCD\(\xE2\n\xCE\x11\xA2\x9A\x00\xAA\x00J\x1Ar)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.ms-wpl', 60, 262, [
            new MagicRegex('~(?n)\A.{0,256}\<\?wpl~Ss'),
        ]),
        new MagicRule('application/vnd.rar', 60, 5, [
            new MagicMatch(0, 1, 'Rar!', '', 0),
        ]),
        new MagicRule('application/vnd.stardivision.calc', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}A\xD4ac5B\xD0\x11\x89\xCB\x00\x80\)\xE4\xB0\xB1|.{592}.{0,7600}a\xB8\xA5\xC6\xD6\x85\xD1\x11\x89\xCB\x00\x80\)\xE4\xB0\xB1|.{592}.{0,7600}\xA0\?T\?\xA6\xB6\x1B\x10\x99a\x04\x02\x1C\x00p\x02)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.stardivision.chart', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}\!C\x88\xBF\xDD\x85\xD1\x11\x89\xD0\x00\x80\)\xE4\xB0\xB1|.{592}.{0,7600}\xE0\x99\x9C\xFBm,\x1C\x10\x8E,\x00\x00\x1BL\xC7\x11|.{592}.{0,7600}\xE0\xB7\xB3\x02%B\xD0\x11\x89\xCA\x00\x80\)\xE4\xB0\xB1)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.stardivision.draw', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}\xA0\x05\x89\.\xBD\x85\xD1\x11\x89\xD0\x00\x80\)\xE4\xB0\xB1|.{592}.{0,7600}\xE0\xAA\x10\xAFm\xB3\x1B\x10\x99a\x04\x02\x1C\x00p\x02)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.stardivision.math', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}@\xE6\xB5\xFF\xDE\x85\xD1\x11\x89\xD0\x00\x80\)\xE4\xB0\xB1|.{592}.{0,7600}`\x04Y\xD4\xFD5\x1C\x10\xB1\*\x04\x02\x1C\x00p\x02|.{592}.{0,7600}\xE1\xB7\xB3\x02%B\xD0\x11\x89\xCA\x00\x80\)\xE4\xB0\xB1)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.visio', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1)(.{592}.{0,7600}\x13\x1A\x02\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F|.{592}.{0,7600}\x14\x1A\x02\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.wordperfect', 60, 8209, [
            new MagicRegex('~(?n)\A(.{1}WPC|(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1).{592}.{0,7600}\xFFs\x98Q\xAD\- \x02\x197\x00\x00\x92\x96y\xCD|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-7z-compressed', 60, 7, [
            new MagicMatch(0, 1, "7z\xBC\xAF'\x1C", '', 0),
        ]),
        new MagicRule('application/x-ace', 60, 15, [
            new MagicMatch(7, 1, '**ACE**', '', 0),
        ]),
        new MagicRule('application/x-arc', 60, 5, [
            new MagicRegex('~(?n)\A(\x1A\x08[\x00-\x7F][\x00-\x7F]|\x1A\t[\x00-\x7F][\x00-\x7F]|\x1A\x02[\x00-\x7F][\x00-\x7F]|\x1A\x03[\x00-\x7F][\x00-\x7F]|\x1A\x04[\x00-\x7F][\x00-\x7F]|\x1A\x06[\x00-\x7F][\x00-\x7F])~Ss'),
        ]),
        new MagicRule('application/x-cpio', 60, 7, [
            new MagicMatch(0, 1, "q\xC7", '', $swap|2),
            new MagicRegex('~(?n)\A(070701|070702)~Ss'),
            new MagicMatch(0, 1, "\xC7q", '', $swap|2),
        ]),
        new MagicRule('application/x-dosexec', 60, 27, [
            new MagicRegex('~(?n)\A(?(?=MZ).{24}[\x00-\x3F]\x00|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-font-type1', 60, 70, [
            new MagicRegex('~(?n)\A(LWFN|.{65}LWFN|%\!PS\-AdobeFont\-1\.|.{6}%\!PS\-AdobeFont\-1\.|%\!FontType1\-1\.|.{6}%\!FontType1\-1\.)~Ss'),
        ]),
        new MagicRule('application/x-java-pack200', 60, 5, [
            new MagicMatch(0, 1, "\xCA\xFE\xD0\r", '', 0),
        ]),
        new MagicRule('application/x-karbon', 60, 59, [
            new MagicRegex('~(?n)\A((?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-karbon\x04\x06|(*FAIL))|(*FAIL))|(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/x\-karbon|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-kchart', 60, 59, [
            new MagicRegex('~(?n)\A((?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-kchart\x04\x06|(*FAIL))|(*FAIL))|(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/x\-kchart|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-kformula', 60, 61, [
            new MagicRegex('~(?n)\A((?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-kformula\x04\x06|(*FAIL))|(*FAIL))|(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/x\-kformula|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-killustrator', 60, 47, [
            new MagicRegex('~(?n)\A(?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-killustrator\x04\x06|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-kivio', 60, 58, [
            new MagicRegex('~(?n)\A((?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-kivio\x04\x06|(*FAIL))|(*FAIL))|(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/x\-kivio|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-kontour', 60, 60, [
            new MagicRegex('~(?n)\A((?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-kontour\x04\x06|(*FAIL))|(*FAIL))|(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/x\-kontour|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-kpresenter', 60, 63, [
            new MagicRegex('~(?n)\A((?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-kpresenter\x04\x06|(*FAIL))|(*FAIL))|(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/x\-kpresenter|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-krita', 60, 83, [
            new MagicRegex('~(?n)\A((?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-krita\x04\x06|(*FAIL))|(*FAIL))|(?(?=PK\x03\x04)(?(?=.{30}mimetype)(.{38}application/x\-krita|.{42}application/x\-krita|.{63}application/x\-krita)|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-kspread', 60, 60, [
            new MagicRegex('~(?n)\A((?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-kspread\x04\x06|(*FAIL))|(*FAIL))|(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/x\-kspread|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-kword', 60, 58, [
            new MagicRegex('~(?n)\A((?(?=\x1F\x8B)(?(?=.{10}KOffice).{18}application/x\-kword\x04\x06|(*FAIL))|(*FAIL))|(?(?=PK\x03\x04)(?(?=.{30}mimetype).{38}application/x\-kword|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-lha', 60, 9, [
            new MagicRegex('~(?n)\A(.{2}\-lh \-|.{2}\-lh0\-|.{2}\-lh1\-|.{2}\-lh2\-|.{2}\-lh3\-|.{2}\-lh4\-|.{2}\-lh5\-|.{2}\-lh40\-|.{2}\-lhd\-|.{2}\-lz4\-|.{2}\-lz5\-|.{2}\-lzs\-)~Ss'),
        ]),
        new MagicRule('application/x-lrzip', 60, 5, [
            new MagicMatch(0, 1, 'LRZI', '', 0),
        ]),
        new MagicRule('application/x-lz4', 60, 5, [
            new MagicRegex('~(?n)\A(\x04"M\x18|\x02\!L\x18)~Ss'),
        ]),
        new MagicRule('application/x-lzip', 60, 5, [
            new MagicMatch(0, 1, 'LZIP', '', 0),
        ]),
        new MagicRule('application/x-lzop', 60, 10, [
            new MagicMatch(0, 1, "\x89LZO\x00\r\n\x1A\n", '', 0),
        ]),
        new MagicRule('application/x-msi', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1).{592}.{0,7600}\x84\x10\f\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-par2', 60, 5, [
            new MagicMatch(0, 1, 'PAR2', '', 0),
        ]),
        new MagicRule('application/x-qpress', 60, 9, [
            new MagicMatch(0, 1, 'qpress10', '', 0),
        ]),
        new MagicRule('application/x-quattropro', 60, 8209, [
            new MagicRegex('~(?n)\A(?(?=\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1).{592}.{0,7600}\x00\xB4\x02\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-quicktime-media-link', 60, 76, [
            new MagicRegex('~(?n)\A((?(?=\<\?xml).{0,64}\<\?quicktime|(*FAIL))|RTSPtext|rtsptext|SMILtext)~Ss'),
        ]),
        new MagicRule('application/x-sega-cd-rom', 60, 277, [
            new MagicRegex('~(?n)\A((?(?=SEGADISCSYSTEM).{256}SEGA|(*FAIL))|(?(?=.{16}SEGADISCSYSTEM).{272}SEGA|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-stuffit', 60, 9, [
            new MagicRegex('~(?n)\A(StuffIt |SIT\!)~Ss'),
        ]),
        new MagicRule('application/x-stuffitx', 60, 9, [
            new MagicMatch(0, 1, 'StuffIt!', '', 0),
        ]),
        new MagicRule('application/x-tar', 60, 266, [
            new MagicRegex('~(?n)\A(.{257}ustar\x00|.{257}ustar  \x00)~Ss'),
        ]),
        new MagicRule('application/x-xar', 60, 5, [
            new MagicMatch(0, 1, 'xar!', '', 0),
        ]),
        new MagicRule('application/x-xz', 60, 7, [
            new MagicMatch(0, 1, "\xFD7zXZ\x00", '', 0),
        ]),
        new MagicRule('application/x-zoo', 60, 25, [
            new MagicMatch(20, 1, "\xDC\xA7\xC4\xFD", '', 0),
        ]),
        new MagicRule('application/xhtml+xml', 60, 306, [
            new MagicRegex('~(?n)\A(.{0,256}//W3C//DTD XHTML |.{0,256}http\://www\.w3\.org/TR/xhtml1/DTD/xhtml1\-strict\.dtd|.{0,256}\<html xmlns\="http\://www\.w3\.org/1999/xhtml|.{0,256}\<HTML xmlns\="http\://www\.w3\.org/1999/xhtml)~Ss'),
        ]),
        new MagicRule('application/zip', 60, 5, [
            new MagicMatch(0, 1, "PK\x03\x04", '', 0),
        ]),
        new MagicRule('application/zstd', 60, 5, [
            new MagicMatch(0, 1, "(\xB5/\xFD", '', 0),
        ]),
        new MagicRule('audio/vnd.dts.hd', 60, 18730, [
            new MagicRegex('~(?n)\A(?(?=\x7F\xFE\x80\x01).{4}.{0,18721}dX %|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/apng', 60, 42, [
            new MagicRegex('~(?n)\A(?(?=\x89PNG\r\n\x1A\n).{37}acTL|(*FAIL))~Ss'),
        ]),
        new MagicRule('text/x-python3', 60, 34, [
            new MagicRegex('~(?n)\A(\#\!/bin/python3|\#\! /bin/python3|eval "exec /bin/python3|\#\!/usr/bin/python3|\#\! /usr/bin/python3|eval "exec /usr/bin/python3|\#\!/usr/local/bin/python3|\#\! /usr/local/bin/python3|eval "exec /usr/local/bin/python3|.{2}.{0,14}/bin/env python3)~Ss'),
        ]),
        new MagicRule('text/x-txt2tags', 60, 11, [
            new MagicRegex('~(?n)\A(%\!postproc|%\!encoding)~Ss'),
        ]),
        new MagicRule('application/smil+xml', 55, 262, [
            new MagicRegex('~(?n)\A.{0,256}\<smil~Ss'),
        ]),
        new MagicRule('audio/x-ms-asx', 51, 69, [
            new MagicRegex('~(?n)\A(ASF |.{0,64}\<ASX|.{0,64}\<asx|.{0,64}\<Asx)~Ss'),
        ]),
        new MagicRule('application/annodex', 50, 521, [
            new MagicRegex('~(?n)\A(?(?=OggS)(?(?=.{28}fishead\x00).{56}.{0,456}CMML\x00\x00\x00\x00|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/appinstaller', 50, 270, [
            new MagicRegex('~(?n)\A.{0,256}\<AppInstaller~Ss'),
        ]),
        new MagicRule('application/dicom', 50, 133, [
            new MagicMatch(128, 1, 'DICM', '', 0),
        ]),
        new MagicRule('application/fits', 50, 10, [
            new MagicMatch(0, 1, 'SIMPLE  =', '', 0),
        ]),
        new MagicRule('application/font-tdpfr', 50, 5, [
            new MagicRegex('~(?n)\A(PFR0|PFR1)~Ss'),
        ]),
        new MagicRule('application/gnunet-directory', 50, 9, [
            new MagicMatch(0, 1, "\x89GND\r\n\x1A\n", '', 0),
        ]),
        new MagicRule('application/gzip', 50, 3, [
            new MagicMatch(0, 1, "\x1F\x8B", '', 0),
        ]),
        new MagicRule('application/its+xml', 50, 261, [
            new MagicRegex('~(?n)\A.{0,256}\<its~Ss'),
        ]),
        new MagicRule('application/mac-binhex40', 50, 54, [
            new MagicRegex('~(?n)\A(\(This file must be converted with BinHex 4\.0\)|\(This file must be converted; you knew that already\.\))~Ss'),
        ]),
        new MagicRule('application/mathematica', 50, 322, [
            new MagicRegex('~(?n)\A(\(\*\*\*\*\*\*\*\*\*\*\*\*\*\* Content\-type\: application/mathematica|.{100}.{0,156}This notebook can be used on any computer system with Mathematica|.{10}.{0,246}This is a Mathematica Notebook file\.  It contains ASCII text)~Ss'),
        ]),
        new MagicRule('application/metalink+xml', 50, 280, [
            new MagicRegex('~(?n)\A.{0,256}\<metalink version\="3\.0"~Ss'),
        ]),
        new MagicRule('application/metalink4+xml', 50, 277, [
            new MagicRegex('~(?n)\A.{0,256}\<metalink xmlns\="urn~Ss'),
        ]),
        new MagicRule('application/mxf', 50, 271, [
            new MagicRegex('~(?n)\A.{0,256}\x06\x0E\+4\x02\x05\x01\x01\r\x01\x02\x01\x01\x02~Ss'),
        ]),
        new MagicRule('application/ogg', 50, 5, [
            new MagicMatch(0, 1, 'OggS', '', 0),
        ]),
        new MagicRule('application/owl+xml', 50, 266, [
            new MagicRegex('~(?n)\A.{0,256}\<Ontology~Ss'),
        ]),
        new MagicRule('application/pdf', 50, 1030, [
            new MagicRegex('~(?n)\A.{0,1024}%PDF\-~Ss'),
        ]),
        new MagicRule('application/pgp-encrypted', 50, 28, [
            new MagicMatch(0, 1, '-----BEGIN PGP MESSAGE-----', '', 0),
        ]),
        new MagicRule('application/pgp-keys', 50, 38, [
            new MagicRegex('~(?n)\A(\-\-\-\-\-BEGIN PGP PUBLIC KEY BLOCK\-\-\-\-\-|\-\-\-\-\-BEGIN PGP PRIVATE KEY BLOCK\-\-\-\-\-|\x95\x01|\x95\x00|\x99\x00|\x99\x01)~Ss'),
        ]),
        new MagicRule('application/pgp-signature', 50, 30, [
            new MagicMatch(0, 1, '-----BEGIN PGP SIGNATURE-----', '', 0),
        ]),
        new MagicRule('application/pkix-cert', 50, 33, [
            new MagicRegex('~(?n)\A(\-\-\-\-\-BEGIN CERTIFICATE\-\-\-\-\-|\-\-\-\-\-BEGIN X509 CERTIFICATE\-\-\-\-\-)~Ss'),
        ]),
        new MagicRule('application/pkix-crl', 50, 25, [
            new MagicMatch(0, 1, '-----BEGIN X509 CRL-----', '', 0),
        ]),
        new MagicRule('application/postscript', 50, 4, [
            new MagicRegex('~(?n)\A(\x04%\!|%\!)~Ss'),
        ]),
        new MagicRule('application/raml+yaml', 50, 8, [
            new MagicMatch(0, 1, '#%RAML ', '', 0),
        ]),
        new MagicRule('application/rtf', 50, 6, [
            new MagicMatch(0, 1, '{\\rtf', '', 0),
        ]),
        new MagicRule('application/sdp', 50, 259, [
            new MagicRegex('~(?n)\A(?(?=v\=).{0,256}s\=|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.adobe.flash.movie', 50, 4, [
            new MagicRegex('~(?n)\A(FWS|CWS)~Ss'),
        ]),
        new MagicRule('application/vnd.appimage', 50, 12, [
            new MagicRegex('~(?n)\A(?(?=.{1}ELF)(?(?=.{8}A)(?(?=.{9}I).{10}\x02|(*FAIL))|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.chess-pgn', 50, 8, [
            new MagicMatch(0, 1, '[Event ', '', 0),
        ]),
        new MagicRule('application/vnd.cups-ppd', 50, 12, [
            new MagicMatch(0, 1, '*PPD-Adobe:', '', 0),
        ]),
        new MagicRule('application/vnd.debian.binary-package', 50, 15, [
            new MagicRegex('~(?n)\A(?(?=\!\<arch\>).{8}debian|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/vnd.efi.img', 50, 4105, [
            new MagicRegex('~(?n)\A(.{512}EFI PART|.{1024}EFI PART|.{2048}EFI PART|.{4096}EFI PART)~Ss'),
        ]),
        new MagicRule('application/vnd.emusic-emusic_package', 50, 8, [
            new MagicMatch(0, 1, 'nF7YLao', '', 0),
        ]),
        new MagicRule('application/vnd.flatpak', 50, 13, [
            new MagicRegex('~(?n)\A(xdg\-app\x00\x01\x00\x89\xE5|flatpak\x00\x01\x00\x89\xE5)~Ss'),
        ]),
        new MagicRule('application/vnd.flatpak.ref', 50, 270, [
            new MagicRegex('~(?n)\A.{0,256}\[Flatpak Ref\]~Ss'),
        ]),
        new MagicRule('application/vnd.flatpak.repo', 50, 271, [
            new MagicRegex('~(?n)\A.{0,256}\[Flatpak Repo\]~Ss'),
        ]),
        new MagicRule('application/vnd.framemaker', 50, 17, [
            new MagicRegex('~(?n)\A(\<MakerFile|\<MIFFile|\<MakerDictionary|\<MakerScreenFon|\<MML|\<Book|\<Maker)~Ss'),
        ]),
        new MagicRule('application/vnd.gerber', 50, 6, [
            new MagicRegex('~(?n)\A(G04 |%FSLA|%MO|%TF\.|G75\*)~Ss'),
        ]),
        new MagicRule('application/vnd.iccprofile', 50, 41, [
            new MagicMatch(36, 1, 'acsp', '', 0),
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
            new MagicRegex('~(?n)\A(0&\xB2u|\[Reference\])~Ss'),
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
            new MagicRegex('~(?n)\A(sqsh|hsqs)~Ss'),
        ]),
        new MagicRule('application/vnd.symbian.install', 50, 13, [
            new MagicMatch(8, 1, "\x19\x04\x00\x10", '', 0),
        ]),
        new MagicRule('application/vnd.tcpdump.pcap', 50, 5, [
            new MagicMatch(0, 1, "\xA1\xB2\xC3\xD4", '', $swap|4),
            new MagicMatch(0, 1, "\xD4\xC3\xB2\xA1", '', $swap|4),
        ]),
        new MagicRule('application/wasm', 50, 5, [
            new MagicMatch(0, 1, "\x00asm", '', 0),
        ]),
        new MagicRule('application/winhlp', 50, 5, [
            new MagicMatch(0, 1, "?_\x03\x00", '', 0),
        ]),
        new MagicRule('application/x-abiword', 50, 274, [
            new MagicRegex('~(?n)\A(.{0,256}\<abiword|.{0,256}\<\!DOCTYPE abiword)~Ss'),
        ]),
        new MagicRule('application/x-alz', 50, 4, [
            new MagicMatch(0, 1, 'ALZ', '', 0),
        ]),
        new MagicRule('application/x-amiga-disk-format', 50, 5, [
            new MagicMatch(0, 1, "DOS\x00", '', 0),
        ]),
        new MagicRule('application/x-aportisdoc', 50, 69, [
            new MagicRegex('~(?n)\A(.{60}TEXtREAd|.{60}TEXtTlDc)~Ss'),
        ]),
        new MagicRule('application/x-apple-systemprofiler+xml', 50, 419, [
            new MagicRegex('~(?n)\A(?(?=.{0,256}\<plist version\="1\.0").{34}.{0,350}\<key\>_SPCommandLineArguments\</key\>|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-applix-spreadsheet', 50, 20, [
            new MagicRegex('~(?n)\A(\*BEGIN SPREADSHEETS|(?(?=\*BEGIN).{7}SPREADSHEETS|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-applix-word', 50, 13, [
            new MagicRegex('~(?n)\A(?(?=\*BEGIN).{7}WORDS|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-arj', 50, 3, [
            new MagicMatch(0, 1, "`\xEA", '', 0),
        ]),
        new MagicRule('application/x-asar', 50, 26, [
            new MagicRegex('~(?n)\A(?(?=\x04\x00\x00\x00).{16}\{"files"\:|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-atari-7800-rom', 50, 11, [
            new MagicMatch(1, 1, 'ATARI7800', '', 0),
        ]),
        new MagicRule('application/x-atari-lynx-rom', 50, 5, [
            new MagicMatch(0, 1, 'LYNX', '', 0),
        ]),
        new MagicRule('application/x-awk', 50, 23, [
            new MagicRegex('~(?n)\A(\#\!/bin/gawk|\#\! /bin/gawk|\#\!/usr/bin/gawk|\#\! /usr/bin/gawk|\#\!/usr/local/bin/gawk|\#\! /usr/local/bin/gawk|\#\!/bin/awk|\#\! /bin/awk|\#\!/usr/bin/awk|\#\! /usr/bin/awk)~Ss'),
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
            new MagicRegex('~(?n)\A(BSDIFF40|BSDIFN40)~Ss'),
        ]),
        new MagicRule('application/x-bzip1', 50, 4, [
            new MagicMatch(0, 1, 'BZ0', '', 0),
        ]),
        new MagicRule('application/x-bzip2', 50, 4, [
            new MagicMatch(0, 1, 'BZh', '', 0),
        ]),
        new MagicRule('application/x-bzip3', 50, 6, [
            new MagicMatch(0, 1, 'BZ3v1', '', 0),
        ]),
        new MagicRule('application/x-ccmx', 50, 5, [
            new MagicMatch(0, 1, 'CCMX', '', 0),
        ]),
        new MagicRule('application/x-cdrdao-toc', 50, 24, [
            new MagicRegex('~(?n)\A(CD_ROM\n|CD_DA\n|CD_ROM_XA\n|CD_TEXT |(?(?=CATALOG ").{22}"|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-cisco-vpn-settings', 50, 266, [
            new MagicRegex('~(?n)\A(?(?=\[main\]).{0,256}AuthType\=|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-compress', 50, 3, [
            new MagicMatch(0, 1, "\x1F\x9D", '', 0),
        ]),
        new MagicRule('application/x-compressed-iso', 50, 5, [
            new MagicMatch(0, 1, 'CISO', '', 0),
        ]),
        new MagicRule('application/x-core', 50, 19, [
            new MagicRegex('~(?n)\A(\x7FELF............\x04|(?(?=\x7FELF)(?(?=.{5}\x01).{16}\x04\x00|(*FAIL))|(*FAIL))|(?(?=\x7FELF)(?(?=.{5}\x02).{16}\x00\x04|(*FAIL))|(*FAIL))|Core\x01|Core\x02)~Ss'),
        ]),
        new MagicRule('application/x-csh', 50, 30, [
            new MagicRegex('~(?n)\A(.{2}.{0,14}/bin/tcsh|.{2}.{0,14}/bin/csh|.{2}.{0,14}/bin/env csh|.{2}.{0,14}/bin/env tcsh)~Ss'),
        ]),
        new MagicRule('application/x-dar', 50, 5, [
            new MagicMatch(0, 1, "\x00\x00\x00{", '', 0),
        ]),
        new MagicRule('application/x-designer', 50, 261, [
            new MagicRegex('~(?n)\A(.{0,256}\<ui |.{0,256}\<UI )~Ss'),
        ]),
        new MagicRule('application/x-desktop', 50, 48, [
            new MagicRegex('~(?n)\A(.{0,32}\[Desktop Entry\]|\[Desktop Action|\[KDE Desktop Entry\]|\# Config File|\# KDE Config File)~Ss'),
        ]),
        new MagicRule('application/x-dia-diagram', 50, 106, [
            new MagicRegex('~(?n)\A.{5}.{0,95}\<dia\:~Ss'),
        ]),
        new MagicRule('application/x-dia-shape', 50, 107, [
            new MagicRegex('~(?n)\A.{5}.{0,95}\<shape~Ss'),
        ]),
        new MagicRule('application/x-doom-wad', 50, 5, [
            new MagicRegex('~(?n)\A(IWAD|PWAD)~Ss'),
        ]),
        new MagicRule('application/x-dreamcast-rom', 50, 32, [
            new MagicMatch(16, 1, 'SEGA SEGAKATANA', '', 0),
        ]),
        new MagicRule('application/x-dvi', 50, 3, [
            new MagicMatch(0, 1, "\xF7\x02", '', 0),
        ]),
        new MagicRule('application/x-excellon', 50, 5, [
            new MagicMatch(0, 1, "M48\n", '', 0),
        ]),
        new MagicRule('application/x-fds-disk', 50, 16, [
            new MagicMatch(1, 1, '*NINTENDO-HVC*', '', 0),
        ]),
        new MagicRule('application/x-fishscript', 50, 30, [
            new MagicRegex('~(?n)\A.{2}.{0,14}/bin/env fish~Ss'),
        ]),
        new MagicRule('application/x-fluid', 50, 25, [
            new MagicMatch(0, 1, '# data file for the Fltk', '', 0),
        ]),
        new MagicRule('application/x-font-bdf', 50, 11, [
            new MagicMatch(0, 1, 'STARTFONT ', '', 0),
        ]),
        new MagicRule('application/x-font-dos', 50, 12, [
            new MagicRegex('~(?n)\A(\xFFFON|.{7}\x00EGA|.{7}\x00VID)~Ss'),
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
            new MagicRegex('~(?n)\A(StartFont|\x13z\)|.{8}\x13z\+)~Ss'),
        ]),
        new MagicRule('application/x-font-tex', 50, 3, [
            new MagicRegex('~(?n)\A(\xF7\x83|\xF7Y|\xF7\xCA)~Ss'),
        ]),
        new MagicRule('application/x-font-tex-tfm', 50, 5, [
            new MagicRegex('~(?n)\A(.{2}\x00\x11|.{2}\x00\x12)~Ss'),
        ]),
        new MagicRule('application/x-font-ttx', 50, 310, [
            new MagicRegex('~(?n)\A.{0,256}\<ttFont sfntVersion\="\\\\x00\\\\x01\\\\x00\\\\x00" ttLibVersion\="~Ss'),
        ]),
        new MagicRule('application/x-font-vfont', 50, 5, [
            new MagicMatch(0, 1, 'FONT', '', 0),
        ]),
        new MagicRule('application/x-gameboy-color-rom', 50, 325, [
            new MagicRegex('~(?n)\A(?(?=.{260}\xCE\xEDff\xCC\r\x00\v\x03s\x00\x83\x00\f\x00\r\x00\x08).{323}[\x80-\xFF]|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-gameboy-rom', 50, 325, [
            new MagicRegex('~(?n)\A(?(?=.{260}\xCE\xEDff\xCC\r\x00\v\x03s\x00\x83\x00\f\x00\r\x00\x08\x11\x1F\x88\x89\x00\x0E).{323}[\x00-\x7F]|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-gamecube-rom', 50, 33, [
            new MagicMatch(28, 1, "\xC23\x9F=", '', 0),
        ]),
        new MagicRule('application/x-gdbm', 50, 5, [
            new MagicRegex('~(?n)\A(\x13W\x9A\xCE|\xCE\x9AW\x13|GDBM)~Ss'),
        ]),
        new MagicRule('application/x-genesis-32x-rom', 50, 265, [
            new MagicMatch(256, 1, 'SEGA 32X', '', 0),
        ]),
        new MagicRule('application/x-genesis-rom', 50, 645, [
            new MagicRegex('~(?n)\A(.{256}SEGA GENESIS|.{256}SEGA MEGA DRIVE|.{256}SEGA_MEGA_DRIVE|.{640}EAGN|.{640}EAMG)~Ss'),
        ]),
        new MagicRule('application/x-gettext-translation', 50, 5, [
            new MagicRegex('~(?n)\A(\xDE\x12\x04\x95|\x95\x04\x12\xDE)~Ss'),
        ]),
        new MagicRule('application/x-glade', 50, 273, [
            new MagicRegex('~(?n)\A.{0,256}\<glade\-interface~Ss'),
        ]),
        new MagicRule('application/x-gnumeric', 50, 77, [
            new MagicRegex('~(?n)\A(.{0,64}gmr\:Workbook|.{0,64}gnm\:Workbook)~Ss'),
        ]),
        new MagicRule('application/x-go-sgf', 50, 8, [
            new MagicRegex('~(?n)\A(\(;FF\[3\]|\(;FF\[4\])~Ss'),
        ]),
        new MagicRule('application/x-godot-resource', 50, 14, [
            new MagicMatch(0, 1, '[gd_resource ', '', 0),
        ]),
        new MagicRule('application/x-godot-scene', 50, 11, [
            new MagicMatch(0, 1, '[gd_scene ', '', 0),
        ]),
        new MagicRule('application/x-gtk-builder', 50, 267, [
            new MagicRegex('~(?n)\A.{0,256}\<interface~Ss'),
        ]),
        new MagicRule('application/x-gtktalog', 50, 14, [
            new MagicMatch(4, 1, 'gtktalog ', '', 0),
        ]),
        new MagicRule('application/x-hdf', 50, 9, [
            new MagicRegex('~(?n)\A(\x89HDF\r\n\x1A\n|\x0E\x03\x13\x01)~Ss'),
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
        new MagicRule('application/x-ipynb+json', 50, 265, [
            new MagicRegex('~(?n)\A(?(?=\{).{1}.{0,255}"cells"\:|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-iso9660-appimage', 50, 12, [
            new MagicRegex('~(?n)\A(?(?=.{1}ELF)(?(?=.{8}A)(?(?=.{9}I).{10}\x01|(*FAIL))|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-it87', 50, 6, [
            new MagicMatch(0, 1, 'IT8.7', '', 0),
        ]),
        new MagicRule('application/x-java', 50, 5, [
            new MagicMatch(0, 1, "\xCA\xFE\xBA\xBE", '', 0),
        ]),
        new MagicRule('application/x-java-jce-keystore', 50, 5, [
            new MagicMatch(0, 1, "\xCE\xCE\xCE\xCE", '', $swap|4),
        ]),
        new MagicRule('application/x-java-jnlp-file', 50, 262, [
            new MagicRegex('~(?n)\A.{0,256}\<jnlp~Ss'),
        ]),
        new MagicRule('application/x-java-keystore', 50, 5, [
            new MagicMatch(0, 1, "\xFE\xED\xFE\xED", '', 0),
        ]),
        new MagicRule('application/x-kspread-crypt', 50, 5, [
            new MagicMatch(0, 1, "\r\x1A'\x02", '', 0),
        ]),
        new MagicRule('application/x-ksysv-package', 50, 17, [
            new MagicRegex('~(?n)\A(?(?=.{4}KSysV).{15}\x01|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-kword-crypt', 50, 5, [
            new MagicMatch(0, 1, "\r\x1A'\x01", '', 0),
        ]),
        new MagicRule('application/x-lmdb', 50, 21, [
            new MagicMatch(16, 1, "\xDE\xC0\xEF\xBE", '', 0),
        ]),
        new MagicRule('application/x-lyx', 50, 5, [
            new MagicMatch(0, 1, '#LyX', '', 0),
        ]),
        new MagicRule('application/x-macbinary', 50, 107, [
            new MagicMatch(102, 1, 'mBIN', '', 0),
        ]),
        new MagicRule('application/x-mame-chd', 50, 9, [
            new MagicMatch(0, 1, 'MComprHD', '', 0),
        ]),
        new MagicRule('application/x-matroska', 50, 84, [
            new MagicRegex('~(?n)\A(?(?=\x1AE\xDF\xA3)(?(?=.{5}.{0,60}B\x82).{8}.{0,67}matroska|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-ms-pdb', 50, 43, [
            new MagicRegex('~(?n)\A(Microsoft C/C\+\+ MSF 7\.00\r\n\x1ADS|Microsoft C/C\+\+ program database 2\.00\r\n\x1AJG)~Ss'),
        ]),
        new MagicRule('application/x-ms-shortcut', 50, 21, [
            new MagicMatch(0, 1, "L\x00\x00\x00\x01\x14\x02\x00\x00\x00\x00\x00\xC0\x00\x00\x00\x00\x00\x00F", '', 0),
        ]),
        new MagicRule('application/x-ms-wim', 50, 9, [
            new MagicMatch(0, 1, "MSWIM\x00\x00\x00", '', 0),
        ]),
        new MagicRule('application/x-msdownload', 50, 3, [
            new MagicMatch(0, 1, 'MZ', '', 0),
        ]),
        new MagicRule('application/x-mswinurl', 50, 20, [
            new MagicRegex('~(?n)\A(.{1}InternetShortcut|(?(?=.{1}DEFAULT).{11}BASEURL\=|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-n64-rom', 50, 5, [
            new MagicRegex('~(?n)\A(\x807\x12@|7\x80@\x12|@\x127\x80)~Ss'),
        ]),
        new MagicRule('application/x-nautilus-link', 50, 63, [
            new MagicRegex('~(?n)\A.{0,32}\<nautilus_object nautilus_link~Ss'),
        ]),
        new MagicRule('application/x-navi-animation', 50, 13, [
            new MagicRegex('~(?n)\A(?(?=RIFF).{8}ACON|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-neo-geo-pocket-color-rom', 50, 37, [
            new MagicRegex('~(?n)\A(?(?=.{35}\x10)(COPYRIGHT BY SNK CORPORATION| LICENSED BY SNK CORPORATION)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-neo-geo-pocket-rom', 50, 37, [
            new MagicRegex('~(?n)\A(?(?=.{35}\x00)(COPYRIGHT BY SNK CORPORATION| LICENSED BY SNK CORPORATION)|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-netshow-channel', 50, 10, [
            new MagicMatch(0, 1, '[Address]', '', 0),
        ]),
        new MagicRule('application/x-nintendo-3ds-rom', 50, 261, [
            new MagicMatch(256, 1, 'NCSD', '', 0),
        ]),
        new MagicRule('application/x-nuscript', 50, 28, [
            new MagicRegex('~(?n)\A.{2}.{0,14}/bin/env nu~Ss'),
        ]),
        new MagicRule('application/x-object', 50, 19, [
            new MagicRegex('~(?n)\A((?(?=\x7FELF)(?(?=.{5}\x01).{16}\x01\x00|(*FAIL))|(*FAIL))|(?(?=\x7FELF)(?(?=.{5}\x02).{16}\x00\x01|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('application/x-ole-storage', 50, 9, [
            new MagicMatch(0, 1, "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1", '', 0),
        ]),
        new MagicRule('application/x-oleo', 50, 36, [
            new MagicMatch(31, 1, 'Oleo', '', 0),
        ]),
        new MagicRule('application/x-openzim', 50, 5, [
            new MagicMatch(0, 1, "ZIM\x04", '', 0),
        ]),
        new MagicRule('application/x-pef-executable', 50, 5, [
            new MagicMatch(0, 1, 'Joy!', '', 0),
        ]),
        new MagicRule('application/x-perf-data', 50, 9, [
            new MagicMatch(0, 1, 'PERFILE2', '', 0),
        ]),
        new MagicRule('application/x-perl', 50, 267, [
            new MagicRegex('~(?n)\A(eval "exec /usr/local/bin/perl|.{2}.{0,14}/bin/perl|.{2}.{0,14}/bin/env perl|.{0,256}use Test\:\:)~Ss'),
        ]),
        new MagicRule('application/x-pocket-word', 50, 6, [
            new MagicMatch(0, 1, '{\\pwi', '', 0),
        ]),
        new MagicRule('application/x-powershell', 50, 29, [
            new MagicRegex('~(?n)\A(\#Requires \-PSEdition Core|\#Requires \-PSEdition Desktop)~Ss'),
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
            new MagicRegex('~(?n)\A(?(?=QFI).{3}\xFB|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-qtiplot', 50, 8, [
            new MagicMatch(0, 1, 'QtiPlot', '', 0),
        ]),
        new MagicRule('application/x-rpm', 50, 5, [
            new MagicMatch(0, 1, "\xED\xAB\xEE\xDB", '', 0),
        ]),
        new MagicRule('application/x-ruby', 50, 30, [
            new MagicRegex('~(?n)\A(.{2}.{0,14}/bin/env ruby|.{2}.{0,14}/bin/ruby)~Ss'),
        ]),
        new MagicRule('application/x-rzip', 50, 5, [
            new MagicMatch(0, 1, 'RZIP', '', 0),
        ]),
        new MagicRule('application/x-sami', 50, 263, [
            new MagicRegex('~(?n)\A.{0,256}\<SAMI\>~Ss'),
        ]),
        new MagicRule('application/x-saturn-rom', 50, 32, [
            new MagicRegex('~(?n)\A(SEGA SEGASATURN|.{16}SEGA SEGASATURN)~Ss'),
        ]),
        new MagicRule('application/x-sc', 50, 50, [
            new MagicMatch(38, 1, 'Spreadsheet', '', 0),
        ]),
        new MagicRule('application/x-sega-pico-rom', 50, 266, [
            new MagicMatch(256, 1, 'SEGA PICO', '', 0),
        ]),
        new MagicRule('application/x-sharedlib', 50, 25, [
            new MagicRegex('~(?n)\A(?(?=\x83\x01).{22}.[\x20-\x2F\x60-o\xA0-\xAF\xE0-\xEF]|(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-shellscript', 50, 36, [
            new MagicRegex('~(?n)\A(.{10}\# This is a shell archive|.{2}.{0,14}/bin/bash|.{2}.{0,14}/bin/nawk|.{2}.{0,14}/bin/zsh|.{2}.{0,14}/bin/sh|.{2}.{0,14}/bin/ksh|.{2}.{0,14}/bin/dash|.{2}.{0,14}/bin/env sh|.{2}.{0,14}/bin/env bash|.{2}.{0,14}/bin/env zsh|.{2}.{0,14}/bin/env ksh)~Ss'),
        ]),
        new MagicRule('application/x-shorten', 50, 5, [
            new MagicMatch(0, 1, 'ajkg', '', 0),
        ]),
        new MagicRule('application/x-spss-por', 50, 61, [
            new MagicMatch(40, 1, 'ASCII SPSS PORT FILE', '', 0),
        ]),
        new MagicRule('application/x-spss-sav', 50, 5, [
            new MagicRegex('~(?n)\A(\$FL2|\$FL3)~Ss'),
        ]),
        new MagicRule('application/x-sqlite2', 50, 32, [
            new MagicMatch(0, 1, '** This file contains an SQLite', '', 0),
        ]),
        new MagicRule('application/x-subrip', 50, 262, [
            new MagicRegex('~(?n)\A(?(?=1).{0,256} \-\-\> |(*FAIL))~Ss'),
        ]),
        new MagicRule('application/x-t602', 50, 6, [
            new MagicRegex('~(?n)\A(@CT 0|@CT 1|@CT 2)~Ss'),
        ]),
        new MagicRule('application/x-tgif', 50, 6, [
            new MagicMatch(0, 1, '%TGIF', '', 0),
        ]),
        new MagicRule('application/x-thomson-sap-image', 50, 67, [
            new MagicMatch(1, 1, 'SYSTEME D\'ARCHIVAGE PUKALL S.A.P. (c) Alexandre PUKALL Avril 1998', '', 0),
        ]),
        new MagicRule('application/x-vdi-disk', 50, 41, [
            new MagicRegex('~(?n)\A(\<\<\< QEMU VM Virtual Disk Image \>\>\>\n|\<\<\< Oracle VM VirtualBox Disk Image \>\>\>\n|\<\<\< Sun VirtualBox Disk Image \>\>\>\n|\<\<\< Sun xVM VirtualBox Disk Image \>\>\>\n|\<\<\< innotek VirtualBox Disk Image \>\>\>|\<\<\< CloneVDI VirtualBox Disk Image \>\>\>\n)~Ss'),
        ]),
        new MagicRule('application/x-vhd-disk', 50, 9, [
            new MagicMatch(0, 1, 'conectix', '', 0),
        ]),
        new MagicRule('application/x-vhdx-disk', 50, 9, [
            new MagicMatch(0, 1, 'vhdxfile', '', 0),
        ]),
        new MagicRule('application/x-vmdk-disk', 50, 9, [
            new MagicRegex('~(?n)\A(KDMV\x01\x00\x00\x00|KDMV\x02\x00\x00\x00)~Ss'),
        ]),
        new MagicRule('application/x-wii-rom', 50, 29, [
            new MagicRegex('~(?n)\A(.{24}\]\x1C\x9E\xA3|WBFS|WII\x01DISC)~Ss'),
        ]),
        new MagicRule('application/x-wii-wad', 50, 9, [
            new MagicRegex('~(?n)\A(.{4}Is\x00\x00|.{4}ib\x00\x00|.{4}Bk\x00\x00)~Ss'),
        ]),
        new MagicRule('application/x-x509-ca-cert', 50, 36, [
            new MagicRegex('~(?n)\A(\-\-\-\-\-BEGIN CA CERTIFICATE\-\-\-\-\-|\-\-\-\-\-BEGIN TRUSTED CERTIFICATE\-\-\-\-\-)~Ss'),
        ]),
        new MagicRule('application/x-xbel', 50, 271, [
            new MagicRegex('~(?n)\A.{0,256}\<\!DOCTYPE xbel~Ss'),
        ]),
        new MagicRule('application/x-zpaq', 50, 5, [
            new MagicMatch(0, 1, '7kSt', '', 0),
        ]),
        new MagicRule('application/xslt+xml', 50, 272, [
            new MagicRegex('~(?n)\A.{0,256}\<xsl\:stylesheet~Ss'),
        ]),
        new MagicRule('application/xspf+xml', 50, 85, [
            new MagicRegex('~(?n)\A(.{0,64}\<playlist version\="1|.{0,64}\<playlist version\=\'1)~Ss'),
        ]),
        new MagicRule('application/yaml', 50, 6, [
            new MagicMatch(0, 1, '%YAML', '', 0),
        ]),
        new MagicRule('audio/AMR', 50, 13, [
            new MagicRegex('~(?n)\A(\#\!AMR\n|\#\!AMR_MC1\.0\n)~Ss'),
        ]),
        new MagicRule('audio/AMR-WB', 50, 16, [
            new MagicRegex('~(?n)\A(\#\!AMR\-WB\n|\#\!AMR\-WB_MC1\.0\n)~Ss'),
        ]),
        new MagicRule('audio/aac', 50, 5, [
            new MagicRegex('~(?n)\A(ADIF|\xFF[\xF0-\xF1\xF8-\xF9])~Ss'),
        ]),
        new MagicRule('audio/ac3', 50, 3, [
            new MagicMatch(0, 1, "\vw", '', 0),
        ]),
        new MagicRule('audio/annodex', 50, 521, [
            new MagicRegex('~(?n)\A(?(?=OggS)(?(?=.{28}fishead\x00).{56}.{0,456}CMML\x00\x00\x00\x00|(*FAIL))|(*FAIL))~Ss'),
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
            new MagicMatch(4, 1, 'ftypM4A', '', 0),
        ]),
        new MagicRule('audio/mpeg', 50, 4, [
            new MagicRegex('~(?n)\A(\xFF\xFA|\xFF\xFB|\xFF\xF3|\xFF\xF2|\xFF\xE3|\xFF\xE2|ID3)~Ss'),
        ]),
        new MagicRule('audio/ogg', 50, 5, [
            new MagicMatch(0, 1, 'OggS', '', 0),
        ]),
        new MagicRule('audio/prs.sid', 50, 5, [
            new MagicMatch(0, 1, 'PSID', '', 0),
        ]),
        new MagicRule('audio/vnd.audible.aax', 50, 13, [
            new MagicMatch(4, 1, 'ftypaax ', '', 0),
        ]),
        new MagicRule('audio/vnd.audible.aaxc', 50, 13, [
            new MagicMatch(4, 1, 'ftypaaxc', '', 0),
        ]),
        new MagicRule('audio/vnd.dts', 50, 5, [
            new MagicRegex('~(?n)\A(\x7F\xFE\x80\x01|\x80\x01\x7F\xFE|\x1F\xFF\xE8\x00|\xE8\x00\x1F\xFF)~Ss'),
        ]),
        new MagicRule('audio/vnd.wave', 50, 13, [
            new MagicRegex('~(?n)\A(.{8}WAVE|.{8}WAV )~Ss'),
        ]),
        new MagicRule('audio/x-adpcm', 50, 17, [
            new MagicRegex('~(?n)\A((?(?=\.snd).{12}\x00\x00\x00\x17|(*FAIL))|(?(?=\.sd\x00)(.{12}\x01\x00\x00\x00|.{12}\x02\x00\x00\x00|.{12}\x03\x00\x00\x00|.{12}\x04\x00\x00\x00|.{12}\x05\x00\x00\x00|.{12}\x06\x00\x00\x00|.{12}\x07\x00\x00\x00|.{12}\x17\x00\x00\x00)|(*FAIL)))~Ss'),
        ]),
        new MagicRule('audio/x-aifc', 50, 13, [
            new MagicMatch(8, 1, 'AIFC', '', 0),
        ]),
        new MagicRule('audio/x-aiff', 50, 13, [
            new MagicRegex('~(?n)\A(.{8}AIFF|.{8}8SVX)~Ss'),
        ]),
        new MagicRule('audio/x-ape', 50, 5, [
            new MagicMatch(0, 1, 'MAC ', '', 0),
        ]),
        new MagicRule('audio/x-dff', 50, 17, [
            new MagicRegex('~(?n)\A(?(?=FRM8).{12}DSD |(*FAIL))~Ss'),
        ]),
        new MagicRule('audio/x-dsf', 50, 85, [
            new MagicRegex('~(?n)\A(?(?=DSD )(?(?=.{28}fmt ).{80}data|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('audio/x-iriver-pla', 50, 19, [
            new MagicMatch(4, 1, 'iriver UMS PLA', '', 0),
        ]),
        new MagicRule('audio/x-it', 50, 5, [
            new MagicMatch(0, 1, 'IMPM', '', 0),
        ]),
        new MagicRule('audio/x-m4b', 50, 12, [
            new MagicMatch(4, 1, 'ftypM4B', '', 0),
        ]),
        new MagicRule('audio/x-mo3', 50, 4, [
            new MagicMatch(0, 1, 'MO3', '', 0),
        ]),
        new MagicRule('audio/x-mpegurl', 50, 8, [
            new MagicMatch(0, 1, '#EXTM3U', '', 0),
        ]),
        new MagicRule('audio/x-musepack', 50, 5, [
            new MagicRegex('~(?n)\A(MP\+|MPCK)~Ss'),
        ]),
        new MagicRule('audio/x-pn-audibleaudio', 50, 9, [
            new MagicMatch(4, 1, "W\x90u6", '', 0),
        ]),
        new MagicRule('audio/x-psf', 50, 4, [
            new MagicMatch(0, 1, 'PSF', '', 0),
        ]),
        new MagicRule('audio/x-s3m', 50, 49, [
            new MagicMatch(44, 1, 'SCRM', '', 0),
        ]),
        new MagicRule('audio/x-scpls', 50, 11, [
            new MagicRegex('~(?n)\A(\[playlist\]|\[Playlist\]|\[PLAYLIST\])~Ss'),
        ]),
        new MagicRule('audio/x-speex', 50, 6, [
            new MagicMatch(0, 1, 'Speex', '', 0),
        ]),
        new MagicRule('audio/x-stm', 50, 30, [
            new MagicRegex('~(?n)\A(.{20}\!Scream\!\x1A|.{20}\!SCREAM\!\x1A|.{20}BMOD2STM\x1A)~Ss'),
        ]),
        new MagicRule('audio/x-tak', 50, 5, [
            new MagicMatch(0, 1, 'tBaK', '', 0),
        ]),
        new MagicRule('audio/x-tta', 50, 5, [
            new MagicMatch(0, 1, 'TTA1', '', 0),
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
            new MagicRegex('~(?n)\A(FFIL|.{65}FFIL|\x00\x01\x00\x00\x00)~Ss'),
        ]),
        new MagicRule('font/woff', 50, 5, [
            new MagicMatch(0, 1, 'wOFF', '', 0),
        ]),
        new MagicRule('font/woff2', 50, 5, [
            new MagicMatch(0, 1, 'wOF2', '', 0),
        ]),
        new MagicRule('image/avif', 50, 29, [
            new MagicRegex('~(?n)\A(.{4}ftypavif|.{4}ftypavis|(?(?=.{4}ftypmif1)(.{16}avif|.{20}avif|.{24}avif)|(*FAIL)))~Ss'),
        ]),
        new MagicRule('image/bmp', 50, 16, [
            new MagicRegex('~(?n)\A(BM....\x00\x00|(?(?=BM)(.{14}\f|.{14}@|.{14}\()|(*FAIL)))~Ss'),
        ]),
        new MagicRule('image/dpx', 50, 5, [
            new MagicMatch(0, 1, 'SDPX', '', 0),
        ]),
        new MagicRule('image/emf', 50, 61, [
            new MagicRegex('~(?n)\A(?(?=\x01\x00\x00\x00)(?(?=.{40} EMF)(?(?=.{44}\x00\x00\x01\x00).{58}\x00\x00|(*FAIL))|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/gif', 50, 5, [
            new MagicMatch(0, 1, 'GIF8', '', 0),
        ]),
        new MagicRule('image/hej2k', 50, 13, [
            new MagicMatch(4, 1, 'ftypj2ki', '', 0),
        ]),
        new MagicRule('image/jp2', 50, 25, [
            new MagicRegex('~(?n)\A\x00\x00\x00\fjP  \r\n\x87\n........jp2 ~Ss'),
        ]),
        new MagicRule('image/jpeg', 50, 4, [
            new MagicRegex('~(?n)\A(\xFF\xD8\xFF|\xFF\xD8)~Ss'),
        ]),
        new MagicRule('image/jpm', 50, 25, [
            new MagicRegex('~(?n)\A\x00\x00\x00\fjP  \r\n\x87\n........jpm ~Ss'),
        ]),
        new MagicRule('image/jpx', 50, 25, [
            new MagicRegex('~(?n)\A\x00\x00\x00\fjP  \r\n\x87\n........jpx ~Ss'),
        ]),
        new MagicRule('image/jxl', 50, 13, [
            new MagicRegex('~(?n)\A(\xFF\n|\x00\x00\x00\fJXL \r\n\x87\n)~Ss'),
        ]),
        new MagicRule('image/jxr', 50, 5, [
            new MagicMatch(0, 1, "II\xBC\x01", '', 0),
        ]),
        new MagicRule('image/png', 50, 9, [
            new MagicMatch(0, 1, "\x89PNG\r\n\x1A\n", '', 0),
        ]),
        new MagicRule('image/qoi', 50, 5, [
            new MagicMatch(0, 1, 'qoif', '', 0),
        ]),
        new MagicRule('image/tiff', 50, 5, [
            new MagicRegex('~(?n)\A(MM\x00\*|II\*\x00)~Ss'),
        ]),
        new MagicRule('image/vnd.adobe.photoshop', 50, 11, [
            new MagicRegex('~(?n)\A8BPS..\x00\x00\x00\x00~Ss'),
        ]),
        new MagicRule('image/vnd.dxf', 50, 75, [
            new MagicRegex('~(?n)\A(.{0,64}\nHEADER\n|.{0,64}\r\nHEADER\r\n)~Ss'),
        ]),
        new MagicRule('image/vnd.microsoft.icon', 50, 7, [
            new MagicRegex('~(?n)\A(?(?=\x00\x00\x01\x00).{5}\x00|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/vnd.ms-modi', 50, 5, [
            new MagicMatch(0, 1, "EP*\x00", '', 0),
        ]),
        new MagicRule('image/vnd.zbrush.pcx', 50, 3, [
            new MagicRegex('~(?n)\A(?(?=\n)(.{1}\x00|.{1}\x02|.{1}\x03|.{1}\x05)|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/webp', 50, 13, [
            new MagicRegex('~(?n)\A(?(?=RIFF).{8}WEBP|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/wmf', 50, 27, [
            new MagicRegex('~(?n)\A((?(?=\xD7\xCD\xC6\x9A)(?(?=.{22}\x01\x00).{24}\t\x00|(*FAIL))|(*FAIL))|(?(?=\x01\x00).{2}\t\x00|(*FAIL)))~Ss'),
        ]),
        new MagicRule('image/x-applix-graphics', 50, 16, [
            new MagicRegex('~(?n)\A(?(?=\*BEGIN).{7}GRAPHICS|(*FAIL))~Ss'),
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
            new MagicMatch(20, 1, 'GIMP', '', 0),
        ]),
        new MagicRule('image/x-gimp-pat', 50, 25, [
            new MagicMatch(20, 1, 'GPAT', '', 0),
        ]),
        new MagicRule('image/x-icns', 50, 5, [
            new MagicMatch(0, 1, 'icns', '', 0),
        ]),
        new MagicRule('image/x-ilbm', 50, 13, [
            new MagicRegex('~(?n)\A(.{8}ILBM|.{8}PBM )~Ss'),
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
            new MagicRegex('~(?n)\A(?(?=.{10}\x00\x11)(?(?=.{12}\x02\xFF)(?(?=.{14}\f\x00).{16}\xFF\xFE|(*FAIL))|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/x-pict', 50, 531, [
            new MagicRegex('~(?n)\A(?(?=.{522}\x00\x11)(?(?=.{524}\x02\xFF)(?(?=.{526}\f\x00).{528}\xFF\xFE|(*FAIL))|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/x-portable-bitmap', 50, 4, [
            new MagicRegex('~(?n)\A((?(?=P1)(.{2}\n|.{2} |.{2}\t|.{2}\r)|(*FAIL))|(?(?=P4)(.{2}\n|.{2} |.{2}\t|.{2}\r)|(*FAIL)))~Ss'),
        ]),
        new MagicRule('image/x-portable-graymap', 50, 4, [
            new MagicRegex('~(?n)\A((?(?=P2)(.{2}\n|.{2} |.{2}\t|.{2}\r)|(*FAIL))|(?(?=P5)(.{2}\n|.{2} |.{2}\t|.{2}\r)|(*FAIL)))~Ss'),
        ]),
        new MagicRule('image/x-portable-pixmap', 50, 4, [
            new MagicRegex('~(?n)\A((?(?=P3)(.{2}\n|.{2} |.{2}\t|.{2}\r)|(*FAIL))|(?(?=P6)(.{2}\n|.{2} |.{2}\t|.{2}\r)|(*FAIL)))~Ss'),
        ]),
        new MagicRule('image/x-quicktime', 50, 9, [
            new MagicMatch(4, 1, 'idat', '', 0),
        ]),
        new MagicRule('image/x-sigma-x3f', 50, 9, [
            new MagicRegex('~(?n)\A(?(?=FOVb).{4}.\x00.\x00|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/x-skencil', 50, 9, [
            new MagicMatch(0, 1, '##Sketch', '', 0),
        ]),
        new MagicRule('image/x-sun-raster', 50, 5, [
            new MagicMatch(0, 1, "Y\xA6j\x95", '', 0),
        ]),
        new MagicRule('image/x-tga', 50, 18, [
            new MagicRegex('~(?n)\A(?(?=.{1}\x00\x02)(.{16}\x08|.{16}\x10|.{16}\x18|.{16} )|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/x-win-bitmap', 50, 7, [
            new MagicRegex('~(?n)\A(?(?=\x00\x00\x02\x00).{5}\x00|(*FAIL))~Ss'),
        ]),
        new MagicRule('image/x-xcf', 50, 14, [
            new MagicRegex('~(?n)\A(gimp xcf file|gimp xcf v)~Ss'),
        ]),
        new MagicRule('image/x-xcursor', 50, 5, [
            new MagicMatch(0, 1, 'Xcur', '', 0),
        ]),
        new MagicRule('image/x-xfig', 50, 5, [
            new MagicMatch(0, 1, '#FIG', '', 0),
        ]),
        new MagicRule('image/x-xpixmap', 50, 10, [
            new MagicRegex('~(?n)\A(/\* XPM \*/|\! XPM2\n)~Ss'),
        ]),
        new MagicRule('message/news', 50, 8, [
            new MagicRegex('~(?n)\A(Article|Path\:|Xref\:)~Ss'),
        ]),
        new MagicRule('message/rfc822', 50, 15, [
            new MagicRegex('~(?n)\A(\#\! rnews|Content\-Type\:|Forward to|From\:|N\#\! rnews|Pipe to|Received\:|Relay\-Version\:|Return\-Path\:|Return\-path\:|Subject\: |To\:)~Ss'),
        ]),
        new MagicRule('model/gltf-binary', 50, 5, [
            new MagicMatch(0, 1, 'glTF', '', 0),
        ]),
        new MagicRule('model/iges', 50, 82, [
            new MagicRegex('~(?n)\A(.{72}S      1\n|.{72}S0000001\n)~Ss'),
        ]),
        new MagicRule('model/mtl', 50, 264, [
            new MagicRegex('~(?n)\A(\# Blender MTL File\: \'|.{0,256}newmtl )~Ss'),
        ]),
        new MagicRule('model/obj', 50, 264, [
            new MagicRegex('~(?n)\A(.{0,64} OBJ File\: \'|.{0,256}mtllib )~Ss'),
        ]),
        new MagicRule('model/stl', 50, 6, [
            new MagicRegex('~(?n)\A(solid|SOLID)~Ss'),
        ]),
        new MagicRule('model/vrml', 50, 7, [
            new MagicMatch(0, 1, '#VRML ', '', 0),
        ]),
        new MagicRule('text/cache-manifest', 50, 16, [
            new MagicRegex('~(?n)\A(?(?=CACHE MANIFEST)(.{14} |.{14}\t|.{14}\n|.{14}\r)|(*FAIL))~Ss'),
        ]),
        new MagicRule('text/calendar', 50, 16, [
            new MagicRegex('~(?n)\A(BEGIN\:VCALENDAR|begin\:vcalendar)~Ss'),
        ]),
        new MagicRule('text/html', 50, 271, [
            new MagicRegex('~(?n)\A(.{0,256}\<\!DOCTYPE HTML|.{0,256}\<\!doctype html|.{0,256}\<\!DOCTYPE html|.{0,256}\<HEAD|.{0,256}\<head|.{0,256}\<HTML|.{0,256}\<html|.{0,256}\<SCRIPT|.{0,256}\<script|\<BODY|\<body|\<h1|\<H1|\<\!doctype HTML)~Ss'),
        ]),
        new MagicRule('text/javascript', 50, 30, [
            new MagicRegex('~(?n)\A(\#\!/bin/gjs|\#\! /bin/gjs|eval "exec /bin/gjs|\#\!/usr/bin/gjs|\#\! /usr/bin/gjs|eval "exec /usr/bin/gjs|\#\!/usr/local/bin/gjs|\#\! /usr/local/bin/gjs|eval "exec /usr/local/bin/gjs|.{2}.{0,14}/bin/env gjs)~Ss'),
        ]),
        new MagicRule('text/jscript.encode', 50, 5, [
            new MagicMatch(0, 1, '#@~^', '', 0),
        ]),
        new MagicRule('text/plain', 50, 18, [
            new MagicRegex('~(?n)\A(This is TeX,|This is METAFONT,)~Ss'),
        ]),
        new MagicRule('text/spreadsheet', 50, 4, [
            new MagicMatch(0, 1, 'ID;', '', 0),
        ]),
        new MagicRule('text/troff', 50, 5, [
            new MagicRegex('~(?n)\A(\.\\\\"|\'\\\\"|\'\.\\\\"|\\\\")~Ss'),
        ]),
        new MagicRule('text/vbscript.encode', 50, 5, [
            new MagicMatch(0, 1, '#@~^', '', 0),
        ]),
        new MagicRule('text/vcard', 50, 12, [
            new MagicRegex('~(?n)\A(BEGIN\:VCARD|begin\:vcard)~Ss'),
        ]),
        new MagicRule('text/vnd.familysearch.gedcom', 50, 7, [
            new MagicMatch(0, 1, '0 HEAD', '', 0),
        ]),
        new MagicRule('text/vnd.graphviz', 50, 16, [
            new MagicRegex('~(?n)\A(digraph |strict digraph |graph |strict graph )~Ss'),
        ]),
        new MagicRule('text/vnd.sun.j2me.app-descriptor', 50, 8, [
            new MagicMatch(0, 1, 'MIDlet-', '', 0),
        ]),
        new MagicRule('text/vnd.trolltech.linguist', 50, 261, [
            new MagicRegex('~(?n)\A(.{0,256}\<TS |.{0,256}\<TS\>)~Ss'),
        ]),
        new MagicRule('text/vtt', 50, 7, [
            new MagicMatch(0, 1, 'WEBVTT', '', 0),
        ]),
        new MagicRule('text/x-bibtex', 50, 36, [
            new MagicMatch(0, 1, '% This file was created with JabRef', '', 0),
        ]),
        new MagicRule('text/x-dbus-service', 50, 274, [
            new MagicRegex('~(?n)\A(.{0,256}\n\[D\-BUS Service\]\n|\[D\-BUS Service\]\n)~Ss'),
        ]),
        new MagicRule('text/x-devicetree-binary', 50, 5, [
            new MagicMatch(0, 1, "\xD0\r\xFE\xED", '', 0),
        ]),
        new MagicRule('text/x-devicetree-source', 50, 4089, [
            new MagicRegex('~(?n)\A(?(?=[\x00-\x7F][\x00-\x7F]).{0,4080}/dts\-v1/|(*FAIL))~Ss'),
        ]),
        new MagicRule('text/x-emacs-lisp', 50, 9, [
            new MagicRegex('~(?n)\A(\n\(|;ELC\x13\x00\x00\x00)~Ss'),
        ]),
        new MagicRule('text/x-gcode-gx', 50, 11, [
            new MagicMatch(0, 1, 'xgcode 1.0', '', 0),
        ]),
        new MagicRule('text/x-gettext-translation-template', 50, 305, [
            new MagicRegex('~(?n)\A.{0,256}\#, fuzzy\nmsgid ""\nmsgstr ""\n"Project\-Id\-Version\:~Ss'),
        ]),
        new MagicRule('text/x-google-video-pointer', 50, 40, [
            new MagicRegex('~(?n)\A(\#\.download\.the\.free\.Google\.Video\.Player|\# download the free Google Video Player)~Ss'),
        ]),
        new MagicRule('text/x-iMelody', 50, 14, [
            new MagicMatch(0, 1, 'BEGIN:IMELODY', '', 0),
        ]),
        new MagicRule('text/x-iptables', 50, 280, [
            new MagicRegex('~(?n)\A(.{0,256}/etc/sysconfig/iptables|(?(?=.{0,256}\*filter)(?(?=.{0,256}\:INPUT)(?(?=.{0,256}\:FORWARD).{0,256}\:OUTPUT|(*FAIL))|(*FAIL))|(*FAIL))|(?(?=.{0,256}\-A INPUT)(?(?=.{0,256}\-A FORWARD).{0,256}\-A OUTPUT|(*FAIL))|(*FAIL))|(?(?=.{0,256}\-P INPUT)(?(?=.{0,256}\-P FORWARD).{0,256}\-P OUTPUT|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('text/x-ldif', 50, 10, [
            new MagicRegex('~(?n)\A(dn\: cn\=|dn\: mail\=)~Ss'),
        ]),
        new MagicRule('text/x-lua', 50, 32, [
            new MagicRegex('~(?n)\A(.{2}.{0,14}/bin/lua|.{2}.{0,14}/bin/luajit|.{2}.{0,14}/bin/env lua|.{2}.{0,14}/bin/env luajit)~Ss'),
        ]),
        new MagicRule('text/x-makefile', 50, 17, [
            new MagicRegex('~(?n)\A(\#\!/usr/bin/make|\#\! /usr/bin/make)~Ss'),
        ]),
        new MagicRule('text/x-matlab', 50, 9, [
            new MagicMatch(0, 1, 'function', '', 0),
        ]),
        new MagicRule('text/x-microdvd', 50, 9, [
            new MagicRegex('~(?n)\A(\{1\}|\{0\}|.{0,6}\}\{)~Ss'),
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
        new MagicRule('text/x-mpl2', 50, 9, [
            new MagicRegex('~(?n)\A(\[1\]|\[0\]|.{0,6}\]\[)~Ss'),
        ]),
        new MagicRule('text/x-mrml', 50, 7, [
            new MagicMatch(0, 1, '<mrml ', '', 0),
        ]),
        new MagicRule('text/x-ms-regedit', 50, 49, [
            new MagicRegex('~(?n)\A(REGEDIT|Windows Registry Editor Version 5\.00|\xFF\xFEW\x00i\x00n\x00d\x00o\x00w\x00s\x00 \x00R\x00e\x00g\x00i\x00s\x00t\x00r\x00y\x00 \x00E\x00d\x00i\x00t\x00o\x00r\x00)~Ss'),
        ]),
        new MagicRule('text/x-mup', 50, 7, [
            new MagicMatch(0, 1, '//!Mup', '', 0),
        ]),
        new MagicRule('text/x-patch', 50, 24, [
            new MagicRegex('~(?n)\A(diff\t|diff |\*\*\*\t|\*\*\* |\=\=\= |\-\-\- |Only in\t|Only in |Common subdirectories\: |Index\:)~Ss'),
        ]),
        new MagicRule('text/x-python', 50, 33, [
            new MagicRegex('~(?n)\A(\#\!/bin/python|\#\! /bin/python|eval "exec /bin/python|\#\!/usr/bin/python|\#\! /usr/bin/python|eval "exec /usr/bin/python|\#\!/usr/local/bin/python|\#\! /usr/local/bin/python|eval "exec /usr/local/bin/python|.{2}.{0,14}/bin/env python)~Ss'),
        ]),
        new MagicRule('text/x-qml', 50, 3011, [
            new MagicRegex('~(?n)\A(.{2}.{0,14}/bin/env qml|(?(?=.{0,3000}import Qt).{9}.{0,3000}\{|(*FAIL))|(?(?=.{0,3000}import Qml).{9}.{0,3000}\{|(*FAIL)))~Ss'),
        ]),
        new MagicRule('text/x-rpm-spec', 50, 10, [
            new MagicRegex('~(?n)\A(Summary\: |%define )~Ss'),
        ]),
        new MagicRule('text/x-ssa', 50, 270, [
            new MagicRegex('~(?n)\A(.{0,256}\[Script Info\]|.{0,256}Dialogue\: )~Ss'),
        ]),
        new MagicRule('text/x-subviewer', 50, 14, [
            new MagicMatch(0, 1, '[INFORMATION]', '', 0),
        ]),
        new MagicRule('text/x-systemd-unit', 50, 270, [
            new MagicRegex('~(?n)\A(.{0,256}\n\[Unit\]\n|.{0,256}\n\[Install\]\n|.{0,256}\n\[Automount\]\n|.{0,256}\n\[Mount\]\n|.{0,256}\n\[Path\]\n|.{0,256}\n\[Scope\]\n|.{0,256}\n\[Service\]\n|.{0,256}\n\[Slice\]\n|.{0,256}\n\[Socket\]\n|.{0,256}\n\[Swap\]\n|.{0,256}\n\[Timer\]\n|\[Unit\]\n|\[Install\]\n|\[Automount\]\n|\[Mount\]\n|\[Path\]\n|\[Scope\]\n|\[Service\]\n|\[Slice\]\n|\[Socket\]\n|\[Swap\]\n|\[Timer\]\n)~Ss'),
        ]),
        new MagicRule('text/x-tex', 50, 15, [
            new MagicMatch(1, 1, 'documentclass', '', 0),
        ]),
        new MagicRule('text/x-uuencode', 50, 7, [
            new MagicMatch(0, 1, 'begin ', '', 0),
        ]),
        new MagicRule('text/x-vb', 50, 8, [
            new MagicRegex('~(?n)\A(Imports|Module|REM)~Ss'),
        ]),
        new MagicRule('text/xmcd', 50, 7, [
            new MagicMatch(0, 1, '# xmcd', '', 0),
        ]),
        new MagicRule('video/3gpp', 50, 12, [
            new MagicRegex('~(?n)\A(.{4}ftyp3ge|.{4}ftyp3gg|.{4}ftyp3gp|.{4}ftyp3gs)~Ss'),
        ]),
        new MagicRule('video/3gpp2', 50, 12, [
            new MagicMatch(4, 1, 'ftyp3g2', '', 0),
        ]),
        new MagicRule('video/annodex', 50, 521, [
            new MagicRegex('~(?n)\A(?(?=OggS)(?(?=.{28}fishead\x00).{56}.{0,456}CMML\x00\x00\x00\x00|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('video/dv', 50, 5, [
            new MagicRegex('~(?n)\A\x1F\x07\x00.~Ss'),
        ]),
        new MagicRule('video/mj2', 50, 25, [
            new MagicRegex('~(?n)\A\x00\x00\x00\fjP  \r\n\x87\n........mjp2~Ss'),
        ]),
        new MagicRule('video/mp2t', 50, 774, [
            new MagicRegex('~(?n)\A((?(?=G)(?(?=.{188}G)(?(?=.{376}G)(?(?=.{564}G).{752}G|(*FAIL))|(*FAIL))|(*FAIL))|(*FAIL))|(?(?=.{4}G)(?(?=.{196}G)(?(?=.{388}G)(?(?=.{580}G).{772}G|(*FAIL))|(*FAIL))|(*FAIL))|(*FAIL)))~Ss'),
        ]),
        new MagicRule('video/mp4', 50, 13, [
            new MagicRegex('~(?n)\A(.{4}ftypisom|.{4}ftypmp41|.{4}ftypmp42|.{4}ftypMSNV|.{4}ftypM4V |.{4}ftypf4v )~Ss'),
        ]),
        new MagicRule('video/mpeg', 50, 5, [
            new MagicRegex('~(?n)\A(G\?\xFF\x10|\x00\x00\x01\xB3|\x00\x00\x01\xBA)~Ss'),
        ]),
        new MagicRule('video/ogg', 50, 5, [
            new MagicMatch(0, 1, 'OggS', '', 0),
        ]),
        new MagicRule('video/quicktime', 50, 17, [
            new MagicRegex('~(?n)\A(.{12}mdat|.{4}mdat|.{4}moov|.{4}ftypqt)~Ss'),
        ]),
        new MagicRule('video/vnd.avi', 50, 13, [
            new MagicRegex('~(?n)\A((?(?=RIFF).{8}AVI |(*FAIL))|(?(?=AVF0).{8}AVI |(*FAIL)))~Ss'),
        ]),
        new MagicRule('video/vnd.mpegurl', 50, 8, [
            new MagicMatch(0, 1, '#EXTM4U', '', 0),
        ]),
        new MagicRule('video/vnd.radgamettools.bink', 50, 5, [
            new MagicRegex('~(?n)\A((?(?=BIK)(.{3}b|.{3}f|.{3}g|.{3}h|.{3}i)|(*FAIL))|(?(?=KB2)(.{3}a|.{3}d|.{3}f|.{3}g|.{3}h|.{3}i|.{3}j|.{3}k)|(*FAIL)))~Ss'),
        ]),
        new MagicRule('video/vnd.radgamettools.smacker', 50, 5, [
            new MagicRegex('~(?n)\A(?(?=SMK)(.{3}2|.{3}4)|(*FAIL))~Ss'),
        ]),
        new MagicRule('video/vnd.youtube.yt', 50, 13, [
            new MagicMatch(4, 1, 'ftypyt4 ', '', 0),
        ]),
        new MagicRule('video/webm', 50, 80, [
            new MagicRegex('~(?n)\A(?(?=\x1AE\xDF\xA3)(?(?=.{5}.{0,60}B\x82).{8}.{0,67}webm|(*FAIL))|(*FAIL))~Ss'),
        ]),
        new MagicRule('video/x-flic', 50, 3, [
            new MagicRegex('~(?n)\A(\x11\xAF|\x12\xAF)~Ss'),
        ]),
        new MagicRule('video/x-flv', 50, 4, [
            new MagicMatch(0, 1, 'FLV', '', 0),
        ]),
        new MagicRule('video/x-mng', 50, 9, [
            new MagicMatch(0, 1, "\x8AMNG\r\n\x1A\n", '', 0),
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
            new MagicRegex('~(?n)\A(\<ar\>|\!\<arch\>)~Ss'),
        ]),
        new MagicRule('application/x-riff', 45, 5, [
            new MagicMatch(0, 1, 'RIFF', '', 0),
        ]),
        new MagicRule('image/svg+xml', 45, 261, [
            new MagicRegex('~(?n)\A.{1}.{0,255}\<svg~Ss'),
        ]),
        new MagicRule('application/sparql-query', 40, 7, [
            new MagicMatch(0, 1, 'PREFIX', '', 0),
        ]),
        new MagicRule('application/x-executable', 40, 7, [
            new MagicRegex('~(?n)\A((?(?=\x7FELF).{5}\x01|(*FAIL))|(?(?=\x7FELF).{5}\x02|(*FAIL))|MZ|\x1CR)~Ss'),
            new MagicMatch(0, 1, "\x01\x10", '', $swap|2),
            new MagicMatch(0, 1, "\x01\x11", '', $swap|2),
            new MagicRegex('~(?n)\A\x83\x01~Ss'),
        ]),
        new MagicRule('application/x-iff', 40, 5, [
            new MagicMatch(0, 1, 'FORM', '', 0),
        ]),
        new MagicRule('application/x-nintendo-3ds-executable', 40, 5, [
            new MagicMatch(0, 1, '3DSX', '', 0),
        ]),
        new MagicRule('application/x-perl', 40, 276, [
            new MagicRegex('~(?n)\A(.{0,256}use strict|.{0,256}use warnings|.{0,256}use diagnostics|.{0,256}\n\=pod|.{0,256}\n\=head1 NAME|.{0,256}\n\=head1 DESCRIPTION|.{0,256}BEGIN \{)~Ss'),
        ]),
        new MagicRule('application/xml', 40, 6, [
            new MagicMatch(0, 1, '<?xml', '', 0),
        ]),
        new MagicRule('audio/basic', 40, 5, [
            new MagicMatch(0, 1, '.snd', '', 0),
        ]),
        new MagicRule('audio/x-mod', 40, 1085, [
            new MagicRegex('~(?n)\A(MTM|MMD0|MMD1|(?(?=.{112}[\x00-\x7F])((?(?=if)((?(?=.{368}[\x00-\x1F])((?(?=.{110}[\x00-\x3F])(.{111}[\x00-\x7F]|.{111}\x80)|(*FAIL))|(?(?=.{110}@)(.{111}[\x00-\x7F]|.{111}\x80)|(*FAIL)))|(*FAIL))|(?(?=.{368} )((?(?=.{110}[\x00-\x3F])(.{111}[\x00-\x7F]|.{111}\x80)|(*FAIL))|(?(?=.{110}@)(.{111}[\x00-\x7F]|.{111}\x80)|(*FAIL)))|(*FAIL)))|(*FAIL))|(?(?=JN)((?(?=.{368}[\x00-\x1F])(?(?=.{110}[\x00-\x3F])(.{111}[\x00-\x7F]|.{111}\x80)|(*FAIL))|(*FAIL))|(?(?=.{368} )(?(?=.{110}@)(.{111}[\x00-\x7F]|.{111}\x80)|(*FAIL))|(*FAIL)))|(*FAIL)))|(*FAIL))|MAS_UTrack_V00|.{1080}M\.K\.|.{1080}M\!K\!)~Ss'),
        ]),
        new MagicRule('chemical/x-pdb', 40, 8, [
            new MagicMatch(0, 1, 'HEADER ', '', 0),
        ]),
        new MagicRule('image/heif', 40, 13, [
            new MagicRegex('~(?n)\A(.{4}ftypmif1|.{4}ftypmsf1|.{4}ftypheic|.{4}ftypheix|.{4}ftyphevc|.{4}ftyphevx)~Ss'),
        ]),
        new MagicRule('text/html', 40, 263, [
            new MagicRegex('~(?n)\A(\<\!\-\-|.{0,256}\<TITLE|.{0,256}\<title)~Ss'),
        ]),
        new MagicRule('text/x-devicetree-source', 40, 4095, [
            new MagicRegex('~(?n)\A(?(?=[\x00-\x7F][\x00-\x7F])(.{0,4090}/ \{|(?(?=.{0,4080}include ).{10}.{0,4080}\.dts|(*FAIL)))|(*FAIL))~Ss'),
        ]),
        new MagicRule('text/x-mpsub', 40, 264, [
            new MagicRegex('~(?n)\A.{0,256}FORMAT\=~Ss'),
        ]),
        new MagicRule('video/x-javafx', 40, 4, [
            new MagicMatch(0, 1, 'FLV', '', 0),
        ]),
        new MagicRule('application/x-mobipocket-ebook', 30, 69, [
            new MagicMatch(60, 1, 'TEXtREAd', '', 0),
        ]),
        new MagicRule('image/x-3ds', 30, 3, [
            new MagicMatch(0, 1, 'MM', '', 0),
        ]),
        new MagicRule('text/x-csrc', 30, 9, [
            new MagicRegex('~(?n)\A(/\*|//|\#include)~Ss'),
        ]),
        new MagicRule('text/x-objcsrc', 30, 8, [
            new MagicMatch(0, 1, '#import', '', 0),
        ]),
        new MagicRule('application/mbox', 20, 6, [
            new MagicMatch(0, 1, 'From ', '', 0),
        ]),
        new MagicRule('image/x-tga', 10, 4, [
            new MagicRegex('~(?n)\A(.{1}\x01\x01|.{1}\x01\t|.{1}\x00\x03|.{1}\x00\n|.{1}\x00\v)~Ss'),
        ]),
        new MagicRule('text/x-matlab', 10, 2, [
            new MagicMatch(0, 1, '%', '', 0),
        ]),
        new MagicRule('text/x-modelica', 10, 3, [
            new MagicMatch(0, 1, '//', '', 0),
        ]),
        new MagicRule('text/x-tex', 10, 2, [
            new MagicMatch(0, 1, '%', '', 0),
        ]),
        new MagicRule('text/x-todo-txt', 10, 5, [
            new MagicRegex('~(?n)\A(\(A\) |x )~Ss'),
        ]),
    ],
);
