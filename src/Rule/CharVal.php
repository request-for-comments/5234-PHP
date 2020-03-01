<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;
use RFC5234\Core\Rule\DQuote;

class CharVal extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:' . DQuote::getPattern() . '(?:[\x20-\x21]|[\x23-\x7E])*' . DQuote::getPattern() . ')';
    }
}
