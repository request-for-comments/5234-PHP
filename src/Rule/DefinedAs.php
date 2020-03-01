<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class DefinedAs extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:' . CWSP::getPattern() . '*(?:=|=/)' . CWSP::getPattern() . '*)';
    }
}
