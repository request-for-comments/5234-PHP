<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;
use RFC5234\Core\Rule\Digit;

class DecVal extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:d' . Digit::getPattern() . '+(?:(?:\.' . Digit::getPattern() . '+)+|-' . Digit::getPattern() . '+)?)';
    }
}
