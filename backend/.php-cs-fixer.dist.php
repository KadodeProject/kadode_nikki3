<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([
        'app',
        'config',
        'database',
        'routes',
        'tests',
    ]);

$config = new PhpCsFixer\Config();

/*
 * 全体の設定一覧→https://mlocati.github.io/php-cs-fixer-configurator
 * まとめて入った@系のやつ→https://cs.symfony.com/doc/ruleSets
 */
return $config
    ->setRiskyAllowed(true)
    ->setRules([
        /**
         * 追加ルールセット
         */
        // @PhpCsFixerの中にPERとSymfonyが入っており、その中に最新のコーディング規約が入っている→結果的にPSR12,Symfonyが適用される
        '@PhpCsFixer' => true, // https://cs.symfony.com/doc/ruleSets/PhpCsFixer.html
        '@PhpCsFixer:risky' => true, // https://cs.symfony.com/doc/ruleSets/PhpCsFixerRisky.html
        '@PSR12' => true, // https://cs.symfony.com/doc/ruleSets/PSR12.html
        '@PSR12:risky' => true, // https://cs.symfony.com/doc/ruleSets/PSR12Risky.html
        // バージョンアップで変わったものや書き方の補正用(ここはPHPのバージョンアップに併せてより上にしていく)
        // 例えば@php81はphp80,74などより古いバージョンのものを含んでいる
        '@PHP80Migration:risky' => true, // https://cs.symfony.com/doc/ruleSets/PHP80MigrationRisky.html
        '@PHP82Migration' => true, // https://cs.symfony.com/doc/ruleSets/PHP82Migration.html
        '@PHPUnit100Migration:risky' => true, // https://cs.symfony.com/doc/ruleSets/PHPUnit100MigrationRisky.html


        /**
         * 追加ルール
         */
        'declare_strict_types' => true, // https://mlocati.github.io/php-cs-fixer-configurator/#version:3.12|fixer:declare_strict_types

        /*
         * ルールセットのルールを上書き
         */
        'single_line_comment_style' => [
            'comment_types' => ['hash'], // #を//に変えるものはそのまま
        ],
        'phpdoc_to_comment' => false, // PHPDocやコメントで /** */となっている部分を/* */にしたり//にしたりしないようにする(PHPStanでの型注釈が効かなくなるため)。 **ignored_typesオプションでの対応では一部のコメントが対応できないため、オプションでの指定でなくfalseにする**
        'phpdoc_summary' => false, // コメントのGET /hoge を GET /hoge. にされるのでfalseに
        'phpdoc_add_missing_param_annotation' => false, // 勝手に@param mixedを付けるのは意味が薄いのでfalseに

        'types_spaces' => false, // int|bool などの|の前後にスペースを入れる(PHPDocでなくPHP本体の型注釈を対象)
        'multiline_whitespace_before_semicolons' => false, // セミコロンだけの行にするものを防ぐ
        'phpdoc_types_order' => false, // 型の順番を自動で変えないようにする、**このルールを適応するとPHPStanのarray型の文字列が復元不可能な壊れ方をするので無効化**
        'increment_style' => ['style' => 'post'], // ++$iでなく$i++になるようにする
        'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false], // $hoge === 1 を 1 === $hoge にするヨーダ記法は可読性が下がるためfalse
        'global_namespace_import' => [
            'import_classes' => true, // 1階層useも残す インラインで\Closureとするのではなく、use Closureのような形にする
            'import_constants' => true,
            'import_functions' => true,
        ],
        'function_declaration' => [
            'closure_fn_spacing' => 'none', // fn ()でなく fn() と書くようにする
        ],
        'cast_spaces' => [
            'space' => 'none', // (int) $b; でなく (int)$b; と書くようにする
        ],
        'return_assignment' => false, // 「returnでしか使ってない変数を削除する」をしない。returnでしか使わない変数を宣言している箇所ではPHPDocで型注釈をしているので、これを消すとPHPStanでの型注釈が効かなくなるため
        'concat_space' => [
            'spacing' => 'none', // 文字列結合の.の前後にスペースを入れない 例 'kadode' . 'nikki'
        ],
        'binary_operator_spaces' => ['operators' => ['=>' => 'align_single_space_minimal_by_scope'],], //⇒オペレータの隙間を見やすくする

        'php_unit_internal_class' => true, // @internalをテストクラスに自動的に付ける
        'php_unit_test_class_requires_covers' => true, // @oversNothingをテストクラスに自動的に付ける

        'native_function_invocation' => false, // use functionを利用したオペコードコンパイル時の最適化は誤差レベルなので見た目を優先してfalseにする
        'php_unit_test_case_static_method_calls' => [
            'call_type' => 'this', // PHPUnit内でのメソッドやメンバ変数の呼び出しでは$this->を用いる
        ],
        'php_unit_strict' => false, // 連想配列の比較で順序が気にならないように意図的にassertSameでなくassertEqualsを使っている箇所もあるため、自動置換はしないようにする

    ])
    // インデントのスペース4つ適応は@psr12(@psr2)のRuleSets`'indentation_type' => true,`に含まれる
    ->setFinder($finder);
