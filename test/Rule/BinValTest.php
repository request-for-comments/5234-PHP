<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\BinVal;
use RFC5234\Test\AbstractRuleTestCase;

class BinValTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = BinVal::class;
        $this->goodValueSet = [
            'b0', 'b1', 'b01010', 'b01.0', 'b010.00100', 'b010.001.00', 'b01-00100', 'b01000-100', 'b0-0',
        ];
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^', 'b010.001-00', 'b01-001-00',
        ];
        $this->moreThanOneGoodIsBadSet = [
            'b01010b01010', 'b010.00100b010.00100', 'b01-00100b01.00100',
        ];
    }
}
