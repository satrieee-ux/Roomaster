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

/*
|--------------------------------------------------------------------------
| Awal: splash, login, sign up, myITS SSO
|--------------------------------------------------------------------------
*/
Route::view('/', 'pages.splash')->name('splash');
Route::view('/login', 'pages.login')->name('login');
Route::view('/signup', 'pages.signup')->name('signup');
Route::post('/login', fn () => redirect('/menu-utama'));
Route::post('/signup', fn () => redirect('/menu-utama'));

Route::get('/login-its/accounts', fn () => view('pages.pilih_akun_its', ['accounts' => [
    ['type' => 'student', 'email' => '5026241065@student.its.ac.id', 'label' => 'Student Account'],
    ['type' => 'staff',   'email' => 'musaddad@sarpras.its.ac.id',   'label' => 'Education Personnel Account'],
    ['type' => 'staff',   'email' => 'azura@tu.its.ac.id',           'label' => 'Education Personnel Account'],
]]))->name('its.accounts');
Route::view('/login-its/email', 'pages.email_its')->name('its.email');
Route::get('/login-its/password', fn () => view('pages.password_its', [
    'email' => request('email', '5026241065@student.its.ac.id'),
]))->name('its.password');
Route::post('/login-its', fn () => redirect('/menu-utama'));

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
| QReport: scan, form, berhasil, ringkasan, riwayat
|--------------------------------------------------------------------------
*/
Route::view('/qreporting', 'pages.Qreporting')->name('qreporting');

Route::get('/qreporting/report', fn () => view('pages.laporkerusakan', [
    'location' => ['room' => 'Room 4202 - Smart Class', 'address' => 'Sistem Informasi ITS, Sukolilo, Surabaya'],
    'categories' => [
        ['icon' => 'air-vent',  'label' => 'Air Conditioning'],
        ['icon' => 'projector', 'label' => 'Projector'],
        ['icon' => 'lightbulb', 'label' => 'Lighting'],
        ['icon' => 'armchair',  'label' => 'Desk/Seating'],
    ],
]))->name('qreporting.report');

Route::view('/qreporting/submitted', 'pages.laporkerusakan_submitted')->name('qreporting.submitted');

Route::get('/qreporting/history', function () {
    $all = [
        ['id' => 1, 'title' => 'SI-4202', 'date' => '24 Okt 2023', 'department' => 'Departemen Sistem Informasi',
         'status' => 'pending', 'issues' => [['icon' => 'air-vent', 'label' => 'Faulty AC'], ['icon' => 'wifi', 'label' => 'Poor Connection']]],
        ['id' => 2, 'title' => 'SI-4202', 'date' => '24 Okt 2023', 'department' => 'Departemen Sistem Informasi',
         'status' => 'draft', 'issues' => [['icon' => 'air-vent', 'label' => 'Faulty AC'], ['icon' => 'wifi', 'label' => 'Poor Connection']]],
    ];
    $filter = request('filter', 'all');
    $active = ['all' => 0, 'active' => 1, 'approved' => 2, 'pending' => 3][$filter] ?? 0;
    $reports = match ($filter) {
        'pending'  => array_values(array_filter($all, fn ($r) => $r['status'] === 'pending')),
        'approved' => array_values(array_filter($all, fn ($r) => $r['status'] === 'approved')),
        'active'   => array_values(array_filter($all, fn ($r) => in_array($r['status'], ['pending', 'draft']))),
        default    => $all,
    };
    return view('pages.riwayatlaporan', compact('reports', 'active'));
})->name('qreporting.history');

Route::get('/qreporting/summary/{id}', fn ($id) => view('pages.ringkasanlaporan', ['report' => [
    'code' => 'R4992A7', 'status' => 'pending', 'updated' => '1 mins ago',
    'room' => 'SI-4202', 'location' => 'Gedung 4 Sistem Informasi, 2nd Floor', 'date' => '8 July 2026',
    'issues' => [['icon' => 'air-vent', 'label' => 'Faulty AC'], ['icon' => 'wifi', 'label' => 'Poor Connection']],
    'description' => "The air conditioning unit in the north- east corner of the room is making a loud grinding noise and leaking water onto the carpet. The thermostat interface is also unresponsive, showing an error code 'E-42'. Maintenance is requested urgently as this is a computer lab.",
    'evidence' => ['images/rooms/building.jpg', 'images/rooms/building.jpg'],
]]))->whereNumber('id')->name('qreporting.summary');

/*
|--------------------------------------------------------------------------
| Searching: pencarian & hasil
|--------------------------------------------------------------------------
*/
Route::get('/search', fn () => view('pages.melakukan_search', [
    'recent' => [
        $room(1, 'ELKA-301', 'Departemen Teknik Elektro ITS', 'Up to 250 Person (XL)', 'computer-lab.jpg'),
        $room(2, 'MS-105',   'Departemen Teknik Mesin ITS',    'Up to 50 Person (M)',   'class.jpg'),
    ],
    'forYou' => [
        $room(3, 'SI-4202',  $ITS,                                          'Up to 50 Person (M)',   'building.jpg'),
        $room(4, 'IF-103',   'Departemen Teknik Informatika ITS',           'Up to 100 Person (L)',  'hall.jpg'),
        $room(5, 'PWK-201',  'Departemen Perencanaan Wilayah dan Kota ITS', 'Up to 20 Person (S)',   'blue-class.jpg'),
        $room(6, 'ELKA-301', 'Departemen Teknik Elektro ITS',               'Up to 250 Person (XL)', 'building.jpg'),
        $room(7, 'MS-105',   'Departemen Teknik Mesin ITS',                 'Up to 50 Person (M)',   'building.jpg'),
        $room(8, 'SI-3201',  $ITS,                                          'Up to 20 Person (S)',   'building.jpg'),
    ],
]))->name('search');

Route::get('/search/results', fn () => view('pages.melihat_hasil_search', [
    'filters' => [
        ['icon' => 'users', 'label' => '50-99'],
        ['label' => 'Departemen'],
        ['icon' => 'air-vent'],
        ['icon' => 'projector'],
        ['icon' => 'x', 'href' => url('/search')],
    ],
    'results' => [
        $room(1, 'SI-3201', $ITS, 'Up to 20 Person (S)', 'computer-lab.jpg'),
        $room(2, 'IF-204',  'Departemen Teknik Informatika ITS', 'Up to 100 Person (L)', 'blue-class.jpg'),
    ],
    'more' => [
        $room(3, 'ELKA-210', 'Departemen Teknik Elektro ITS', 'Up to 50 Person (M)', 'building.jpg'),
        $room(4, 'PWK-305',  'Departemen Perencanaan Wilayah dan Kota ITS', 'Up to 250 Person (XL)', 'building.jpg'),
    ],
]))->name('search.results');

/*
|--------------------------------------------------------------------------
| Check-In & Check-Out
|--------------------------------------------------------------------------
*/
Route::get('/checkin/{id}', fn ($id) => view('pages.checkin', ['booking' => [
    'id' => $id, 'guest' => 'Fauzan Azura', 'room' => 'SI-4202',
    'date' => 'Jun 7, 2026', 'reservation' => 'RES-99831A',
]]))->whereNumber('id')->name('checkin');

Route::get('/checkin/{id}/success', fn ($id) => view('pages.berhasilcheckin'))
    ->whereNumber('id')->name('checkin.success');

Route::get('/checkout/{id}', fn ($id) => view('pages.checkout', [
    'id' => $id,
    'checklist' => [
        'Trash bins emptied', 'All surfaces wiped down', 'Floors swept and vacuumed',
        'Personal belongings removed', 'Lights and electronics turned off',
    ],
]))->whereNumber('id')->name('checkout');

Route::get('/checkout/{id}/success', fn ($id) => view('pages.berhasilcheckout'))
    ->whereNumber('id')->name('checkout.success');

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
| Room Detail: About & Reviews (setelah group /rooms agar tidak bentrok dengan {id})
|--------------------------------------------------------------------------
*/
$roomDetail = fn ($id, $tab, $reviews) => view('pages.room_detail', [
    'tab' => $tab,
    'room' => [
        'id' => $id, 'title' => 'SI-4202', 'department' => 'Departemen Sistem Informasi ITS',
        'rating' => '4.5', 'review_count' => 67,
        'address' => 'Kampus ITS, Keputih, Kec. Sukolilo, Surabaya, Jawa Timur 60117',
        'image' => 'images/rooms/blue-class.jpg',
        'gallery' => [
            'images/rooms/computer-lab.jpg', 'images/rooms/class.jpg',
            'images/rooms/building.jpg', 'images/rooms/hall.jpg',
        ],
        'more' => 10,
        'facilities' => [
            ['icon' => 'users',    'label' => '20 Orang'],
            ['icon' => 'air-vent', 'label' => 'Full AC'],
            ['icon' => 'wifi',     'label' => 'WI-FI 5G'],
        ],
        'description' => 'Ruang rapat representatif yang dilengkapi dengan fasilitas presentasi modern. Cocok untuk pertemuan tingkat eksekutif, presentasi proyek berskala besar, dan seminar internal. Ruangan memiliki pencahayaan alami yang baik dengan tirai otomatis.',
        'cs' => ['name' => 'CS Name', 'response' => '~2 Hours'],
    ],
    'reviews' => $reviews,
]);

$reviewData = [
    'top' => [
        ['name' => 'Ahmad Fauzan',   'date' => '20 June 2026', 'rating' => 5, 'comment' => 'Ruangan nyaman dan AC dingin.'],
        ['name' => 'Dinda Maharani', 'date' => '21 June 2026', 'rating' => 5, 'comment' => 'Cocok untuk seminar skala menengah.'],
        ['name' => 'Rizky Pratama',  'date' => '22 June 2026', 'rating' => 5, 'comment' => 'Cukup tenang untuk diskusi kelompok.'],
    ],
    'all' => [
        ['name' => 'Nabila Putri',    'date' => '23 June 2026', 'rating' => 5, 'comment' => 'Aula luas dengan fasilitas lengkap.'],
        ['name' => 'Bagas Aditya',    'date' => '24 June 2026', 'rating' => 5, 'comment' => 'Ruangan bersih dan tertata rapi.'],
        ['name' => 'CS Name',         'date' => '6 July 2067',  'rating' => 5, 'comment' => '“This room is so goated bro frfr”'],
        ['name' => 'Intan Permata',   'date' => '25 June 2026', 'rating' => 5, 'comment' => 'Sangat cocok untuk rapat tim kecil.'],
        ['name' => 'Fajar Ramadhan',  'date' => '26 June 2026', 'rating' => 5, 'comment' => 'Jaringan internet stabil selama acara.'],
        ['name' => 'Salsabila Rahma', 'date' => '27 June 2026', 'rating' => 5, 'comment' => 'Pencahayaan ruangan cukup baik.'],
    ],
];

Route::get('/rooms/{id}', fn ($id) => $roomDetail($id, 0, $reviewData))
    ->whereNumber('id')->name('rooms.show');
Route::get('/rooms/{id}/reviews', fn ($id) => $roomDetail($id, 1, $reviewData))
    ->whereNumber('id')->name('rooms.reviews');

/*
|--------------------------------------------------------------------------
| Booking flow: formulir → tanggal → waktu → dokumen → ringkasan → berhasil
| (/booking/{id}, tunggal; beda dengan /bookings = daftar riwayat)
|--------------------------------------------------------------------------
*/
Route::prefix('booking/{id}')->where(['id' => '[0-9]+'])->group(function () {

    // Formulir kosong (tanggal belum dipilih)
    Route::get('/', fn ($id) => view('pages.booking_isiformulir_peminjaman', [
        'id' => $id, 'room' => 'SI-4202',
    ]))->name('booking');

    // Tanggal terisi (Check Availability aktif)
    Route::get('/tanggal', fn ($id) => view('pages.booking_pilhtanggal_peminjaman', [
        'id' => $id, 'room' => 'SI-4202', 'date' => request('date', '2026-05-20'),
    ]))->name('booking.tanggal');

    // Waktu terpilih (menerima data dari form lewat query string)
    Route::get('/waktu', fn ($id) => view('pages.booking_pilihwaktu_peminjaman', [
        'id' => $id, 'room' => 'SI-4202',
        'date' => request('date', '2026-05-20'),
        'time' => request('time', '15:00 - 17:00'),
        'activity' => request('activity'),
        'purpose' => request('purpose'),
        'department' => request('department'),
    ]))->name('booking.waktu');

    // Dokumen pendukung: kosong
    Route::get('/dokumen', fn ($id) => view('pages.booking_melampirkan_dokumenpendukung', [
        'id' => $id, 'allUploaded' => false,
        'docs' => [
            ['label' => 'KTM/KTP',          'name' => 'ktm',   'file' => null],
            ['label' => 'Surat Peminjaman', 'name' => 'surat', 'file' => null],
        ],
    ]))->name('booking.dokumen');

    // Dokumen pendukung: sudah terunggah (mengikuti gambar referensi)
    Route::get('/dokumen/terunggah', fn ($id) => view('pages.booking_berkasterunggah', [
        'id' => $id, 'allUploaded' => true,
        'docs' => [
            ['label' => 'KTM/KTP',          'name' => 'ktm',    'file' => ['name' => 'KTP_Scan_JohnDoe.pdf', 'size' => '1.2 MB']],
            ['label' => 'Surat Peminjaman', 'name' => 'surat',  'file' => ['name' => 'Surat Peminjaman.pdf', 'size' => '1.2 MB']],
            ['label' => 'Surat Peminjaman', 'name' => 'surat2', 'file' => ['name' => 'KTP_Scan_JohnDoe.pdf', 'size' => '1.2 MB']],
        ],
    ]))->name('booking.terunggah');

    Route::get('/ringkasan', fn ($id) => view('pages.booking_ringkasanpeminjaman', [
        'id' => $id,
        'booking' => [
            'code' => 'R4992A7',
            'room' => 'SI-4202',
            'location' => 'Gedung 4 Sistem Informasi, 2nd Floor',
            'capacity' => '20 Persons',
            'facilities' => [
                ['icon' => 'air-vent', 'label' => 'Full AC'],
                ['icon' => 'wifi',     'label' => '5G Wifi'],
            ],
            'date' => '6 July 2026',
            'time' => '09.00 - 12.00 (3 Hours)',
            'activity_name' => 'Rapat Pangsang IM #07',
            'description' => 'Pencerdasan fullday untuk anak IM covering leadership skills and upcoming academic year planning. Expected attendance is full capacity.',
            'documents' => [
                ['name' => 'KTP_Scan_JohnDoe.pdf', 'size' => '1.2 MB'],
                ['name' => 'Surat Peminjaman.pdf', 'size' => '1.2 MB'],
            ],
        ],
    ]))->name('booking.ringkasan');

    Route::get('/berhasil', fn ($id) => view('pages.booking_berhasil', ['id' => $id]))
        ->name('booking.berhasil');
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
| Booking Summary (setelah group /bookings agar tidak bentrok dengan {id})
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

/*
|--------------------------------------------------------------------------
| Notifikasi (filter: all | actions | updates | system)
|--------------------------------------------------------------------------
*/
Route::get('/notifikasi', function () {
    $all = [
        ['category' => 'actions', 'type' => 'action', 'title' => 'Action Required', 'time' => '2 mins ago',
         'message' => 'Please upload your document revision for Request #123. Update before 27 May 2026 at 19.00 PM.',
         'actions' => [['label' => 'Update', 'href' => '#'], ['label' => 'Details', 'href' => '#']]],
        ['category' => 'updates', 'type' => 'approved', 'title' => 'Status Update', 'time' => '15 mins ago',
         'message' => 'Your booking for Room 101 has been Approved. You can now access the room keycard details in your bookings.',
         'actions' => [['label' => 'Check-In', 'href' => url('/checkin/1')], ['label' => 'Details', 'href' => '#']]],
        ['category' => 'updates', 'type' => 'timelimit', 'title' => 'Status Update', 'time' => '2 mins ago',
         'message' => 'Your booking for Room 67 has reached its time limit.',
         'actions' => [['label' => 'Check-Out', 'href' => url('/checkout/1')]]],
        ['category' => 'actions', 'type' => 'unfinished', 'title' => 'Unfinished booking', 'time' => '2 mins ago',
         'message' => 'Your booking progress for Room 62 has not been finished. Continue?',
         'actions' => [['label' => 'Continue', 'href' => '#'], ['label' => 'Cancel Booking', 'href' => '#']]],
        ['category' => 'actions', 'type' => 'action', 'title' => 'Action Required', 'time' => '2 hours ago',
         'message' => 'Please upload your document revision for Request #124. Update before 28 May 2026 at 19.00 PM.',
         'actions' => [['label' => 'Update', 'href' => '#'], ['label' => 'Details', 'href' => '#']]],
        ['category' => 'system', 'type' => 'system', 'title' => 'System Maintenance', 'time' => '1 day ago',
         'message' => 'The app will be unavailable on 30 May 2026, 01.00–03.00 WIB.',
         'actions' => []],
    ];

    $filter = request('filter', 'all');
    $active = ['all' => 0, 'actions' => 1, 'updates' => 2, 'system' => 3][$filter] ?? 0;
    $notifications = $filter === 'all' ? $all : array_values(array_filter($all, fn ($n) => $n['category'] === $filter));

    return view('pages.notifikasi', compact('notifications', 'active'));
})->name('notifikasi');

/*
|--------------------------------------------------------------------------
| Chat: daftar percakapan & ruang pesan
|--------------------------------------------------------------------------
*/
Route::get('/chat', fn () => view('pages.percakapan', ['conversations' => [
    ['id' => 1, 'name' => 'Artin Finalita, S.T, M.T', 'time' => '10:45 AM', 'unread' => 3,
     'preview' => 'I see. Could you please send a photo of the cable connection? I\'ll check if a maintenance staff is nearby.'],
]]))->name('chats');

Route::get('/chat/{id}', fn ($id) => view('pages.pesan', [
    'admin' => ['id' => $id, 'name' => 'Artin Finalita, S.T, M.T', 'status' => 'Average Response: 2h'],
    'date' => 'Monday, Oct 23',
    'messages' => [
        ['side' => 'in',  'time' => '10:42 AM', 'text' => 'Hello! I am the administrator for Campus A Sarpras. How can I assist you today regarding your room booking?'],
        ['side' => 'out', 'time' => '10:44 AM', 'text' => 'Hi, I\'m having trouble with the projector in Room 302. It keeps flickering and showing \'No Signal\'.'],
        ['side' => 'in',  'time' => '10:45 AM', 'text' => 'I see. Could you please send a photo of the cable connection? I\'ll check if a maintenance staff is nearby.'],
        ['side' => 'out', 'time' => '10:46 AM', 'image' => 'images/rooms/blue-class.jpg'],
    ],
]))->whereNumber('id')->name('chat.show');

Route::post('/chat/{id}', fn () => back())->whereNumber('id')->name('chat.send');
