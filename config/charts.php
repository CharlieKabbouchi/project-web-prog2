<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default library used in charts.
    |--------------------------------------------------------------------------
    |
    | This value is used as the default chart library used when creating
    | any chart in the command line. Feel free to modify it or set it up
    | while creating the chart to ignore this value.
    |
    */
    'default' => [
        'type' => 'bar', // Default chart type
        'library' => 'highcharts', // Default chart library
        'element_label' => 'Element', // Default label for chart elements
    ],

    /*
    |--------------------------------------------------------------------------
    | Chart libraries
    |--------------------------------------------------------------------------
    | Here you may define the settings for various chart libraries.
    */

    'libraries' => [
        'highcharts' => [
            'cdn' => true, // Use CDN to load the Highcharts library
            'options' => [], // Additional Highcharts options
        ],
        // Add more libraries if needed
    ],

    /*
    |--------------------------------------------------------------------------
    | Global settings for charts
    |--------------------------------------------------------------------------
    */

    'global' => [
        'responsive' => true, // Enable responsiveness for charts
    ],

    'default_library' => 'Chartjs',
];
