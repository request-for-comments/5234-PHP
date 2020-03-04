<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\NumVal;
use RFC5234\Test\AbstractRuleTestCase;

class NumValTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        ($bt = new BinValTest())->setUp();
        ($dt = new DecValTest())->setUp();
        ($ht = new HexValTest())->setUp();
        $this->testedRule = NumVal::class;
        $this->goodValueSet = array_map(function ($value) {
            return '%'.$value;
        }, array_merge($bt->goodValueSet, $dt->goodValueSet, $ht->goodValueSet));
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^', 'b010.001-00', 'b01-001-00',
        ];
        $this->moreThanOneGoodIsBadSet = [
            '%'.$this->goodValueSet[0].$this->goodValueSet[1],
            '%'.$this->goodValueSet[2].$this->goodValueSet[3].$this->goodValueSet[4],
        ];
    }
}
