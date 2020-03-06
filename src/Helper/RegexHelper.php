<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Helper;

class RegexHelper
{
    public const NO_ANCHORS = 0;
    public const START_ANCHOR = 2;
    public const END_ANCHOR = 4;

    private const DELIMITER = '#';
    /** @var string */
    private $regex;

    /**
     * RegexHelper constructor.
     * @param string $pattern
     * @param int $anchors
     * @throws \Exception
     */
    private function __construct(string $pattern, int $anchors)
    {
        if (6 === $anchors) {
            $this->regex = static::DELIMITER . '^' . $this->escapePatternWithDelimiter($pattern) . '$' . static::DELIMITER;
            return;
        }
        if (4 === $anchors) {
            $this->regex = static::DELIMITER . $this->escapePatternWithDelimiter($pattern) . '$' . static::DELIMITER;
            return;
        }
        if (2 === $anchors) {
            $this->regex = static::DELIMITER . '^' . $this->escapePatternWithDelimiter($pattern) . static::DELIMITER;
            return;
        }
        if (0 === $anchors) {
            $this->regex = static::DELIMITER . $this->escapePatternWithDelimiter($pattern) . static::DELIMITER;
            return;
        }

        throw new \Exception('Anchors is badly defined');
    }

    private function escapePatternWithDelimiter(string $pattern): string
    {
        return str_replace(static::DELIMITER, '\\' . static::DELIMITER, $pattern);
    }

    /**
     * @param string $pattern
     * @param int $anchors
     * @return RegexHelper
     * @throws \Exception
     */
    public static function prepare(string $pattern, int $anchors = self::START_ANCHOR | self::END_ANCHOR): RegexHelper
    {
        return new self($pattern, $anchors);
    }

    /**
     * @param string $stringToEvaluate
     * @param array|null $matches it will be always initialized like a new empty array
     * @return bool
     */
    public function pregMatch(string $stringToEvaluate, &$matches = null): bool
    {
        $matches = [];

        return !!preg_match($this->regex, $stringToEvaluate, $matches);
    }

    /**
     * @param string $stringToEvaluate
     * @param array|null $matches it will be always initialized like a new empty array
     * @return bool
     */
    public function pregMatchAll(string $stringToEvaluate, &$matches = null): bool
    {
        $matches = [];

        return !!preg_match_all($this->regex, $stringToEvaluate, $matches);
    }
}
