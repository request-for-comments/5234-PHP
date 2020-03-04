<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\BinVal;
use RFC5234\Rule\CharVal;
use RFC5234\Test\AbstractRuleTestCase;

class CharValTest extends AbstractRuleTestCase
{
    private function getCharInValidRange(): string
    {
        $rand = mt_rand(0, 93);
        $run = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];

        foreach ($run as $first) {
            foreach ($run as $last) {
                $dec = hexdec($first.$last);

                if ($dec < 32 || $dec > 126 || $dec === 34) {
                    continue;
                }

                if ($rand-- > 0) {
                    continue;
                }

                return pack('H*', $first.$last);
            }
        }

        return pack('H*', '32');
    }

    private function getRandomValidString(): string
    {
        $rand = mt_rand(1, 90);
        $str = '';
        while ($rand--) {
            $str .= $this->getCharInValidRange();
        }

        return "\x22" . $str . "\x22";
    }

    public function setUp(): void
    {
        /*
        return '(?:' . DQuote::getPattern() . '(?:[\x20-\x21]|[\x23-\x7E])*' . DQuote::getPattern() . ')';
        return '\x22';
         */
        parent::setUp();
        $this->testedRule = CharVal::class;
        $this->goodValueSet = (function () {
            $set = ['""'];
            $i = 50;

            while ($i--) {
                $set[] = $this->getRandomValidString();
            }

            return $set;
        })();
        $this->badValueSet = [
            "''", "\x22\x22\x22", '!', '1', '¡', '§', '*', 'ù', '^', 'b010.001-00', 'b01-001-00',
        ];
        $this->moreThanOneGoodIsBadSet = [
            $this->getRandomValidString().$this->getRandomValidString(),
            $this->getRandomValidString().$this->getRandomValidString().$this->getRandomValidString(),
            $this->getRandomValidString().$this->getRandomValidString().$this->getRandomValidString().$this->getRandomValidString(),
        ];
    }
}
