<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$client = Gemini::client(trim(env('GEMINI_API_KEY')));

try {
    $response = $client->models()->list();
    foreach ($response->models as $model) {
        echo "Available model: " . $model->name . "\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n\n";
}
