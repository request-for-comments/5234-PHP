<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Core\Rule;


use RFC5234\Exception\PatternMatchException;
use RFC5234\Helper\RegexHelper;

/**
 * Class AbstractRuleTraceable
 * @package RFC5234\Core\Rule
 * @internal
 */
abstract class AbstractRuleTraceable implements RuleInterface
{
    private $value;
    /** @var string[] */
    protected static $trace = [];

    public function __construct(string $value)
    {
        $rh = RegexHelper::prepare($this->getPattern());
        if (!$rh->pregMatch($value)) {
            throw new PatternMatchException($value, $this->getPattern());
        }
        $this->value = $value;
    }

    abstract public static function getPattern(): string;

    protected static function traceCallOnce(): void
    {
        if (!self::isAlreadyCalled()) {
            static::$trace[] = static::class;
        }
    }

    protected static function isAlreadyCalled(): bool
    {
        return in_array(static::class, static::$trace);
    }

    protected static function unTrace(): void
    {
        if (static::class === static::$trace[0] ?? null) {
            static::$trace = [];
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
