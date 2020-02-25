<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Core\Rule;


use RFC5234\Exception\PatternMatchException;
use RFC5234\Helper\RegexHelper;

abstract class AbstractRule implements RuleInterface
{
    private $value;

    public function __construct(string $value)
    {
        $rh = RegexHelper::prepare($this->getPattern());
        if (!$rh->pregMatch($value)) {
            throw new PatternMatchException($value, $this->getPattern());
        }
        $this->value = $value;
    }

    abstract public static function getPattern(): string;

    public function getValue(): string
    {
        return $this->value;
    }
}
