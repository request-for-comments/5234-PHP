<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\HexDig;
use RFC5234\Test\AbstractRuleTestCase;

class HexDigTest extends AbstractRuleTestCase
{
    public static function setUpBeforeClass(): void
    {
        $dt = new DigitTest();
        $dt::setUpBeforeClass();
        parent::setUpBeforeClass();
        static::$testedRule = HexDig::class;
        static::$goodValueSet = array_merge($dt::$goodValueSet, [
            'A', 'B', 'C', 'D', 'E', 'F',
        ]);
        static::$badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ',
        ];
        static::$moreThanOneGoodIsBadSet = [
            '01', '1A', 'FF', '0A', 'BDF',
        ];
    }
}
