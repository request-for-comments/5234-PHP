<?php declare(strict_types=1);

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/request-for-comments/5234-PHP/blob/master/LICENSE.md CC-BY-SA-4.0
 * @link https://github.com/request-for-comments/5234-PHP/blob/master/README.md
 */

use RFC5234\Helper\RegexHelper;

require_once __DIR__ . '/../vendor/autoload.php';

$ruleInterfaceClasses = [];

$dir = new \DirectoryIterator(__DIR__ . '/../src/Core/Rule');

/** @var SplFileInfo $fileInfo */
foreach ($dir as $fileInfo) {
    if ($fileInfo->isDot()) {
        continue;
    }
    $className = '\RFC5234\Core\Rule\\' . $fileInfo->getBasename('.php');
    try {
        $rc = new \ReflectionClass($className);
        if (!$rc->isInstantiable()) {
            continue;
        }
        foreach ($rc->getInterfaces() as $interface) {
            if ("RFC5234\Core\Rule\RuleInterface" === $interface->getName()) {
                $ruleInterfaceClasses[] = $className;
                continue 2;
            }
        }
    } catch (\Throwable $exception) {
        continue;
    }
}

$dir = new \DirectoryIterator(__DIR__ . '/../src/Rule');

/** @var SplFileInfo $fileInfo */
foreach ($dir as $fileInfo) {
    if ($fileInfo->isDot()) {
        continue;
    }
    $className = '\RFC5234\Rule\\' . $fileInfo->getBasename('.php');
    try {
        $rc = new \ReflectionClass($className);
        if (!$rc->isInstantiable()) {
            continue;
        }
        foreach ($rc->getInterfaces() as $interface) {
            if ("RFC5234\Core\Rule\RuleInterface" === $interface->getName()) {
                $ruleInterfaceClasses[] = $className;
                continue 2;
            }
        }
    } catch (\Throwable $exception) {
        continue;
    }
}

$generated = '';

foreach ($ruleInterfaceClasses as $class) {
    $fragments = explode('\\', $class);
    $className = $fragments[count($fragments) - 1];
    $generated .=  $className. ' - Regex definition with `' . RegexHelper::DELIMITER . '` as delimiter :' . "\n";
    $generated .=  RegexHelper::prepare($class::getPattern())->getRegex() . "\n\n";
}

echo $generated;
