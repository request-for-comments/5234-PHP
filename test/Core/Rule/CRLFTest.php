<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test\Core\Rule;

use RFC5234\Core\Rule\CRLF;
use RFC5234\Test\AbstractRuleTestCase;

class CRLFTest extends AbstractRuleTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->testedRule = CRLF::class;
        $this->goodValueSet = [
            "\r\n"
        ];
        $this->badValueSet = [
            'a', 'b', 'c', '{', ';', '^', 'j',
        ];
        $this->moreThanOneGoodIsBadSet = [
            "\r\n\r\n"
        ];
    }
}
