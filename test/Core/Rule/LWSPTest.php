<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\LWSP;
use RFC5234\Test\AbstractRuleTestCase;

class LWSPTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        ($wt = new WSPTest())->setUp();
        ($ct = new CRLFTest())->setUp();
        $this->testedRule = LWSP::class;
        $this->goodValueSet = array_merge($wt->goodValueSet, (function () use ($wt, $ct) {
            $set = [];

            foreach ($ct->goodValueSet as $c) {
                foreach ($wt->goodValueSet as $w) {
                    $set[] = $c.$w;
                }
            }

            return $set;
        })());
        $this->badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ',
        ];
        $this->moreThanOneGoodIsBadSet = null;
    }
}
