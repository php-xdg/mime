<?php declare(strict_types=1);

use Xdg\Mime\Runtime\IconsDatabase;

return new IconsDatabase(
    icons: [
    ],
    genericIcons: [
        'application/x-atari-2600-rom' => 'application-x-executable',
        'application/x-atari-7800-rom' => 'application-x-executable',
        'application/x-atari-lynx-rom' => 'application-x-executable',
        'application/andrew-inset' => 'x-office-document',
        'application/epub+zip' => 'x-office-document',
        'application/illustrator' => 'image-x-generic',
        'application/mac-binhex40' => 'package-x-generic',
        'application/mathematica' => 'x-office-document',
        'application/mbox' => 'text-x-generic',
        'application/x-partial-download' => 'package-x-generic',
        'application/oda' => 'x-office-document',
        'application/x-wwf' => 'x-office-document',
        'application/pdf' => 'x-office-document',
        'application/xspf+xml' => 'audio-x-generic',
        'application/x-windows-themepack' => 'package-x-generic',
        'application/pkcs7-mime' => 'text-x-generic',
        'application/pkcs7-signature' => 'text-x-generic',
        'application/pkcs10' => 'text-x-generic',
        'application/postscript' => 'x-office-document',
        'application/prs.plucker' => 'x-office-document',
        'application/relax-ng-compact-syntax' => 'text-x-generic',
        'application/rtf' => 'x-office-document',
        'application/sieve' => 'text-x-script',
        'application/smil+xml' => 'video-x-generic',
        'application/vnd.ms-wpl' => 'video-x-generic',
        'application/x-gedcom' => 'x-office-document',
        'video/x-flv' => 'video-x-generic',
        'video/x-javafx' => 'video-x-generic',
        'application/x-go-sgf' => 'text-x-generic',
        'application/xliff+xml' => 'text-x-generic',
        'application/toml' => 'text-x-generic',
        'application/x-yaml' => 'text-x-generic',
        'application/vnd.corel-draw' => 'image-x-generic',
        'application/vnd.hp-hpgl' => 'image-x-generic',
        'application/vnd.hp-pcl' => 'image-x-generic',
        'application/vnd.lotus-1-2-3' => 'x-office-spreadsheet',
        'application/vnd.lotus-wordpro' => 'x-office-document',
        'application/vnd.ms-access' => 'x-office-document',
        'application/vnd.ms-cab-compressed' => 'package-x-generic',
        'application/vnd.ms-excel' => 'x-office-spreadsheet',
        'application/vnd.ms-excel.addin.macroEnabled.12' => 'x-office-spreadsheet',
        'application/vnd.ms-excel.sheet.binary.macroEnabled.12' => 'x-office-spreadsheet',
        'application/vnd.ms-excel.sheet.macroEnabled.12' => 'x-office-spreadsheet',
        'application/vnd.ms-excel.template.macroEnabled.12' => 'x-office-spreadsheet',
        'application/vnd.ms-powerpoint' => 'x-office-presentation',
        'application/vnd.ms-powerpoint.addin.macroEnabled.12' => 'x-office-presentation',
        'application/vnd.ms-powerpoint.presentation.macroEnabled.12' => 'x-office-presentation',
        'application/vnd.ms-powerpoint.slide.macroEnabled.12' => 'x-office-presentation',
        'application/vnd.ms-powerpoint.slideshow.macroEnabled.12' => 'x-office-presentation',
        'application/vnd.ms-powerpoint.template.macroEnabled.12' => 'x-office-presentation',
        'application/vnd.ms-visio.drawing.main+xml' => 'image-x-generic',
        'application/vnd.ms-visio.template.main+xml' => 'image-x-generic',
        'application/vnd.ms-visio.stencil.main+xml' => 'image-x-generic',
        'application/vnd.ms-visio.drawing.macroEnabled.main+xml' => 'image-x-generic',
        'application/vnd.ms-visio.template.macroEnabled.main+xml' => 'image-x-generic',
        'application/vnd.ms-visio.stencil.macroEnabled.main+xml' => 'image-x-generic',
        'application/vnd.ms-word.document.macroEnabled.12' => 'x-office-document',
        'application/vnd.ms-word.template.macroEnabled.12' => 'x-office-document',
        'application/oxps' => 'x-office-document',
        'application/vnd.ms-xpsdocument' => 'x-office-document',
        'application/vnd.ms-works' => 'x-office-document',
        'application/vnd.visio' => 'x-office-document',
        'application/msword' => 'x-office-document',
        'application/msword-template' => 'x-office-document',
        'application/vnd.stardivision.calc' => 'x-office-spreadsheet',
        'application/vnd.stardivision.chart' => 'x-office-spreadsheet',
        'application/vnd.stardivision.draw' => 'image-x-generic',
        'application/vnd.stardivision.impress' => 'x-office-presentation',
        'application/vnd.stardivision.math' => 'x-office-document',
        'application/vnd.stardivision.writer' => 'x-office-document',
        'application/vnd.sun.xml.calc' => 'x-office-spreadsheet',
        'application/vnd.sun.xml.calc.template' => 'x-office-spreadsheet',
        'application/vnd.sun.xml.draw' => 'image-x-generic',
        'application/vnd.sun.xml.draw.template' => 'image-x-generic',
        'application/vnd.sun.xml.impress' => 'x-office-presentation',
        'application/vnd.sun.xml.impress.template' => 'x-office-presentation',
        'application/vnd.sun.xml.math' => 'x-office-document',
        'application/vnd.sun.xml.writer' => 'x-office-document',
        'application/vnd.sun.xml.writer.global' => 'x-office-document',
        'application/vnd.sun.xml.writer.template' => 'x-office-document',
        'application/vnd.oasis.opendocument.text' => 'x-office-document',
        'application/vnd.oasis.opendocument.text-flat-xml' => 'x-office-document',
        'application/vnd.oasis.opendocument.text-template' => 'x-office-document',
        'application/vnd.oasis.opendocument.text-web' => 'text-html',
        'application/vnd.oasis.opendocument.text-master' => 'x-office-document',
        'application/vnd.oasis.opendocument.graphics' => 'image-x-generic',
        'application/vnd.oasis.opendocument.graphics-flat-xml' => 'image-x-generic',
        'application/vnd.oasis.opendocument.graphics-template' => 'image-x-generic',
        'application/vnd.oasis.opendocument.presentation' => 'x-office-presentation',
        'application/vnd.oasis.opendocument.presentation-flat-xml' => 'x-office-presentation',
        'application/vnd.oasis.opendocument.presentation-template' => 'x-office-presentation',
        'application/vnd.oasis.opendocument.spreadsheet' => 'x-office-spreadsheet',
        'application/vnd.oasis.opendocument.spreadsheet-flat-xml' => 'x-office-spreadsheet',
        'application/vnd.oasis.opendocument.spreadsheet-template' => 'x-office-spreadsheet',
        'application/vnd.oasis.opendocument.chart' => 'x-office-spreadsheet',
        'application/vnd.oasis.opendocument.chart-template' => 'x-office-spreadsheet',
        'application/vnd.oasis.opendocument.formula' => 'x-office-document',
        'application/vnd.oasis.opendocument.formula-template' => 'x-office-document',
        'application/vnd.oasis.opendocument.database' => 'x-office-document',
        'application/vnd.oasis.opendocument.image' => 'image-x-generic',
        'application/vnd.openofficeorg.extension' => 'x-office-document',
        'application/vnd.symbian.install' => 'package-x-generic',
        'x-epoc/x-sisx-app' => 'package-x-generic',
        'application/vnd.wordperfect' => 'x-office-document',
        'video/vnd.youtube.yt' => 'video-x-generic',
        'application/x-xbel' => 'text-html',
        'application/x-7z-compressed' => 'package-x-generic',
        'application/x-abiword' => 'x-office-document',
        'application/x-cue' => 'text-x-generic',
        'application/x-amipro' => 'x-office-document',
        'application/x-aportisdoc' => 'x-office-document',
        'application/x-applix-spreadsheet' => 'x-office-spreadsheet',
        'application/x-applix-word' => 'x-office-document',
        'application/x-arc' => 'package-x-generic',
        'application/x-archive' => 'package-x-generic',
        'application/x-arj' => 'package-x-generic',
        'application/x-asp' => 'text-x-script',
        'application/x-awk' => 'text-x-script',
        'application/x-bcpio' => 'package-x-generic',
        'application/x-blender' => 'image-x-generic',
        'application/x-bzdvi' => 'x-office-document',
        'application/x-bzip' => 'package-x-generic',
        'application/x-bzip-compressed-tar' => 'package-x-generic',
        'application/x-bzpdf' => 'x-office-document',
        'application/x-bzpostscript' => 'x-office-document',
        'application/vnd.comicbook-rar' => 'x-office-document',
        'application/x-cb7' => 'x-office-document',
        'application/x-cbt' => 'x-office-document',
        'application/vnd.comicbook+zip' => 'x-office-document',
        'application/x-lrzip' => 'package-x-generic',
        'application/x-lrzip-compressed-tar' => 'package-x-generic',
        'application/x-iso9660-appimage' => 'application-x-executable',
        'application/x-cdrdao-toc' => 'text-x-generic',
        'application/x-gd-rom-cue' => 'text-x-generic',
        'application/vnd.chess-pgn' => 'text-x-generic',
        'application/vnd.ms-htmlhelp' => 'x-office-document',
        'application/x-compress' => 'package-x-generic',
        'application/x-compressed-tar' => 'package-x-generic',
        'application/x-cpio' => 'package-x-generic',
        'application/x-cpio-compressed' => 'package-x-generic',
        'application/x-csh' => 'text-x-script',
        'application/x-dbf' => 'x-office-document',
        'application/ecmascript' => 'text-x-script',
        'application/x-mame-chd' => 'application-x-executable',
        'application/x-sega-cd-rom' => 'application-x-executable',
        'application/x-sega-pico-rom' => 'application-x-executable',
        'application/x-saturn-rom' => 'application-x-executable',
        'application/x-dreamcast-rom' => 'application-x-executable',
        'application/x-nintendo-ds-rom' => 'application-x-executable',
        'application/x-nintendo-3ds-rom' => 'application-x-executable',
        'application/x-nintendo-3ds-executable' => 'application-x-executable',
        'application/x-pc-engine-rom' => 'application-x-executable',
        'application/x-wii-rom' => 'application-x-executable',
        'application/x-wii-wad' => 'application-x-executable',
        'application/x-gamecube-rom' => 'application-x-executable',
        'application/x-thomson-cartridge-memo7' => 'application-x-executable',
        'application/x-thomson-cassette' => 'application-x-executable',
        'application/x-hfe-floppy-image' => 'application-x-executable',
        'application/x-thomson-sap-image' => 'application-x-executable',
        'application/vnd.debian.binary-package' => 'package-x-generic',
        'application/x-designer' => 'x-office-document',
        'application/x-desktop' => 'text-x-generic',
        'application/x-dia-diagram' => 'image-x-generic',
        'application/x-dia-shape' => 'image-x-generic',
        'application/x-dvi' => 'x-office-document',
        'application/x-egon' => 'image-x-generic',
        'application/x-executable' => 'application-x-executable',
        'application/x-fluid' => 'x-office-document',
        'font/woff' => 'font-x-generic',
        'font/woff2' => 'font-x-generic',
        'application/x-font-type1' => 'font-x-generic',
        'application/x-font-afm' => 'font-x-generic',
        'application/x-font-bdf' => 'font-x-generic',
        'application/x-font-dos' => 'font-x-generic',
        'application/x-font-framemaker' => 'font-x-generic',
        'application/x-font-libgrx' => 'font-x-generic',
        'application/x-font-linux-psf' => 'font-x-generic',
        'application/x-gz-font-linux-psf' => 'font-x-generic',
        'application/x-font-pcf' => 'font-x-generic',
        'font/otf' => 'font-x-generic',
        'application/x-font-speedo' => 'font-x-generic',
        'application/x-font-sunos-news' => 'font-x-generic',
        'application/x-font-tex' => 'font-x-generic',
        'application/x-font-tex-tfm' => 'font-x-generic',
        'font/ttf' => 'font-x-generic',
        'font/collection' => 'font-x-generic',
        'application/x-font-ttx' => 'font-x-generic',
        'application/x-font-vfont' => 'font-x-generic',
        'application/vnd.framemaker' => 'x-office-document',
        'application/x-gameboy-rom' => 'application-x-executable',
        'application/x-gameboy-color-rom' => 'application-x-executable',
        'application/x-gba-rom' => 'application-x-executable',
        'application/x-virtual-boy-rom' => 'application-x-executable',
        'application/x-genesis-rom' => 'application-x-executable',
        'application/x-genesis-32x-rom' => 'application-x-executable',
        'application/x-gtk-builder' => 'x-office-document',
        'application/x-glade' => 'x-office-document',
        'application/x-gnucash' => 'x-office-spreadsheet',
        'application/x-gnumeric' => 'x-office-spreadsheet',
        'application/x-gnuplot' => 'x-office-document',
        'application/x-graphite' => 'x-office-document',
        'application/x-gtktalog' => 'x-office-document',
        'application/x-gzdvi' => 'x-office-document',
        'application/gzip' => 'package-x-generic',
        'application/x-gzpdf' => 'x-office-document',
        'application/x-gzpostscript' => 'x-office-document',
        'application/x-hdf' => 'x-office-document',
        'application/x-java-archive' => 'package-x-generic',
        'text/x-groovy' => 'text-x-script',
        'application/x-java-jnlp-file' => 'text-x-script',
        'application/x-java-pack200' => 'package-x-generic',
        'text/javascript' => 'text-x-script',
        'application/json' => 'text-x-script',
        'application/jrd+json' => 'text-x-script',
        'application/json-patch+json' => 'text-x-script',
        'application/ld+json' => 'text-x-script',
        'application/schema+json' => 'text-x-script',
        'application/x-ipynb+json' => 'x-office-document',
        'application/vnd.coffeescript' => 'text-x-script',
        'application/x-jbuilder-project' => 'x-office-document',
        'application/x-karbon' => 'image-x-generic',
        'application/x-kchart' => 'x-office-spreadsheet',
        'application/x-kformula' => 'x-office-document',
        'application/x-killustrator' => 'image-x-generic',
        'application/x-kivio' => 'x-office-document',
        'application/x-kontour' => 'image-x-generic',
        'application/x-kpovmodeler' => 'image-x-generic',
        'application/x-kpresenter' => 'x-office-presentation',
        'application/x-krita' => 'x-office-document',
        'application/x-kspread' => 'x-office-spreadsheet',
        'application/x-kspread-crypt' => 'x-office-spreadsheet',
        'application/x-ksysv-package' => 'package-x-generic',
        'application/x-kugar' => 'x-office-document',
        'application/x-kword' => 'x-office-document',
        'application/x-kword-crypt' => 'x-office-document',
        'application/x-lha' => 'package-x-generic',
        'application/x-lhz' => 'package-x-generic',
        'application/x-lyx' => 'x-office-document',
        'application/x-lz4' => 'package-x-generic',
        'application/x-lz4-compressed-tar' => 'package-x-generic',
        'application/x-lzip' => 'package-x-generic',
        'application/x-lzip-compressed-tar' => 'package-x-generic',
        'application/x-lzpdf' => 'x-office-document',
        'application/x-lzma' => 'package-x-generic',
        'application/x-lzma-compressed-tar' => 'package-x-generic',
        'application/x-lzop' => 'package-x-generic',
        'application/x-qpress' => 'package-x-generic',
        'application/x-xar' => 'package-x-generic',
        'application/zlib' => 'package-x-generic',
        'application/x-magicpoint' => 'x-office-presentation',
        'application/x-macbinary' => 'package-x-generic',
        'application/x-matroska' => 'video-x-generic',
        'application/mxf' => 'video-x-generic',
        'application/x-mobipocket-ebook' => 'x-office-document',
        'application/x-mozilla-bookmarks' => 'text-html',
        'application/x-ms-dos-executable' => 'application-x-executable',
        'application/x-mswrite' => 'x-office-document',
        'application/x-msx-rom' => 'application-x-executable',
        'application/x-m4' => 'text-x-script',
        'application/x-n64-rom' => 'application-x-executable',
        'application/x-nautilus-link' => 'text-x-generic',
        'application/x-neo-geo-pocket-rom' => 'application-x-executable',
        'application/x-neo-geo-pocket-color-rom' => 'application-x-executable',
        'application/x-nes-rom' => 'application-x-executable',
        'application/x-netcdf' => 'x-office-document',
        'application/x-object' => 'x-office-document',
        'application/annodex' => 'video-x-generic',
        'application/ogg' => 'video-x-generic',
        'application/x-ole-storage' => 'x-office-document',
        'application/x-oleo' => 'x-office-spreadsheet',
        'application/x-pak' => 'package-x-generic',
        'application/x-par2' => 'package-x-generic',
        'application/x-pef-executable' => 'application-x-executable',
        'application/x-perl' => 'text-x-script',
        'application/x-php' => 'text-x-script',
        'application/x-planperfect' => 'x-office-spreadsheet',
        'application/x-pocket-word' => 'x-office-document',
        'application/x-profile' => 'text-x-generic',
        'application/x-pw' => 'x-office-document',
        'application/x-qtiplot' => 'x-office-document',
        'application/x-quattropro' => 'x-office-spreadsheet',
        'application/x-quicktime-media-link' => 'video-x-generic',
        'application/x-qw' => 'x-office-spreadsheet',
        'application/vnd.rar' => 'package-x-generic',
        'application/x-dar' => 'package-x-generic',
        'application/x-alz' => 'package-x-generic',
        'text/x-reject' => 'text-x-generic',
        'application/x-rpm' => 'package-x-generic',
        'application/x-source-rpm' => 'package-x-generic',
        'application/x-ruby' => 'text-x-script',
        'application/x-markaby' => 'text-x-script',
        'application/x-sc' => 'x-office-spreadsheet',
        'application/x-shar' => 'package-x-generic',
        'application/x-shared-library-la' => 'text-x-script',
        'application/x-shellscript' => 'text-x-script',
        'application/vnd.adobe.flash.movie' => 'video-x-generic',
        'application/x-shorten' => 'audio-x-generic',
        'application/x-siag' => 'x-office-spreadsheet',
        'application/x-slp' => 'package-x-generic',
        'application/x-sg1000-rom' => 'application-x-executable',
        'application/x-sms-rom' => 'application-x-executable',
        'application/x-gamegear-rom' => 'application-x-executable',
        'application/vnd.nintendo.snes.rom' => 'application-x-executable',
        'application/x-stuffit' => 'package-x-generic',
        'application/x-subrip' => 'text-x-generic',
        'text/vtt' => 'text-x-generic',
        'application/x-sami' => 'text-x-generic',
        'application/vnd.smaf' => 'audio-x-generic',
        'application/x-sv4cpio' => 'package-x-generic',
        'application/x-sv4crc' => 'package-x-generic',
        'application/x-tar' => 'package-x-generic',
        'application/x-tarz' => 'package-x-generic',
        'application/x-tex-gf' => 'font-x-generic',
        'application/x-tex-pk' => 'font-x-generic',
        'application/x-tgif' => 'x-office-document',
        'application/x-theme' => 'package-x-generic',
        'application/x-toutdoux' => 'x-office-document',
        'application/x-troff-man' => 'text-x-generic',
        'application/x-troff-man-compressed' => 'text-x-generic',
        'application/x-tzo' => 'package-x-generic',
        'application/x-xz' => 'package-x-generic',
        'application/x-xz-compressed-tar' => 'package-x-generic',
        'application/zstd' => 'package-x-generic',
        'application/x-zstd-compressed-tar' => 'package-x-generic',
        'application/x-xzpdf' => 'x-office-document',
        'application/x-ustar' => 'package-x-generic',
        'application/x-wais-source' => 'text-x-generic',
        'application/x-wpg' => 'image-x-generic',
        'application/x-wonderswan-rom' => 'application-x-executable',
        'application/x-wonderswan-color-rom' => 'application-x-executable',
        'application/x-x509-ca-cert' => 'text-x-generic',
        'application/x-zoo' => 'package-x-generic',
        'application/xhtml+xml' => 'text-html',
        'application/zip' => 'package-x-generic',
        'application/vnd.rn-realmedia' => 'video-x-generic',
        'application/x-ufraw' => 'image-x-generic',
        'application/dicom' => 'image-x-generic',
        'application/x-docbook+xml' => 'x-office-document',
        'image/vnd.djvu+multipage' => 'x-office-document',
        'inode/directory' => 'folder',
        'message/delivery-status' => 'text-x-generic',
        'message/disposition-notification' => 'text-x-generic',
        'message/external-body' => 'text-x-generic',
        'message/news' => 'text-x-generic',
        'message/partial' => 'text-x-generic',
        'message/rfc822' => 'text-x-generic',
        'message/x-gnu-rmail' => 'text-x-generic',
        'model/iges' => 'x-office-document',
        'model/vrml' => 'x-office-document',
        'application/rss+xml' => 'text-html',
        'application/atom+xml' => 'text-html',
        'text/x-opml+xml' => 'text-html',
        'text/vnd.graphviz' => 'x-office-document',
        'application/x-ace' => 'package-x-generic',
        'application/xml-dtd' => 'text-x-generic',
        'text/x-genie' => 'text-x-generic',
        'text/markdown' => 'x-office-document',
        'text/x-sass' => 'text-x-generic',
        'text/x-scss' => 'text-x-generic',
        'text/x-twig' => 'text-x-generic-template',
        'text/vbscript' => 'text-x-script',
        'application/xslt+xml' => 'text-x-generic',
        'text/x-maven+xml' => 'text-x-generic',
        'application/xml' => 'text-html',
        'application/xml-external-parsed-entity' => 'text-html',
        'application/x-hwp' => 'x-office-document',
        'application/x-hwt' => 'x-office-document',
        'application/x-netshow-channel' => 'video-x-generic',
        'application/sdp' => 'video-x-generic',
        'application/vnd.emusic-emusic_package' => 'package-x-generic',
        'application/x-ica' => 'text-x-generic',
        'application/vnd.mozilla.xul+xml' => 'x-office-document',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'x-office-document',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'x-office-document',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'x-office-presentation',
        'application/vnd.openxmlformats-officedocument.presentationml.slide' => 'x-office-presentation',
        'application/vnd.openxmlformats-officedocument.presentationml.slideshow' => 'x-office-presentation',
        'application/vnd.openxmlformats-officedocument.presentationml.template' => 'x-office-presentation',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'x-office-spreadsheet',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.template' => 'x-office-spreadsheet',
        'application/x-t602' => 'x-office-document',
        'application/x-cisco-vpn-settings' => 'text-x-generic',
        'application/x-it87' => 'text-x-generic',
        'application/x-ccmx' => 'text-x-generic',
        'application/vnd.apple.keynote' => 'x-office-presentation',
        'application/vnd.apple.numbers' => 'x-office-spreadsheet',
        'application/vnd.apple.pages' => 'x-office-document',
        'application/x-pagemaker' => 'x-office-document',
        'application/x-doom-wad' => 'package-x-generic',
        'application/vnd.flatpak' => 'package-x-generic',
        'application/vnd.flatpak.repo' => 'package-x-generic',
        'application/vnd.flatpak.ref' => 'package-x-generic',
        'application/vnd.appimage' => 'application-x-executable',
        'text/x.gcode' => 'text-x-generic',
        'application/x-appleworks-document' => 'x-office-document',
        'application/x-pyspread-spreadsheet' => 'x-office-spreadsheet',
        'application/x-pyspread-bz-spreadsheet' => 'x-office-spreadsheet',
    ],
);
