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
    public function setUp(): void
    {
        parent::setUp();
        ($dt = new DigitTest())->setUp();
        $this->testedRule = HexDig::class;
        $this->goodValueSet = array_merge($dt->goodValueSet, [
            'A', 'B', 'C', 'D', 'E', 'F',
        ]);
        $this->badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ',
        ];
        $this->moreThanOneGoodIsBadSet = [
            '01', '1A', 'FF', '0A', 'BDF',
        ];
    }
}
