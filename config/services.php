<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '281202415620282',
        'client_secret' => '73d69d7e25271bb49e922841ee0d9709',
        'redirect' => 'http://localhost:8000/login/callback/facebook',
    ],

    'google' => [
        'client_id' => '400524927179-pqlos3je439cbg9balh8lh3mtiph4i0d.apps.googleusercontent.com',
        'client_secret' => 'Ns0jNXUE1IcVaiLCmmp4dSFM',
        'redirect' => 'http://localhost:8000/login/callback/google',
    ],

];
