<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use PHPUnit\Framework\TestCase;
use RFC5234\Core\Rule\Char;
use RFC5234\Exception\PatternMatchException;

class CharTest extends TestCase
{
    public function test that match with any char__US_ASCII()
    {
        foreach ([
                    ' ', '!', '"', '#', '$', '%', '&', '\'', '(', ')', '*', '+', ',', '-', '.', '/',
                    '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':', ';', '<', '=', '>', '?',
                    '@', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
                    'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '[', '\\', ']', '^', '_',
                    '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o',
                    'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '{', '|', '}', '~',
                 ] as $char
        ) {
            $exception = null;
            try {
                new Char($char);
            } catch (PatternMatchException $exception) {
            }
            static::assertNull($exception, $exception->getMessage());
        }
    }

    public function test that not match with any none char__US_ASCII()
    {
        foreach (['é', 'ù', '¡', '°', '§', '£', 'ù', 'µ'] as $none) {
            $exception = null;
            try {
                new Char($none);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception, $none);
        }
    }

    public function test that not match with any more than once char__US_ASCII()
    {
        foreach (['&&', 'ab', '10', '$+'] as $multiple) {
            $exception = null;
            try {
                new Char($multiple);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception, $multiple);
        }
    }
}
