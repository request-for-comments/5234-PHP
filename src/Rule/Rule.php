<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Rule extends AbstractRule
{
    public static function getPattern(): string
    {
        return '(?:' . RuleName::getPattern() . DefinedAs::getPattern() . Elements::getPattern() . CNl::getPattern() . ')';
    }
}
