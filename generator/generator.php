<?php

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
//    if ($class === "\RFC5234\Rule\Repetition") {
    if (true) {
        $generated .= $class . ' = ' . $class::getPattern() . "\n\n";
    }
}

echo $generated;
