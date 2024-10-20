<?php

use App\Livewire\Pages\Index;
use App\Livewire\Pages\Services;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Login;
use App\Livewire\Pages\Register;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Admin\Patient;
use App\Livewire\Pages\Admin\EditPatient;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('index');
Route::get('/servicios', Services::class)->name('services');
Route::get('/contacto', Contact::class)->name('contact');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');




Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

Route::group(['middleware' => ['role:admin']], function () { 
    Route::get('/admin/pacientes', Patient::class)->name('admin.pacientes');
    Route::get('/admin/editar-paciente/{id}', EditPatient::class)->name('edit.patient');
});





