<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;
use RFC5234\Core\Rule\AbstractRuleTraceable;

class Element extends AbstractRuleTraceable
{
    public static function getPattern(): string
    {
        if (!static::isAlreadyCalled()) {
            static::traceCallOnce();
            $regex = "(?'element'" . RuleName::getPattern() . '|' . Group::getPattern() . '|' . Option::getPattern() .
                '|' . CharVal::getPattern() . '|' . NumVal::getPattern() . '|' . ProseVal::getPattern() . ')'
            ;
            static::unTrace();

            return $regex;
        }

        return "(?:\g'element')";
    }
}
