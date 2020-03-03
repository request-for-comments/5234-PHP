<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRuleTraceable;

class Repetition extends AbstractRuleTraceable
{
    public static function getPattern(): string
    {
        if (!static::isAlreadyCalled()) {
            static::traceCallOnce();
            $regex = "(?'repetition'" . Repeat::getPattern() . '?' . Element::getPattern() . ')';
            static::unTrace();

            return $regex;
        }

        return "(?:\g'repetition')";
    }
}
