<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\WSP;
use RFC5234\Test\AbstractRuleTestCase;

class WSPTest extends AbstractRuleTestCase
{
    public static function setUpBeforeClass(): void
    {
        $dt = new SPTest();
        $dt::setUpBeforeClass();
        $dtGV = $dt::$goodValueSet;
        $ht = new HTabTest();
        $ht::setUpBeforeClass();
        $htGV = $ht::$goodValueSet;
        parent::setUpBeforeClass();
        static::$testedRule = WSP::class;
        static::$goodValueSet = array_merge($dtGV, $htGV);
        static::$badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ',
        ];
        static::$moreThanOneGoodIsBadSet = [
            " \t", "   ", "\t\t\t\t", " \t \t",
        ];
    }
}
