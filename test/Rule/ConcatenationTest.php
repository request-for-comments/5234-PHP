<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\Concatenation;
use RFC5234\Test\AbstractRuleTestCase;

class ConcatenationTest extends AbstractRuleTestCase
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

    public function getRandomBlockCWSPRepetition(array $CWSPSet, array $RepetitionSet): string
    {
        $rand = mt_rand(1, 3);
        $str = '';
        while ($rand--) {
            $str .= $this->getRandomCWSP($CWSPSet) . ' ' . $RepetitionSet[mt_rand(0, count($RepetitionSet) - 1)];
        }

        return $str;
    }

    public function setUp(): void
    {
        parent::setUp();
        ($rt = new RepetitionTest())->setUp();
        ($ct = new CWSPTest())->setUp();
        $this->testedRule = Concatenation::class;
        $this->goodValueSet = (function () use ($rt, $ct) {
            $set = [];
            $i = 50;
            foreach ($rt->goodValueSet as $repetition) {
                $set[] = $repetition;
                $set[] = $repetition . $this->getRandomBlockCWSPRepetition($ct->goodValueSet, $rt->goodValueSet);
            }

            return $set;
        })();
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^',
        ];
        $this->moreThanOneGoodIsBadSet = null; // cause tricky some times double is true
    }
}
