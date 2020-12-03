<?php

return [
    'titles' => [
        'index' => 'Products Management',
        'create' => 'Product creation',
        'update' => 'Product update',
        'import' => 'Import product',
        'export' => 'Export product',
        'report' => 'Products report'
    ],
    'messages' => [
        'import' => ':count products have been imported successfully',
        'export' => 'The export of products started successfully'
    ],
    'error_messages' => [
        'name' => [
            'required' => 'Your product needs a name',
            'min' => 'The name must have at least 3 letters',
            'max' => 'Don\'t exceed 80 characters and keep calm'
        ],
        'description' => [
            'required' => 'The description is very important, don\'t forget it',
            'min' => 'Push yourself and get at least 10 characters',
            'max' => 'Don\'t tell me your life, maximum 1000 characters for the description'
        ],
        'category' => [
            'required' => 'No cheating, choose one of the 3 categories'
        ],
        'image' => [
            'image' => 'Verify that what you are uploading is an image'
        ],
        'price' => [
            'required' => 'Even if it\'s cheap, put a price on it',
            'digits_between' => 'The minimum price is 4 digits and the maximum is 9'
        ],
        'stock' => [
            'required' => 'Choose a stock quantity'
        ],
        'import_file' => [
            'required' => 'No file found to import',
            'file' => 'A valid file was not uploaded',
            'mimes' => 'The file does not have a valid extension'
        ]
    ],
    'reports_messages' => [
        'intro' => 'So far the following reports have been formulated based on the information collected from the products, such as the views, sales, and stocks of each one.',
        'most_viewed' => 'Among all the products it has been detected that the most viewed is <strong>:most_viewed</strong> with <strong>:views</strong> views.'
    ]
];
