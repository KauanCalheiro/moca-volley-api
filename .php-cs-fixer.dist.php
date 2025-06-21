<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/app')           // Inclui a pasta app
    ->in(__DIR__ . '/routes')        // Inclui as rotas
    ->in(__DIR__ . '/tests')         // Inclui os testes
    ->in(__DIR__ . '/database')      // Inclui migrations e seeds
    ->name('*.php')                  // Apenas arquivos PHP
    ->notName('*.blade.php')         // Exclui views Blade
    ->exclude('storage')             // Exclui storage
    ->exclude('vendor')              // Exclui vendor
    ->append([__FILE__]);            // Inclui o próprio arquivo de configuração

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)          // Permite regras que podem modificar a lógica em alguns casos
    ->setRules([
        // ❌ Desativa PSR-12 (que força chaves em nova linha nas classes, por exemplo)
        '@PSR12' => false,

        // 🔧 Define estilo de chaves (K&R)
        'braces' => [
            'position_after_control_structures'           => 'same', // if, for, while → chaves na mesma linha
            'position_after_functions_and_oop_constructs' => 'same', // métodos/funções → chaves na mesma linha
            'allow_single_line_closure'                   => false,  // não permite closures em linha única
        ],

        // 📦 Regras de definição de classes
        'class_definition' => [
            'single_line' => false, // class { ... } em uma linha só? Não.
        ],

        // 📚 Usa sintaxe curta de arrays: [] em vez de array()
        'array_syntax' => ['syntax' => 'short'],

        // ➕ Alinha operadores binários com espaços mínimos
        'binary_operator_spaces' => ['default' => 'align_single_space_minimal'],

        // 🧹 Remove imports não utilizados (use ...)
        'no_unused_imports' => true,

        // 🚫 Remove espaços em branco no fim das linhas
        'no_trailing_whitespace' => true,

        // ⬇️ Adiciona quebra de linha após tag de abertura <?php
        'linebreak_after_opening_tag' => true,

        // 🧼 Remove linhas em branco desnecessárias em blocos, throws, use, etc.
        'no_extra_blank_lines' => [
            'tokens' => [
                'curly_brace_block',       // dentro de {}
                'extra',                   // extras em geral
                'parenthesis_brace_block', // dentro de ()
                'square_brace_block',      // dentro de []
                'throw',                   // antes/depois de throw
                'use',                     // entre imports
            ],
        ],
    ])
    ->setFinder($finder);
