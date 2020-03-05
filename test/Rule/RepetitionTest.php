<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\BinVal;
use RFC5234\Rule\Repetition;
use RFC5234\Test\AbstractRuleTestCase;

class RepetitionTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = Repetition::class;
        $this->goodValueSet = [
            '*c-wsp', '1*c-wsp', '*4c-wsp', '3*57c-wsp', 'c-wsp',
            '*(c-wsp / test / coooool)', '1*(c-wsp / test)', '*4(c-wsp / test)', '3*57(c-wsp / test)', '(c-wsp / test)',
            '*[c-wsp / test]', '1*[c-wsp / test]', '*4[c-wsp / test]', '3*57[c-wsp / testing]', '[c-wsp / test]',
        ];
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^',
        ];
        $this->initMoreThanOneGoodIsBadSetWithGoodSet(['c-wsp']);
    }
}
