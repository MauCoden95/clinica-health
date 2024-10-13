<?php

use App\Livewire\Pages\Index;
use App\Livewire\Pages\Services;
use App\Livewire\Pages\Contact;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('index');
Route::get('/servicios', Services::class)->name('services');
Route::get('/contacto', Contact::class)->name('contact');


