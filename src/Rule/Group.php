<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRuleTraceable;

class Group extends AbstractRuleTraceable
{
    public static function getPattern(): string
    {
        if (!static::isAlreadyCalled()) {
            static::traceCallOnce();
            $regex = "(?'group'\(" . CWSP::getPattern() . '*' . Alternation::getPattern() . CWSP::getPattern() . '*\))';
            static::unTrace();

            return $regex;
        }

        return "(?:\g'group')";
    }
}
