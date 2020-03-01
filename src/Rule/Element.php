<?php


namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRule;

class Element extends AbstractRule
{
    public static function getPattern(): string
    {
//        element        =  rulename / group / option /
//                          char-val / num-val / prose-val
        return '(?:' . RuleName::getPattern() . '|' /* GROUP | OPTION */ .
            CharVal::getPattern() . '|' . NumVal::getPattern() . '|' . ProseVal::getPattern() . ')'
        ;
    }
}
