<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\LF;
use RFC5234\Test\AbstractRuleTestCase;

class LFTest extends AbstractRuleTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$testedRule = LF::class;
        static::$goodValueSet = [
            "\n",
        ];
        static::$badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ', 'a', '3', "\t", ' '
        ];
        static::$moreThanOneGoodIsBadSet = [
            "\n\n\n\n\n",
            "\n\n\n\n",
            "\n\n\n",
//            "\n\n", // Should not match => PCRE Bug @see https://bugs.exim.org/show_bug.cgi?id=2536
        ];
    }
}
