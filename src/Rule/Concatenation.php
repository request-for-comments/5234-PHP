<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Concatenation extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?;' . Concatenation::getPattern() . '(?:' . CWSP::getPattern() . '*/' . CWSP::getPattern() . '*' . Concatenation::getPattern() . ')*)';
    }
}
