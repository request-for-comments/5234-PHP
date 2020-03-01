<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Group extends AbstractRule
{
    protected static $alreadyCalled = false;

    public static function getPattern(): string
    {
        if (!static::$alreadyCalled) {
            static::$alreadyCalled = true;
            $regex = "(?'group'\(" . CWSP::getPattern() . '*' . Alternation::getPattern() . CWSP::getPattern() . '*\))';
            static::$alreadyCalled = false;

            return $regex;
        }

        return "(?:\g'group')";
    }
}
