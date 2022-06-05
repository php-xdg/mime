<?php

$finder = \PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
;

$config = new \PhpCsFixer\Config();

return $config
    ->setCacheFile(__DIR__ . '/tools/.php-cs-fixer.cache')
    ->setRules([
        '@PSR12' => true,
        'blank_line_after_opening_tag' => false,
        'function_declaration' => [
            'closure_function_spacing' => 'none',
        ],
        'native_function_invocation' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
