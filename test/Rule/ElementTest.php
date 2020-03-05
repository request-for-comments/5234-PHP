<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\Element;
use RFC5234\Test\AbstractRuleTestCase;


class ElementTest extends AbstractRuleTestCase
{
    public function getRandomCWSP(array $CWSPSet): string
    {
        $rand = mt_rand(1, 3);
        $str = '';
        while ($rand--) {
            $str .= $CWSPSet[mt_rand(0, count($CWSPSet) - 1)];
        }

        return $str;
    }

    public function setUp(): void
    {
        parent::setUp();
        ($rut = new RuleNameTest())->setUp();
        ($grt = new GroupTest())->setUp();
        ($opt = new OptionTest())->setUp();
        ($cht = new CharValTest())->setUp();
        ($nut = new NumValTest())->setUp();
        ($prt = new ProseValTest())->setUp();
        $this->testedRule = Element::class;
        $this->goodValueSet = array_merge(
            $rut->goodValueSet,
            $grt->goodValueSet,
            $opt->goodValueSet,
            $cht->goodValueSet,
            $nut->goodValueSet,
            $prt->goodValueSet
        );
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^',
        ];
        $this->initMoreThanOneGoodIsBadSetWithGoodSet(array_merge($rut->goodValueSet));
    }

    /**
     * @retry 15
     */
    public function test that match with any good value()
    {
        parent::test that match with any good value();
    }
}
