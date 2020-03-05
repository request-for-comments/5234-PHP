<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\DefinedAs;
use RFC5234\Test\AbstractRuleTestCase;

class DefinedAsTest extends AbstractRuleTestCase
{
    public function getRandomCWSP(array $CWSPSet)
    {
        $rand = mt_rand(1, 10);
        $str = '';
        while ($rand--) {
            $str .= $CWSPSet[mt_rand(0, count($CWSPSet) - 1)];
        }
    }

    public function setUp(): void
    {
        parent::setUp();
        ($ct = new CWSPTest())->setUp();
        $this->testedRule = DefinedAs::class;
        $this->goodValueSet = array_merge(['=', '=/'], (function () use ($ct) {
            $set = [];
            $i = 50;
            while ($i--) {
                $set[] = $this->getRandomCWSP($ct->goodValueSet) . '=' . $this->getRandomCWSP($ct->goodValueSet);
                $set[] = $this->getRandomCWSP($ct->goodValueSet) . '=/' . $this->getRandomCWSP($ct->goodValueSet);
            }

            return $set;
        })());
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^', 'b010.001-00', 'b01-001-00',
        ];
        $this->initMoreThanOneGoodIsBadSetWithGoodSet();
    }
}
