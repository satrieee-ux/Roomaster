<?php

use Illuminate\Support\Facades\Route;

Route::view('/styleguide', 'pages.styleguide')->name('styleguide');

Route::view('/', 'pages.report-submitted')->name('home');
Route::view('/report/submitted', 'pages.report-submitted')->name('report.submitted');
Route::view('/checkout/success', 'pages.check-out-success')->name('checkout.success');
Route::view('/chat', 'pages.chat')->name('chat');
Route::view('/modals', 'pages.modal-preview')->name('modals');
