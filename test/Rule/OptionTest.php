<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\Group;
use RFC5234\Rule\Option;
use RFC5234\Test\AbstractRuleTestCase;


class OptionTest extends AbstractRuleTestCase
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
        ($at = new AlternationTest())->setUp();
        ($ct = new CWSPTest())->setUp();
        $this->testedRule = Option::class;
        $this->goodValueSet = (function () use ($at, $ct) {
            $set = [];
            foreach ($at->goodValueSet as $alternation) {
                $set[] = '[' . $alternation . ']';
                $set[] = '[' . $this->getRandomCWSP($ct->goodValueSet) . $alternation . ']';
                $set[] = '[' . $alternation . $this->getRandomCWSP($ct->goodValueSet) . ']';
                $set[] = '[' . $this->getRandomCWSP($ct->goodValueSet) . $alternation . $this->getRandomCWSP($ct->goodValueSet) . ']';
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
