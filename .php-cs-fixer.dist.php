<?php

$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap/cache')
    ->notPath('storage')
    ->notPath('vendor')
    ->notPath('_ide_helper.php')
    ->notPath('_ide_helper_models.php')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@PSR2' => true,
    '@Symfony' => true,
    'constant_case' => [
        'case' => 'lower',
    ],
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
    ],
    'single_class_element_per_statement' => [
        'elements' => ['property'],
    ],
])->setFinder($finder);
