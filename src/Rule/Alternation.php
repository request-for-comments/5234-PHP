<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Rule;


use RFC5234\Core\Rule\AbstractRuleTraceable;

class Alternation extends AbstractRuleTraceable
{
    public static function getPattern(): string
    {
        if (!static::isAlreadyCalled()) {
            static::traceCallOnce();
            $regex = "(?'alternation'" . Concatenation::getPattern() . '(?:' . CWSP::getPattern() . '*/' .
                CWSP::getPattern() . '*' . Concatenation::getPattern() . ')*)'
            ;
            static::unTrace();

            return $regex;
        }

        return "(?:\g'alternation')";
    }
}
