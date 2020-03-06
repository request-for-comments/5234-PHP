<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\Elements;
use RFC5234\Rule\Rule;
use RFC5234\Rule\RuleList;
use RFC5234\Test\AbstractRuleTestCase;


class RuleListTest extends AbstractRuleTestCase
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

    public function getRandomComment(array $CNlSet)
    {
        return $CNlSet[mt_rand(0, count($CNlSet) - 1)];
    }

    public function getBlockCWSPCNl(array $CWSPSet, array $CNlSet)
    {
        return $this->getRandomCWSP($CWSPSet) . $this->getRandomComment($CNlSet);
    }

    public function getRandomRuleOrBlockCWSPCNl(array $RuleSet, array $CWSPSet, array $CNlSet)
    {
        return (0 !== mt_rand(0, 4))
            ? $RuleSet[mt_rand(0, count($CNlSet) - 1)]
            : $this->getBlockCWSPCNl($CWSPSet, $CNlSet)
        ;
    }

    public function getRandomMultipleRuleOrBlockCWSPCNl(array $RuleSet, array $CWSPSet, array $CNlSet)
    {
        $rand = mt_rand(2, 5);
        $str = '';
        while ($rand--) {
            $str .= $this->getRandomRuleOrBlockCWSPCNl($RuleSet, $CWSPSet, $CNlSet);
        }

        return $str;
    }

    public function setUp(): void
    {
        parent::setUp();
        ($rut = new RuleTest())->setUp();
        ($cwt = new CWSPTest())->setUp();
        ($cnt = new CNlTest())->setUp();
        $this->testedRule = RuleList::class;
        $this->goodValueSet = (function () use ($rut, $cwt, $cnt) {
            $set = [];
            $i = 150;
            while ($i--) {
                $set[] = $this->getRandomRuleOrBlockCWSPCNl($rut->goodValueSet, $cwt->goodValueSet, $cnt->goodValueSet);
                $set[] = $this->getRandomMultipleRuleOrBlockCWSPCNl($rut->goodValueSet, $cwt->goodValueSet, $cnt->goodValueSet);
            }

            return $set;
        })();
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^',
        ];
        $this->moreThanOneGoodIsBadSet = null;
    }

    /**
     * @retry 15
     */
    public function test that match with any good value()
    {
        parent::test that match with any good value();
    }
}
