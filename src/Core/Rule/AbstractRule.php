<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Core\Rule;


use RFC5234\Exception\PatternMatchException;
use RFC5234\Exception\RegexHelperException;
use RFC5234\Helper\RegexHelper;

/**
 * Class AbstractRule
 * @package RFC5234\Core\Rule
 * @internal
 */
abstract class AbstractRule implements RuleInterface
{
    /** @var string  */
    protected $value;

    /**
     * AbstractRule constructor.
     * @param string $value
     * @throws PatternMatchException
     * @throws RegexHelperException
     */
    final public function __construct(string $value)
    {
        $rh = RegexHelper::prepare(static::getPattern());
        if (!$rh->pregMatch($value)) {
            throw new PatternMatchException($value, static::getPattern());
        }
        $this->value = $value;
    }

    /**
     * @param string $string
     * @return static[]
     * @throws PatternMatchException
     * @throws RegexHelperException
     */
    public static function getAllIn(string $string): array
    {
        $rh = RegexHelper::prepare(static::getPattern(), RegexHelper::NO_ANCHORS);
        $rh->pregMatchAll($string, $matches);

        $statics = [];
        foreach ($matches[0] as $match) {
            $statics[] = new static($match);
        }

        return $statics;
    }

    abstract public static function getPattern(): string;

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Shortcut for static::getPattern()
     * @return string
     */
    public static function P(): string
    {
        return static::getPattern();
    }
}
