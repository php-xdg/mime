<?php declare(strict_types=1);

use ju1ius\XDGMime\Runtime\TreeMagicDatabase;
use ju1ius\XDGMime\Runtime\TreeMagicMatch;
use ju1ius\XDGMime\Runtime\TreeMagicRule;

return new TreeMagicDatabase([
    new TreeMagicRule('x-content/audio-dvd', 50, [
        new TreeMagicMatch('AUDIO_TS/AUDIO_TS.IFO', 16, null),
        new TreeMagicMatch('AUDIO_TS/AUDIO_TS.IFO;1', 16, null),
    ]),
    new TreeMagicRule('x-content/ebook-reader', 50, [
        new TreeMagicMatch('.kobo', 36, null),
        new TreeMagicMatch('system/com.amazon.ebook.booklet.reader', 0, null),
    ]),
    new TreeMagicRule('x-content/image-dcf', 50, [
        new TreeMagicMatch('dcim', 36, null),
    ]),
    new TreeMagicRule('x-content/image-picturecd', 50, [
        new TreeMagicMatch('PICTURES', 37, null),
    ]),
    new TreeMagicRule('x-content/ostree-repository', 50, [
        new TreeMagicMatch('.ostree', 37, null),
        new TreeMagicMatch('ostree/repo', 37, null),
        new TreeMagicMatch('var/lib/flatpak/repo', 37, null),
    ]),
    new TreeMagicRule('x-content/unix-software', 50, [
        new TreeMagicMatch('.autorun', 17, null),
        new TreeMagicMatch('autorun', 17, null),
        new TreeMagicMatch('autorun.sh', 17, null),
    ]),
    new TreeMagicRule('x-content/video-bluray', 50, [
        new TreeMagicMatch('BDAV', 36, null),
        new TreeMagicMatch('BDMV', 36, null),
    ]),
    new TreeMagicRule('x-content/video-dvd', 50, [
        new TreeMagicMatch('VIDEO_TS/VIDEO_TS.IFO', 16, null),
        new TreeMagicMatch('VIDEO_TS/VIDEO_TS.IFO;1', 16, null),
        new TreeMagicMatch('VIDEO_TS.IFO', 16, null),
        new TreeMagicMatch('VIDEO_TS.IFO;1', 16, null),
    ]),
    new TreeMagicRule('x-content/video-hddvd', 50, [
        new TreeMagicMatch('HVDVD_TS/HV000I01.IFO', 16, null),
        new TreeMagicMatch('HVDVD_TS/HV001I01.IFO', 16, null),
        new TreeMagicMatch('HVDVD_TS/HVA00001.VTI', 16, null),
    ]),
    new TreeMagicRule('x-content/video-svcd', 50, [
        new TreeMagicMatch('MPEG2/AVSEQ01.MPG', 16, null),
    ]),
    new TreeMagicRule('x-content/video-vcd', 50, [
        new TreeMagicMatch('mpegav/AVSEQ01.DAT', 16, null),
    ]),
    new TreeMagicRule('x-content/win32-software', 50, [
        new TreeMagicMatch('autorun.exe', 18, null),
        new TreeMagicMatch('autorun.inf', 16, null),
    ]),
]);
