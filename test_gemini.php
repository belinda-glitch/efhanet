<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$client = Gemini::client(trim(env('GEMINI_API_KEY')));

$modelsToTest = [
    'gemini-3.1-flash',
    'gemini-3.1-pro',
    'gemini-2.5-flash',
    'gemini-2.5-pro'
];

foreach ($modelsToTest as $model) {
    try {
        echo "Testing model: $model\n";
        $result = $client->generativeModel($model)->generateContent('test');
        echo "SUCCESS: " . $model . "\n";
        break; // found one that works
    } catch (\Exception $e) {
        echo "ERROR ($model): " . $e->getMessage() . "\n\n";
    }
}
