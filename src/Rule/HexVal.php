<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;
use RFC5234\Core\Rule\HexDig;

class HexVal extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:x' . HexDig::getPattern() . '+(?:(?:\.' . HexDig::getPattern() . '+)+|-' . HexDig::getPattern() . '+)?)';
    }
}
