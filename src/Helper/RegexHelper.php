<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Helper;

class RegexHelper
{
    private const DELIMITER = '#';
    /** @var string */
    private $regex;

    private function __construct(string $pattern)
    {
        $this->regex = static::DELIMITER . '^' . $this->escapePatternWithDelimiter($pattern) . '$' . static::DELIMITER;
    }

    private function escapePatternWithDelimiter(string $pattern): string
    {
        return str_replace(static::DELIMITER, '\\' . static::DELIMITER, $pattern);
    }

    public static function prepare(string $pattern): RegexHelper
    {
        return new static($pattern);
    }

    public function pregMatch(string $stringToEvaluate, &$matches = []): bool
    {
        if (!is_array($matches)) {
            $matches = [];
        }

        return !!preg_match($this->regex, $stringToEvaluate, $matches);
    }
}
