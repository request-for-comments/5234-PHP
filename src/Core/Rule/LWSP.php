<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Core\Rule;


class LWSP extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:(?:' . WSP::getPattern() . '|' . CRLF::getPattern() . WSP::getPattern() . ')*)';
    }
}
