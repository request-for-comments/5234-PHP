<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRuleTraceable;

class Concatenation extends AbstractRuleTraceable
{
    public static function getPattern(): string
    {
        if (!static::isAlreadyCalled()) {
            static::traceCallOnce();
            $regex = "(?'concatenation'" . Repetition::getPattern() . '(?:' . CWSP::getPattern() . '+' . Repetition::getPattern() . ')*)';
            static::unTrace();

            return $regex;
        }

        return "(?:\g'concatenation')";
    }
}
