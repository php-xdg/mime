<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Utils;

use Traversable;

final class Iter
{
    /**
     * @template T
     * @param iterable<T> $col
     * @param callable(T):bool $predicate
     * @return bool
     */
    public static function every(iterable $col, callable $predicate): bool
    {
        foreach ($col as $item) {
            if (!$predicate($item)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Breaks an iterable into multiple arrays, based on the evaluation of the given predicate.
     *
     * The second argument passed to the predicate may be used to inspect the current chunk.
     *
     * @template T
     * @param iterable<T> $col
     * @param callable(T, T[]):bool $predicate
     * @return Traversable<T[]>
     */
    public static function chunkWhile(iterable $col, callable $predicate): Traversable
    {
        $chunk = [];
        $first = true;
        foreach ($col as $item) {
            if ($first) {
                $first = false;
                $chunk[] = $item;
                continue;
            }
            if (!$predicate($item, $chunk)) {
                yield $chunk;
                $chunk = [];
            }
            $chunk[] = $item;
        }
        if ($chunk) {
            yield $chunk;
        }
    }

    /**
     * @template T
     * @param iterable<T> $col
     * @param int $size
     * @return Traversable<T[]>
     */
    public static function consecutive(iterable $col, int $size): Traversable
    {
        $buffer = [];
        $count = 0;
        foreach ($col as $item) {
            if ($count < $size) {
                $buffer[] = $item;
                $count++;
                continue;
            }
            yield $buffer;
            array_shift($buffer);
            $buffer[] = $item;
        }
        if (\count($buffer) === $size) {
            yield $buffer;
        }
    }

    /**
     * @template T
     * @param iterable<T> $col
     * @param int $size
     * @param callable(T):bool $predicate
     * @return bool
     */
    public static function someConsecutive(iterable $col, int $size, callable $predicate): bool
    {
        foreach (self::consecutive($col, $size) as $tuple) {
            if (self::every($tuple, $predicate)) {
                return true;
            }
        }
        return false;
    }
}
