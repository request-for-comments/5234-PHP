<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Exception;


use PHPUnit\Framework\Exception;

class PatternMatchException extends Exception
{
    public function __construct(string $currentString, string $patternToMatch, $code = 0, \Throwable $previous = null)
    {
        $message = sprintf('%s is not matching pattern: %s', $currentString, $patternToMatch);
        parent::__construct($message, $code, $previous);
    }
}
