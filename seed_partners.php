$partners = [
    [
        'name' => 'ZTE',
        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60"><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-weight="900" font-size="40" fill="#00b4ff">ZTE</text></svg>'
    ],
    [
        'name' => 'Huawei',
        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60"><circle cx="40" cy="30" r="15" fill="#ed1c24"/><text x="40" y="30" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-weight="bold" font-size="12" fill="white">H</text><text x="65" y="30" dominant-baseline="middle" text-anchor="start" font-family="Arial, sans-serif" font-weight="900" font-size="30" fill="#1a1a1a" text-transform="uppercase">Huawei</text></svg>'
    ],
    [
        'name' => 'PT. YPTT',
        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60"><text x="50%" y="40%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-weight="900" font-size="24" fill="#0050a0">PT. YPTT</text><text x="50%" y="75%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-weight="bold" font-size="12" fill="#4d4d4d" text-transform="uppercase">Solutions Indonesia</text></svg>'
    ],
    [
        'name' => 'Telkomsel',
        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60"><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-weight="900" font-size="30" fill="#ed1c24" text-transform="uppercase">Telkomsel</text></svg>'
    ],
    [
        'name' => 'Telkominfra',
        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60"><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-weight="900" font-size="30" fill="#1a1a1a" text-transform="uppercase">Telkominfra</text></svg>'
    ],
    [
        'name' => 'XL Smart',
        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60"><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-weight="900" font-size="35" fill="#2e3192" font-style="italic">XL<tspan fill="#f7941d">SMART</tspan></text></svg>'
    ],
    [
        'name' => 'Indosat',
        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60"><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-weight="900" font-size="35" fill="#1a1a1a">INDOSAT</text></svg>'
    ]
];

foreach ($partners as $p) {
    $filename = strtolower(str_replace([' ', '.'], ['-', ''], $p['name'])) . '-' . time() . '.svg';
    $path = 'partners/' . $filename;
    
    \Illuminate\Support\Facades\Storage::disk('public')->put($path, $p['svg']);
    
    \App\Models\Partner::create([
        'name' => $p['name'],
        'logo' => $path,
        'link' => null
    ]);
}

echo "Seeded 7 partners successfully.\n";
