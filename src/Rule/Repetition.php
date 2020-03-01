<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Repetition extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?;' . Repeat::getPattern() . '?' . Element::getPattern() . ')';
    }
}
