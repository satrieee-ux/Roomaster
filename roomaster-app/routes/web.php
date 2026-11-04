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

$bk = fn ($id, $title, $status, $date, $time, $dept, $img) => [
    'id' => $id, 'title' => $title, 'status' => $status, 'date' => $date,
    'time' => $time, 'department' => $dept, 'image' => 'images/rooms/'.$img,
];

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

/*
|--------------------------------------------------------------------------
| Bookings: All, Active, Approved, Pending
|--------------------------------------------------------------------------
*/
Route::prefix('bookings')->group(function () use ($bk, $SI, $ITS) {

    Route::get('/', fn () => view('pages.bookings', ['active' => 0, 'bookings' => [
        $bk(1,  'SI-4202', 'completed', '20 June 2026', '08:00 - 10:00 WIB', $ITS, 'computer-lab.jpg'),
        $bk(2,  'IF-103',  'completed', '21 June 2026', '13:00 - 15:00 WIB', 'Departemen Teknik Informatika ITS', 'blue-class.jpg'),
        $bk(3,  'SI-4202', 'draft',     '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'hall.jpg'),
        $bk(4,  'SI-4202', 'pending',   '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'building.jpg'),
        $bk(5,  'SI-4202', 'approved',  '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'building.jpg'),
        $bk(6,  'SI-4202', 'rejected',  '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'building.jpg'),
        $bk(7,  'SI-4202', 'approved',  '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'building.jpg'),
        $bk(8,  'SI-4202', 'completed', '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'building.jpg'),
    ]]))->name('bookings');

    Route::get('/active', fn () => view('pages.bookings', ['active' => 1, 'bookings' => [
        $bk(11, 'PWK-201',  'approved', '22 June 2026', '09:00 - 11:00 WIB', 'Departemen Perencanaan Wilayah dan Kota ITS', 'class.jpg'),
        $bk(12, 'ELKA-301', 'approved', '23 June 2026', '08:00 - 12:00 WIB', 'Departemen Teknik Elektro ITS', 'computer-lab.jpg'),
        $bk(13, 'SI-4202',  'approved', '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'blue-class.jpg'),
    ]]))->name('bookings.active');

    Route::get('/approved', fn () => view('pages.bookings', ['active' => 2, 'bookings' => [
        $bk(21, 'MS-105',  'draft',           '24 June 2026', '15:00 - 17:00 WIB', 'Departemen Teknik Mesin ITS', 'class.jpg'),
        $bk(22, 'SI-3201', 'action_required', '25 June 2026', '10:00 - 12:00 WIB', $ITS, 'blue-class.jpg'),
        $bk(23, 'SI-4202', 'action_required', '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'computer-lab.jpg'),
        $bk(24, 'SI-4202', 'pending',         '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'building.jpg'),
        $bk(25, 'SI-4202', 'pending',         '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'building.jpg'),
    ]]))->name('bookings.approved');

    Route::get('/pending', fn () => view('pages.bookings', ['active' => 3, 'bookings' => [
        $bk(31, 'IF-204',   'completed', '26 June 2026', '14:00 - 16:00 WIB', 'Departemen Teknik Informatika ITS', 'hall.jpg'),
        $bk(32, 'ELKA-210', 'completed', '27 June 2026', '09:00 - 11:00 WIB', 'Departemen Teknik Elektro ITS', 'computer-lab.jpg'),
        $bk(33, 'SI-4202',  'completed', '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'blue-class.jpg'),
        $bk(34, 'SI-4202',  'rejected',  '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'building.jpg'),
        $bk(35, 'SI-4202',  'rejected',  '24 Okt 2023',  '08.00–16.00 WIB',   $SI, 'building.jpg'),
    ]]))->name('bookings.pending');
});

/*
|--------------------------------------------------------------------------
| Booking Summary
| Harus SETELAH group /bookings agar /bookings/active dll. tidak tertangkap {id}
|--------------------------------------------------------------------------
*/
Route::get('/bookings/{id}', fn ($id) => view('pages.bookings_summary', ['booking' => [
    'code'     => 'R4992A7',
    'status'   => 'approved',
    'updated'  => '2h ago',
    'room'     => 'SI-4202',
    'location' => 'Gedung 4 Sistem Informasi, 2nd Floor',
    'capacity' => '20 Persons',
    'facilities' => [
        ['icon' => 'air-vent', 'label' => 'Full AC'],
        ['icon' => 'wifi',     'label' => '5G Wifi'],
    ],
    'date' => '6 July 2026',
    'time' => '09.00 - 12.00 (3 Hours)',
    'activity' => [
        ['icon' => 'check',          'done' => true,  'title' => 'Report Submitted', 'desc' => 'Just Now'],
        ['icon' => 'hourglass',      'done' => true,  'title' => 'Review Done',      'desc' => 'Approved by TU Admin.'],
        ['icon' => 'calendar-check', 'done' => false, 'title' => 'Confirmed',        'desc' => 'Check-in to your room 30 Minute before the booking time.'],
    ],
    'activity_name' => 'Rapat Pangsang IM #07',
    'description'   => 'Pencerdasan fullday untuk anak IM covering leadership skills and upcoming academic year planning. Expected attendance is full capacity.',
    'documents' => [
        ['name' => 'KTP_Scan_JohnDoe.pdf', 'size' => '1.2 MB'],
        ['name' => 'Surat Peminjaman.pdf', 'size' => '1.2 MB'],
    ],
]]))->whereNumber('id')->name('bookings.show');
