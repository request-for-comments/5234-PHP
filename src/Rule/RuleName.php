<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;
use RFC5234\Core\Rule\Alpha;
use RFC5234\Core\Rule\Digit;

class RuleName extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:' . Alpha::getPattern() . '(?:' . Alpha::getPattern() . '|' . Digit::getPattern() . '|-)*)';
    }
}
