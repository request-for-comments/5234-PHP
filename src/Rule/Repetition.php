<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Repetition extends AbstractRule
{
    /** @var bool */
    protected static $alreadyCalled;

    public static function getPattern(): string
    {
        if (!static::$alreadyCalled) {
            static::$alreadyCalled = true;
            $regex = "(?'repetition'" . Repeat::getPattern() . '?' . Element::getPattern() . ')';
            static::$alreadyCalled = false;

            return $regex;
        }

        return "(?:\g'repetition')";
    }
}
