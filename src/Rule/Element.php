<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Element extends AbstractRule
{
    /** @var bool */
    protected static $alreadyCalled;

    public static function getPattern(): string
    {
        if (!static::$alreadyCalled) {
            static::$alreadyCalled = true;
            $regex = "(?'element'" . RuleName::getPattern() . '|' . Group::getPattern() . '|' . Option::getPattern() .
                '|' . CharVal::getPattern() . '|' . NumVal::getPattern() . '|' . ProseVal::getPattern() . ')'
            ;
            static::$alreadyCalled = false;

            return $regex;
        }

        return "(?:\g'element')";
    }
}
