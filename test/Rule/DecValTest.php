<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\DecVal;
use RFC5234\Test\AbstractRuleTestCase;

class DecValTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = DecVal::class;
        $this->goodValueSet = [
            'd0', 'd1', 'd111', 'd01.0', 'd010.00100', 'd010.001.00', 'd01-00100', 'd01000-100', 'd0-0',
        ];
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^', 'd010.001-00', 'd01-001-00',
        ];
        $this->initMoreThanOneGoodIsBadSetWithGoodSet();
    }
}
