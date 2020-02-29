<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\Digit;
use RFC5234\Test\AbstractRuleTestCase;

class DigitTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = Digit::class;
        $this->goodValueSet = [
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
        ];
        $this->badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ',
        ];
        $this->moreThanOneGoodIsBadSet = [
            '00', '11', '472', '327', '427', '75', '276', '2397', '800', '009',
        ];
    }
}
