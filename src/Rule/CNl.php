<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;
use RFC5234\Core\Rule\CRLF;

class CNl extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:' . Comment::getPattern() . '|' . CRLF::getPattern() . ')';
    }
}
