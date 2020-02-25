<?php

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\Alpha;
use PHPUnit\Framework\TestCase;
use RFC5234\Exception\PatternMatchException;

class AlphaTest extends TestCase
{
    public function test that match with any a to z letter()
    {
        foreach (
            [
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
                'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            ] as $letter
        ) {
            $exception = null;
            try {
                new Alpha($letter);
            } catch (PatternMatchException $exception) {
            }
            static::assertNull($exception);
        }
    }

    public function test that not match with any none a to z letter()
    {
        foreach (['é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^'] as $noneLetter) {
            $exception = null;
            try {
                new Alpha($noneLetter);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception);
        }
    }

    public function test that not match with any more than once a to z letter()
    {
        foreach (['aa', 'ab', 'abc'] as $multipleLetter) {
            $exception = null;
            try {
                new Alpha($multipleLetter);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception);
        }
    }
}
