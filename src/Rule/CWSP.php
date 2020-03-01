<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;
use RFC5234\Core\Rule\WSP;

class CWSP extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:' . WSP::getPattern() . '|' . CNl::getPattern() . WSP::getPattern() . ')';
    }
}
