<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\SP;
use RFC5234\Test\AbstractRuleTestCase;

class SPTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = SP::class;
        $this->goodValueSet = [
            " ",
        ];
        $this->badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ', 'a', '3'
        ];
        $this->moreThanOneGoodIsBadSet = [
            "  ",
        ];
    }
}
