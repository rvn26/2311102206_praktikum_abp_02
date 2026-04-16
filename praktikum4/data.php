<?php

header('Content-Type: application/json');


$data = [
    [
        'nama' => 'Budi',
        'pekerjaan' => 'Web Developer',
        'lokasi' => 'Jakarta'
    ],
    [
        'nama' => 'Siti',
        'pekerjaan' => 'Data Scientist',
        'lokasi' => 'Bandung'
    ],
    [
        'nama' => 'Andi',
        'pekerjaan' => 'Mobile Developer',
        'lokasi' => 'Surabaya'
    ]
];

echo json_encode($data);
