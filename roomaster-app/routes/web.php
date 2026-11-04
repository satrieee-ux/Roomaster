<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Helper data dummy (sementara, sebelum database)
|--------------------------------------------------------------------------
*/
$room = fn ($id, $title, $dept, $cap, $img) => [
    'id' => $id, 'title' => $title, 'department' => $dept,
    'capacity' => $cap, 'image' => 'images/rooms/'.$img, 'favorite' => false,
];
$SI  = 'Departemen Sistem Informasi';
$ITS = 'Departemen Sistem Informasi ITS';
$M   = 'Up to 50 Person (M)';

Route::redirect('/', '/menu-utama');

/*
|--------------------------------------------------------------------------
| Menu utama
|--------------------------------------------------------------------------
*/
Route::get('/menu-utama', function () {
    $upcoming = [
        'id' => 1, 'title' => 'SI-4202', 'date' => 'Today, 24 Oct 2023',
        'time' => '08.00-16.00 WIB', 'department' => 'Departemen Sistem Informasi',
        'image' => 'images/rooms/si-4202.jpg',
    ];

    $recent = [
        ['id' => 1, 'title' => 'SI-4202',  'department' => 'Departemen Sistem Informasi',                 'capacity' => 20, 'image' => 'images/rooms/class.jpg',   'favorite' => false],
        ['id' => 2, 'title' => 'IF-103',   'department' => 'Departemen Informatika',                      'capacity' => 20, 'image' => 'images/rooms/si-4202.jpg', 'favorite' => false],
        ['id' => 3, 'title' => 'PWK-201',  'department' => 'Departemen Perencanaan Wilayah dan Kota ITS', 'capacity' => 20, 'image' => 'images/rooms/si-4202.jpg', 'favorite' => false],
    ];

    $recommended = [
        ['id' => 1, 'title' => 'SI-4202', 'department' => 'Departemen Sistem Informasi', 'capacity' => 20, 'image' => 'images/rooms/si-4202.jpg', 'favorite' => false],
        ['id' => 1, 'title' => 'SI-4202', 'department' => 'Departemen Sistem Informasi', 'capacity' => 20, 'image' => 'images/rooms/si-4202.jpg', 'favorite' => false],
    ];

    return view('pages.menu_utama', compact('upcoming', 'recent', 'recommended'));
})->name('menu_utama');

/*
|--------------------------------------------------------------------------
| Rooms: All, SKPB, Departemen, Favorites
|--------------------------------------------------------------------------
*/
Route::prefix('rooms')->group(function () use ($room, $SI, $ITS, $M) {

    Route::get('/', fn () => view('pages.rooms', [
        'frequent' => [
            $room(1, 'Ruang Dekanat', $SI,  '20 Orang', 'hall.jpg'),
            $room(2, 'SI-2209',       $ITS, $M,         'class.jpg'),
            $room(3, 'SI-4202',       $SI,  '20 Orang', 'blue-class.jpg'),
        ],
        'recommended' => [
            $room(4, 'ID-1103',     $SI, '20 Orang', 'building.jpg'),
            $room(5, 'SI-Studprog', $SI, '20 Orang', 'computer-lab.jpg'),
        ],
    ]))->name('rooms');

    Route::get('/skpb', fn () => view('pages.rooms_skpb', [
        'tw2' => [
            $room(1, 'SI-4202', $ITS, $M,         'hall.jpg'),
            $room(2, 'SI-4202', $ITS, $M,         'class.jpg'),
            $room(3, 'SI-4101', $SI,  '20 Orang', 'blue-class.jpg'),
        ],
        'upbg' => [
            $room(4, 'SI-4202',       $ITS, $M,         'class.jpg'),
            $room(5, 'SI-4202',       $ITS, $M,         'si-4202.jpg'),
            $room(6, 'SI-Smartclass', $SI,  '20 Orang', 'blue-class.jpg'),
        ],
        'recommended' => [
            $room(7, 'SI-4202', $SI, '20 Orang', 'building.jpg'),
            $room(8, 'SI-4202', $SI, '20 Orang', 'computer-lab.jpg'),
        ],
    ]))->name('rooms.skpb');

    Route::get('/departemen', fn () => view('pages.rooms_departemen', [
        'fteic' => [
            $room(1, 'SI-4202', $SI,  '20 Orang', 'hall.jpg'),
            $room(2, 'SI-4202', $ITS, $M,         'class.jpg'),
            $room(3, 'SI-4202', $SI,  '20 Orang', 'blue-class.jpg'),
        ],
        'ftirs' => [
            $room(4, 'SI-4202', $ITS, $M,         'class.jpg'),
            $room(5, 'SI-4202', $ITS, $M,         'si-4202.jpg'),
            $room(6, 'SI-4202', $SI,  '20 Orang', 'si-4202.jpg'),
        ],
        'recommended' => [
            $room(7, 'SI-4202', $ITS, $M,         'building.jpg'),
            $room(8, 'SI-4202', $SI,  '20 Orang', 'computer-lab.jpg'),
        ],
    ]))->name('rooms.departemen');

    Route::get('/favorit', fn () => view('pages.rooms_fav', [
        'favorites' => [
            $room(1, 'SI-4202', $ITS, $M,         'building.jpg'),
            $room(2, 'SI-4202', $SI,  '20 Orang', 'computer-lab.jpg'),
        ],
    ]))->name('rooms.favorit');
});
