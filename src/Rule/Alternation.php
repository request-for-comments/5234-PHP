<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Alternation extends AbstractRule
{
    protected static $alreadyCalled;

    public static function getPattern(): string
    {
        if (!static::$alreadyCalled) {
            static::$alreadyCalled = true;
            $regex = "(?'alternation'" . Repetition::getPattern() . '(?:' . CWSP::getPattern() . '+' .
                Repetition::getPattern() . ')*)'
            ;
            static::$alreadyCalled = false;

            return $regex;
        }

        return "(?:\g'alternation')";
    }
}
