<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\HexVal;
use RFC5234\Test\AbstractRuleTestCase;

class HexValTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = HexVal::class;
        $this->goodValueSet = [
            'x0', 'x1', 'x01010', 'x01.0', 'x010.00100', 'x010.001.00', 'x01-00100', 'x01000-100', 'x0-0',
            'xA', 'xA', 'x0B010', 'x01.D', 'x01E.00100', 'x010.C01.0D', 'x01-00EE0', 'x01AB00-100', 'xA-0',
        ];
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^', 'x0A0.00B-00', 'x01-0C1-00', 'x010.C01.0G'
        ];
        $this->moreThanOneGoodIsBadSet = [
            'x0A010x01A10', 'x0F0.00100x010.001A0', 'x01-001E0x01.00100',
        ];
    }
}
