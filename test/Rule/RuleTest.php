<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\Elements;
use RFC5234\Rule\Rule;
use RFC5234\Test\AbstractRuleTestCase;


class RuleTest extends AbstractRuleTestCase
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
        ($det = new DefinedAsTest())->setUp();
        ($elt = new ElementsTest())->setUp();
        ($cnt = new CNlTest())->setUp();
        $this->testedRule = Rule::class;
        $baseSet = $rut->goodValueSet;
        $setsToHappen = [
            $det->goodValueSet,
            $elt->goodValueSet,
            $cnt->goodValueSet,
        ];
        $this->goodValueSet = (function () use ($baseSet, $setsToHappen) {
            $set = [];
            foreach ($baseSet as $base) {
                foreach ($setsToHappen[0] as $define) {
                    foreach ($setsToHappen[1] as $elements) {
                        foreach ($setsToHappen[2] as $cnl) {
                            if (rand(0, 10000) < 50) {
                                $set[] = $base.$define.$elements.$cnl;
                            }
                        }
                    }
                }
            }

            return $set;
        })();
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^',
        ];
        $this->initMoreThanOneGoodIsBadSetWithGoodSet();
    }

    /**
     * @retry 15
     */
    public function test that match with any good value()
    {
        parent::test that match with any good value();
    }
}
