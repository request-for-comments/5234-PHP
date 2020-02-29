<?php


namespace RFC5234\Test;


use PHPUnit\Framework\TestCase;
use RFC5234\Exception\PatternMatchException;

class AbstractRuleTestCase extends TestCase
{
    protected static $testedRule;
    protected static $goodValueSet = [];
    protected static $badValueSet = [];
    protected static $moreThanOnceGoodSet = [];

    public function test that match with any good value()
    {
        foreach (static::$goodValueSet as $good
        ) {
            $exception = null;
            $message = '';
            try {
                new static::$testedRule($good);
            } catch (PatternMatchException $exception) {
                $message = $exception->getMessage();
            }
            static::assertNotInstanceOf(PatternMatchException::class, $exception, $message);
        }
    }

    public function test that not match with any bad value()
    {
        foreach (static::$badValueSet as $bad) {
            $exception = null;
            try {
                new static::$testedRule($bad);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception, sprintf('`%s` seems to be a good value', $bad));
        }
    }

    public function test that not match with any more than once good value()
    {
        foreach (static::$moreThanOnceGoodSet as $multiple) {
            $exception = null;
            try {
                new static::$testedRule($multiple);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(PatternMatchException::class, $exception, $multiple);
        }
    }
}
