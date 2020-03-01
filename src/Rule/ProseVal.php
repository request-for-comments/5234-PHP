<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class ProseVal extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:<(?:[\x20-\x3D]|\x3F-\x7E])*>)';
    }
}
