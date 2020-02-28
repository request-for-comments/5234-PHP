<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\Alpha;
use PHPUnit\Framework\TestCase;
use RFC5234\Core\Rule\Bit;
use RFC5234\Exception\PatternMatchException;

class BitTest extends TestCase
{
    public function test that match with 0 or 1()
    {
        foreach (['0', '1',] as $bit) {
            $exception = null;
            try {
                new Bit($bit);
            } catch (PatternMatchException $exception) {
            }
            static::assertNull($exception);
        }
    }

    public function test that not match with any none 0 or 1()
    {
        foreach (['é', 'ù', '!', '4', '¡', '2', '*', 'ù', 'a'] as $noneBit) {
            $exception = null;
            try {
                new Bit($noneBit);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception);
        }
    }

    public function test that not match with any more than once 0 or 1()
    {
        foreach (['00', '01', '10', '11'] as $multipleLetter) {
            $exception = null;
            try {
                new Alpha($multipleLetter);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception);
        }
    }
}
