<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Core\Rule;

/**
 * Interface RuleInterface
 * @package RFC5234\Core\Rule
 * @internal
 */
interface RuleInterface
{
    /**
     * Return a pattern that match for that rule
     */
    public static function getPattern(): string;
}
