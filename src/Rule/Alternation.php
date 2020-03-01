<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Alternation extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?;' . Repetition::getPattern() . '(?:' . CWSP::getPattern() . '+' . Repetition::getPattern() . ')*)';
    }
}
