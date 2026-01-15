<?php

// Reference: https://cs.symfony.com

return (new PhpCsFixer\Config())
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP70Migration' => true,
        '@PHP71Migration' => true,
        '@PSR2' => true,
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'increment_style' => ['style' => 'post'],
        'multiline_whitespace_before_semicolons' => true,
        'array_indentation' => true,
        'not_operator_with_successor_space' => true,
        'semicolon_after_instruction' => false,
        'strict_comparison' => true,
        'yoda_style' => false,
        'single_line_throw' => false,
        'php_unit_method_casing' => ['case' => 'snake_case'],
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => true],
        'no_empty_comment' => false,
    ]);
