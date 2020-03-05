<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\Alternation;
use RFC5234\Test\AbstractRuleTestCase;

class AlternationTest extends AbstractRuleTestCase
{
    public function getRandomCWSP(array $CWSPSet): string
    {
        $rand = mt_rand(1, 10);
        $str = '';
        while ($rand--) {
            $str .= $CWSPSet[mt_rand(0, count($CWSPSet) - 1)];
        }

        return $str;
    }

    public function getRandomBlockCWSPConcatenation(array $CWSPSet, array $ConcatenationSet): string
    {
        $rand = mt_rand(1, 10);
        $str = '';
        while ($rand--) {
            $str .= $this->getRandomCWSP($CWSPSet) . '/' . $this->getRandomCWSP($CWSPSet);
            $str .= $ConcatenationSet[mt_rand(0, count($ConcatenationSet) - 1)];
        }

        return $str;
    }

    public function getMultipleRandomBlockCWSPConcatenation(array $CWSPSet, array $Concatenation): string
    {
        $rand = mt_rand(1, 10);
        $str = '';
        while ($rand--) {
            $str .= $this->getRandomBlockCWSPConcatenation($CWSPSet, $Concatenation);
        }

        return $str;
    }

    public function setUp(): void
    {
        parent::setUp();
        ($cct = new ConcatenationTest())->setUp();
        ($ct = new CWSPTest())->setUp();
        $this->testedRule = Alternation::class;
        $this->goodValueSet = (function () use ($cct, $ct) {
            $set = [];
            foreach ($cct->goodValueSet as $concatenation) {
                $set[] = $concatenation;
                $set[] = $concatenation . '/' . $concatenation;
                $set[] = $concatenation . '/' . $concatenation. '/' . $concatenation;
                $set[] = $concatenation . $this->getRandomCWSP($ct->goodValueSet) . '/' . $concatenation;
                $set[] = $concatenation . '/' . $this->getRandomCWSP($ct->goodValueSet) . $concatenation;
                $set[] = $concatenation . $this->getRandomCWSP($ct->goodValueSet) . '/' . $this->getRandomCWSP($ct->goodValueSet) . $concatenation;
                $set[] = $concatenation . $this->getRandomCWSP($ct->goodValueSet) . '/' . $this->getRandomCWSP($ct->goodValueSet) . $concatenation . $this->getRandomCWSP($ct->goodValueSet) . '/' . $this->getRandomCWSP($ct->goodValueSet) . $concatenation;
                $set[] = $concatenation . $this->getRandomBlockCWSPConcatenation($ct->goodValueSet, $cct->goodValueSet);
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
