<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\Alpha;
use RFC5234\Test\AbstractRuleTestCase;

class AlphaTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = Alpha::class;
        $this->goodValueSet = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
            'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        ];
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^'
        ];
        $this->moreThanOneGoodIsBadSet = [
            'aa', 'ab', 'abc'
        ];
    }
}
