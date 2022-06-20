<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

/**
 * @internal
 */
final class IconsDatabase
{
    /**
     * @param array<string, string> $icons
     * @param array<string, string> $genericIcons
     */
    public function __construct(
        private readonly array $icons,
        private readonly array $genericIcons,
    ) {
    }

    public function get(string $mimeType): string
    {
        if ($icon = $this->icons[$mimeType] ?? null) {
            return $icon;
        }

        return strtr($mimeType, ['/' => '-']);
    }

    public function generic(string $mimeType, string $mediaType): string
    {
        if ($icon = $this->genericIcons[$mimeType] ?? null) {
            return $icon;
        }

        return $mediaType . '-x-generic';
    }
}
