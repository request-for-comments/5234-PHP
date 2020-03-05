<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\Repeat;
use RFC5234\Test\AbstractRuleTestCase;

class RepeatTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = Repeat::class;
        $this->goodValueSet = [
            '5', '1', '34', '42*7415', '0*1547', '124*', '*1', '1*', '*5989', '4888*5989', '*',
        ];
        $this->badValueSet = [
            'é', 'ù', '!', '¡', '§', 'ù', '^', 'b010.001-00', 'b01-001-00', '',
        ];
        $this->initMoreThanOneGoodIsBadSetWithGoodSet(['5', '1', '34',]);
    }
}
