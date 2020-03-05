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

    protected function initMoreThanOneGoodIsBadSetWithGoodSet(array $filter = [])
    {
        $goodSet = array_values(array_diff($this->goodValueSet, $filter));

        $set = [];

        for ($i = 1; $i < count($goodSet); $i = $i+2) {
            $set[] = $goodSet[$i - 1] . $goodSet[$i];
        }

        for ($i = 2; $i < count($goodSet); $i = $i+3) {
            $set[] = $goodSet[$i - 2] . $goodSet[$i - 1] . $goodSet[$i];
        }

        for ($i = 1; $i < count($goodSet); $i++) {
            $set[] = $goodSet[$i] . $goodSet[$i] . $goodSet[$i] . $goodSet[$i];
        }

        $this->moreThanOneGoodIsBadSet = $set;
    }

    public function getNumberOfRetries(): int
    {
        $annotations = $this->getAnnotations();
        foreach ($annotations as $annotation) {
            if (empty($annotation)) {
                continue;
            }
            if (key_exists('retry', $annotation)) {
                return (int) ($annotation['retry'][0] ?? 0);
            }
        }

        return 0;
    }

    public function runBare(): void
    {
        $retryCount = $this->getNumberOfRetries() + 1;
        $e = null;
        for ($i = 0; $i < $retryCount; $i++) {
            try {
                parent::runBare();
                return;
            }
            catch (\Throwable $e) {
            }
        }
        if ($e) {
            throw $e;
        }
    }
}
