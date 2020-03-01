<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;
use RFC5234\Core\Rule\Bit;

class BinVal extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:b' . Bit::getPattern() . '+(?:(?:\.' . Bit::getPattern() . '+)+|-' . Bit::getPattern() . '+)?)';
    }
}
