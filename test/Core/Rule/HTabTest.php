<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\HTab;
use RFC5234\Test\AbstractRuleTestCase;

class HTabTest extends AbstractRuleTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$testedRule = HTab::class;
        static::$goodValueSet = [
            "\t",
        ];
        static::$badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ', 'a', '3'
        ];
        static::$moreThanOneGoodIsBadSet = [
            "\t\t",
        ];
    }
}
