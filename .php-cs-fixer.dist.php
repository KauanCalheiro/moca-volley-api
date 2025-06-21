<?php

$finder = PhpCsFixer\Finder::create()
    // Inclui as principais pastas do projeto
    ->in(__DIR__ . '/app')           // Código da aplicação
    ->in(__DIR__ . '/routes')        // Rotas
    ->in(__DIR__ . '/tests')         // Testes automatizados
    ->in(__DIR__ . '/database')      // Migrations e seeders
    ->name('*.php')                  // Apenas arquivos PHP
    ->notName('*.blade.php')         // Exclui views Blade
    ->exclude('storage')             // Ignora storage
    ->exclude('vendor')              // Ignora vendor
    ->append([__FILE__]);            // Inclui o próprio arquivo de configuração

return (new PhpCsFixer\Config())
    ->setRules([
        // ✅ Segue o padrão PSR-12 como base
        '@PSR12' => true,

        // ✅ Sintaxe curta de arrays ([])
        'array_syntax' => ['syntax' => 'short'],

        // ✅ Alinhamento mínimo entre operadores binários (ex: =, =>, etc)
        'binary_operator_spaces' => ['default' => 'align_single_space_minimal'],

        // ✅ Padrão de chaves (K&R Style)
        'braces' => [
            'position_after_control_structures'           => 'same',
            'position_after_functions_and_oop_constructs' => 'same',
            'allow_single_line_closure'                   => false,
        ],

        // ✅ Espaçamento consistente após casts: (int) $var
        'cast_spaces' => ['space' => 'single'],

        // ✅ Espaço ao redor de concatenação de strings: 'Hello' . 'World'
        'concat_space' => ['spacing' => 'one'],

        // ✅ Indentação consistente (tabs ou espaços, conforme projeto)
        'indentation_type' => true,

        // ✅ Remove imports não utilizados
        'no_unused_imports' => true,

        // ✅ Remove espaços em branco no final das linhas
        'no_trailing_whitespace' => true,

        // ✅ Quebra de linha logo após a tag de abertura <?php
        'linebreak_after_opening_tag' => true,

        // ✅ Remove linhas extras desnecessárias dentro de blocos, throws, use, etc.
        'no_extra_blank_lines' => [
            'tokens' => [
                'curly_brace_block',
                'extra',
                'parenthesis_brace_block',
                'square_brace_block',
                'throw',
                'use',
            ],
        ],

        // ✅ Sempre usar aspas simples quando possível
        'single_quote' => true,

        // ✅ Adiciona vírgula no final de arrays e argumentos multiline
        'trailing_comma_in_multiline' => ['elements' => ['arrays', 'arguments']],

        // ✅ Ordena os imports alfabeticamente, agrupando por tipo (classe, função, constante)
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order'  => ['class', 'function', 'const'],
        ],

        // ✅ Não adicionar linha em branco entre grupos de imports (substitui a antiga no_blank_lines_between_imports)
        'blank_line_between_import_groups' => false,

        // ✅ Garante espaço após o operador lógico "not" (!)
        'not_operator_with_successor_space' => true,

        // ✅ Em métodos com múltiplos argumentos multiline, força o estilo fully-multiline
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],

        // ✅ Sem espaço antes da declaração de tipo de retorno
        'return_type_declaration' => ['space_before' => 'none'],

        // ✅ Remove PHPDocs redundantes como "@return void" quando desnecessário
        'phpdoc_no_empty_return'     => true,
        'no_superfluous_phpdoc_tags' => true,
    ])
    ->setFinder($finder);
