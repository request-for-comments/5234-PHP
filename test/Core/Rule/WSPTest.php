<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\WSP;
use RFC5234\Test\AbstractRuleTestCase;

class WSPTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        ($dt = new SPTest())->setUp();
        ($ht = new HTabTest())->setUp();
        $this->testedRule = WSP::class;
        $this->goodValueSet = array_merge($dt->goodValueSet, $ht->goodValueSet);
        $this->badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ',
        ];
        $this->moreThanOneGoodIsBadSet = [
            " \t", "   ", "\t\t\t\t", " \t \t",
        ];
    }
}
