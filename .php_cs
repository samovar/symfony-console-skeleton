<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['build', 'vendor'])
;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@DoctrineAnnotation' => true,
        '@PHP71Migration:risky' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'braces' => [
            'allow_single_line_closure' => true,
        ],
        'declare_strict_types' => true,
        'modernize_types_casting' => true,
        'no_extra_consecutive_blank_lines' => [
            'break',
            'continue',
            'curly_brace_block',
            'extra',
            'parenthesis_brace_block',
            'return',
            'square_brace_block',
            'throw',
            'use',
        ],
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'psr4' => true,
        'semicolon_after_instruction' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'ternary_to_null_coalescing' => true,
    ])
    ->setFinder($finder)
;
