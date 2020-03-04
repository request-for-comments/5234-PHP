<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class NumVal extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:%(?:' . BinVal::getPattern() . '|' . DecVal::getPattern() . '|' . HexVal::getPattern() . '))';
    }
}
