<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

namespace RFC5234\Test;


use PHPUnit\Framework\TestCase;
use RFC5234\Exception\PatternMatchException;

class AbstractRuleTestCase extends TestCase
{
    protected $testedRule;
    protected $goodValueSet = [];
    protected $badValueSet = [];
    protected $moreThanOneGoodIsBadSet = [];

    public function test that match with any good value()
    {
        foreach ($this->goodValueSet as $good
        ) {
            $exception = null;
            $message = '';
            try {
                new $this->testedRule($good);
            } catch (PatternMatchException $exception) {
                $message = $exception->getMessage();
            }
            static::assertNotInstanceOf(PatternMatchException::class, $exception, $message);
        }
    }

    public function test that not match with any bad value()
    {
        foreach ($this->badValueSet as $bad) {
            $exception = null;
            try {
                new $this->testedRule($bad);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(
                PatternMatchException::class,
                $exception,
                sprintf('`%s` seems to be a good value for %s', $bad, $this->testedRule)
            );
        }
    }

    public function test that not match with any more than one good value()
    {
        if (is_null($this->moreThanOneGoodIsBadSet)) {
            static::assertTrue(true);
            return;
        }
        foreach ($this->moreThanOneGoodIsBadSet as $multiple) {
            $exception = null;
            try {
                new $this->testedRule($multiple);
            } catch (PatternMatchException $exception) {
            }
            static::assertInstanceOf(
                PatternMatchException::class,
                $exception,
                sprintf('`%s` seems to be a good multiple value for %s', $multiple, $this->testedRule)
            );
        }
    }

    protected function initMoreThanOneGoodIsBadSetWithGoodSet()
    {
        $set = [];

        for ($i = 1; $i < count($this->goodValueSet); $i = $i+2) {
            $set[] = $this->goodValueSet[$i - 1] . $this->goodValueSet[$i];
        }

        for ($i = 2; $i < count($this->goodValueSet); $i = $i+3) {
            $set[] = $this->goodValueSet[$i - 2] . $this->goodValueSet[$i - 1] . $this->goodValueSet[$i];
        }

        for ($i = 1; $i < count($this->goodValueSet); $i++) {
            $set[] = $this->goodValueSet[$i] . $this->goodValueSet[$i] . $this->goodValueSet[$i] . $this->goodValueSet[$i];
        }

        $this->moreThanOneGoodIsBadSet = $set;
    }
}
