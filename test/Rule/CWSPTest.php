<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Rule;

use RFC5234\Rule\CWSP;
use RFC5234\Test\AbstractRuleTestCase;

class CWSPTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = CWSP::class;
        $this->goodValueSet = [
            " ",
            "\t",
            "; quoted string of SP and VCHAR\r\n ",
            "; series of concatenated bit values\r\n ",
            ";  without angles\r\n ",
            ";  without DQUOTE\r\n ",
            ";\r\n ",
            "\r\n ",
            "; quoted string of SP and VCHAR\r\n\t",
            "; series of concatenated bit values\r\n\t",
            ";  without angles\r\n\t",
            ";  without DQUOTE\r\n\t",
            ";\r\n\t",
            "\r\n\t",
        ];
        $this->badValueSet = [
            'é', 'ù', '!', '1', '¡', '§', '*', 'ù', '^', 'b010.001-00', 'b01-001-00',
            "; series of concatenated bit values", "; series of concatenated bit values\n", "\n",
        ];
        $this->initMoreThanOneGoodIsBadSetWithGoodSet();
    }
}
