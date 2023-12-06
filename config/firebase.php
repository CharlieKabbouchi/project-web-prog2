<?php

return [
    'apiKey' => env('FIREBASE_API_KEY', 'AIzaSyCBrjUK5S2RlK8DqJ2tXWsMkCH4aRLinAE'),
    'authDomain' => env('FIREBASE_AUTH_DOMAIN', 'web2projectsis.firebaseapp.com'),
    'projectId' => env('FIREBASE_PROJECT_ID', 'web2projectsis'),
    'storageBucket' => env('FIREBASE_STORAGE_BUCKET', 'web2projectsis.appspot.com'),
    'messagingSenderId' => env('FIREBASE_MESSAGING_SENDER_ID', '7901082387'),
    'appId' => env('FIREBASE_APP_ID', '1:7901082387:web:3a99b9369abe995df260e6'),

    'database_url' => env('FIREBASE_DATABASE_URL', 'https://web2projectsis-default-rtdb.firebaseio.com'),

    'serviceAccount' => [
        'file' => env('FIREBASE_JSON_KEY_PATH', 'config/web2projectsis-firebase-adminsdk-s1jmb-68b4932de8.json'),
        'key' => null,
    ],

];
?>