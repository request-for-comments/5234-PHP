<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\RuleName;
use RFC5234\Test\AbstractRuleTestCase;

class RulNameTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = RuleName::class;
        $this->goodValueSet = [
            'a', 'dz', 'dzzz', 'd-a-1', 'd----', 'fff-fff-111', 'a1a11e1e1fez515fez-',
        ];
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^', 'b010.001-00',
        ];
        $this->moreThanOneGoodIsBadSet = null; //impossible cause double rulename looks like a rulename
    }
}
