<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\Octet;
use RFC5234\Test\AbstractRuleTestCase;

class OctetTest extends AbstractRuleTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$testedRule = Octet::class;
        static::$goodValueSet = (function () {
            $set = [];
            $run = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];

            foreach ($run as $first) {
                foreach ($run as $last) {
                    $set[] = pack('H*', $first.$last);
                }
            }

            return $set;
        })();
        static::$badValueSet = [
            'é', 'ù', '¡', '°', '§', '£', 'ù', 'µ',
        ];
        static::$moreThanOneGoodIsBadSet = [
            "\x00\x00", "\xFF\x00", "\x01\xA1\x5F",
        ];
    }
}
