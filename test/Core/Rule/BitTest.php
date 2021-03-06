<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\Bit;
use RFC5234\Test\AbstractRuleTestCase;

class BitTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = Bit::class;
        $this->goodValueSet = [
            '0', '1',
        ];
        $this->badValueSet = [
            'é', 'ù', '!', '4', '¡', '2', '*', 'ù', 'a'
        ];
        $this->moreThanOneGoodIsBadSet = [
            '00', '01', '10', '11'
        ];
    }
}
