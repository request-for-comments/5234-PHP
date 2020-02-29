<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\CR;
use RFC5234\Test\AbstractRuleTestCase;

class CRTest extends AbstractRuleTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$testedRule = CR::class;
        static::$goodValueSet = [
            "\r",
        ];
        static::$badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ',
        ];
        static::$moreThanOneGoodIsBadSet = [
            "\r\r",
        ];
    }
}
