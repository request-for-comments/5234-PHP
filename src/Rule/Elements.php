<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Elements extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:' . Alternation::getPattern() . CWSP::getPattern() . '*)';
    }
}
