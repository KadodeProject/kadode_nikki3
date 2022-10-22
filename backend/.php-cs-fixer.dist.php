<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

$config = new PhpCsFixer\Config();

/**
 * 全体の設定一覧→https://mlocati.github.io/php-cs-fixer-configurator
 * まとめて入った@系のやつ→https://cs.symfony.com/doc/ruleSets
 */
return $config
    ->setRiskyAllowed(true)
    ->setRules([
        //@PhpCsFixerの中にPERとSymfonyが入っており、その中に最新のコーディング規約が入っている→結果的にPSR12,Symfonyが適用される
        '@PhpCsFixer' => true, //https://cs.symfony.com/doc/ruleSets/PhpCsFixer.html
        '@PhpCsFixer:risky' => true, //https://cs.symfony.com/doc/ruleSets/PhpCsFixerRisky.html
        //バージョンアップで変わったものや書き方の補正用(ここはPHPのバージョンアップに併せてより上にしていく)
        //例えば@php81はphp80,74などより古いバージョンのものを含んでいる
        '@PHP81Migration' => true, //https://cs.symfony.com/doc/ruleSets/PHP81Migration.html
        '@PHP80Migration:risky' => true, //https://cs.symfony.com/doc/ruleSets/PHP80MigrationRisky.html
        //'@PHPUnit84Migration:risky' => true, //https://cs.symfony.com/doc/ruleSets/PHPUnit84MigrationRisky.html

        //上記で適用されたもの以外や、上記でされると困るものを下記に書く
        'multiline_whitespace_before_semicolons' => true, //メソッドチェーンの末尾のセミコロンを改行する設定を上書きする https://mlocati.github.io/php-cs-fixer-configurator/#version:3.12|configurator|fixer:multiline_whitespace_before_semicolons
    ])
    ->setFinder($finder);
