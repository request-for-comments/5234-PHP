<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use PHPUnit\Framework\TestCase;
use RFC5234\Core\Rule\CR;
use RFC5234\Exception\PatternMatchException;

class CRTest extends TestCase
{
    public function test that match CR()
    {
        foreach (
            [
                "\r",
            ] as $char
        ) {
            $exception = null;
            try {
                new CR($char);
            } catch (PatternMatchException $exception) {
            }
            static::assertNull($exception, $exception->getMessage());
        }
    }

    public function test that not match with any none CR()
    {
        foreach (['é', 'ù', '¡', '°', '§', '£', 'ù', 'µ'] as $none) {
            $exception = null;
            try {
                new CR($none);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception, $none);
        }
    }

    public function test that not match with any more than once CR()
    {
        foreach (["\r\r"] as $multiple) {
            $exception = null;
            try {
                new CR($multiple);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception, $multiple);
        }
    }
}
