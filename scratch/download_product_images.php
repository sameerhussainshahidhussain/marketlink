<?php

$images = [
    'spinach.jpg'      => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?w=600&auto=format&fit=crop&q=80',
    'tomatoes.jpg'     => 'https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=600&auto=format&fit=crop&q=80',
    'carrots.jpg'      => 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=600&auto=format&fit=crop&q=80',
    'broccoli.jpg'     => 'https://images.unsplash.com/photo-1459411621453-7b03977f4bfc?w=600&auto=format&fit=crop&q=80',
    'strawberries.jpg' => 'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?w=600&auto=format&fit=crop&q=80',
    'mangoes.jpg'      => 'https://images.unsplash.com/photo-1553279768-865429fa0078?w=600&auto=format&fit=crop&q=80',
    'milk.jpg'         => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=600&auto=format&fit=crop&q=80',
    'yogurt.jpg'       => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=600&auto=format&fit=crop&q=80',
    'honey-wild.jpg'   => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=600&auto=format&fit=crop&q=80',
    'honey-sidr.jpg'   => 'https://images.unsplash.com/photo-1558642452-9d2a7deb7f62?w=600&auto=format&fit=crop&q=80',
    'honey-acacia.jpg' => 'https://images.unsplash.com/photo-1471943311424-646960669fbc?w=600&auto=format&fit=crop&q=80',
    'mint.jpg'         => 'https://images.unsplash.com/photo-1628556270448-4d4e4148e1b1?w=600&auto=format&fit=crop&q=80',
    'coriander.jpg'    => 'https://images.unsplash.com/photo-1599940824399-b87987ceb72a?w=600&auto=format&fit=crop&q=80',
    'lavender.jpg'     => 'https://images.unsplash.com/photo-1528722828814-77b9b83aafb2?w=600&auto=format&fit=crop&q=80',
    'basil.jpg'        => 'https://images.unsplash.com/photo-1618164436241-4473940d1f5c?w=600&auto=format&fit=crop&q=80',
];

$dir1 = 'storage/app/public/products';
$dir2 = 'public/assets/images/products';

if (!is_dir($dir1)) mkdir($dir1, 0755, true);
if (!is_dir($dir2)) mkdir($dir2, 0755, true);

$ctx = stream_context_create([
    'http' => [
        'timeout' => 15,
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
    ]
]);

foreach ($images as $filename => $url) {
    echo "Downloading {$filename}... ";
    $data = @file_get_contents($url, false, $ctx);
    if ($data && strlen($data) > 1000) {
        file_put_contents("{$dir1}/{$filename}", $data);
        file_put_contents("{$dir2}/{$filename}", $data);
        echo "OK (" . round(strlen($data)/1024) . " KB)\n";
    } else {
        echo "FAILED\n";
    }
}

echo "All product images processed!\n";
