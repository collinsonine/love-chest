<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages.landing.home')->name('home');
Route::livewire('/v/{slug}', 'pages.landing.valentine')->name('valentine.show');
