<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;
use RFC5234\Core\Rule\CRLF;
use RFC5234\Core\Rule\VChar;
use RFC5234\Core\Rule\WSP;

class Comment extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:;(?:' . WSP::getPattern() . '|' . VChar::getPattern() . ')*' . CRLF::getPattern() . ')';
    }
}
