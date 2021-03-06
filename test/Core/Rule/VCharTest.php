<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\VChar;
use RFC5234\Test\AbstractRuleTestCase;

class VCharTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = VChar::class;
        $this->goodValueSet = (function () {
            $set = [];
            $run = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];

            foreach ($run as $first) {
                foreach ($run as $last) {
                    $dec = hexdec($first.$last);
                    if ($dec < 33 || $dec > 126) {
                        continue;
                    }
                    $set[] = pack('H*', $first.$last);
                }
            }

            return $set;
        })();
        $this->badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ',
        ];
        $this->moreThanOneGoodIsBadSet = [
            "\x21\x22", "\x7E\x2A", "\x28\x71\x5F",
        ];
    }
}
