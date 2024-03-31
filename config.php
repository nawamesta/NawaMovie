<?php
/**
 * Movos = The php Script for Landing Page Movies and TV Series
 *
 * @author Mas Zee <facebook.com/mas.zee.9619>
 * @copyright 2022 Nanosia.com
 * @link https://Nanosia.com
 * @license Reselling is prohibited, or can only be used alone
 * @version 1.0.0
 */


return [
    'tmdb_key' => '892b7c8469f251441be840cf2aeb9d74', // (optional) Replace with your own fire key
    'is_cache' => false, // false or true
    'cache_exp' => 1440, // seconds
    'default_lang' => 'en', // Available lang please check in dir /lang filename


    'max_limit_page_sitemap' => 5, // Specify the number of pages from the TMDB datasource (each page has 20 items)

    'block_id' => [], //ex: [12343, 456344, 56756, 234234]

    'split_offer' => [
        // defaults offer
        [
            'code_country' => [], // empty to all country
            'url_offer' => "//www.google.com/search?q=nanosia.com"
        ]
        // , [
        //     'code_country' => ['en', 'sg'],
        //     'url_offer' => "//www.google.com/search?q=nanosia.com"
        // ]
    ],
    'theme' => [
        'primary-color' => "#00A2E9",
        'button-tab-text-color' => "#000000",
        'bg-fake' => "#00A2E9",
        'color-fake' => "#000000"
    ]
];