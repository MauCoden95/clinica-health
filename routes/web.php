<?php

use App\Livewire\Pages\Index;
use App\Livewire\Pages\Services;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Login;
use App\Livewire\Pages\Register;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Dash;
use App\Livewire\Pages\LoginAdmin;
use App\Livewire\Pages\Paciente\Turns;
use App\Livewire\Pages\Paciente\TurnsDoctor;
use App\Livewire\Pages\Admin\Patient;
use App\Livewire\Pages\Admin\EditPatient;
use App\Livewire\Pages\Admin\Doctor;
use App\Livewire\Pages\Admin\EditDoctor;
use App\Livewire\Pages\Admin\EditDoctorSchedule;
use App\Livewire\Pages\Admin\Specialty;
use App\Livewire\Pages\Admin\EditSpecialty;
use App\Livewire\Pages\Admin\Calendar;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('index');
Route::get('/servicios', Services::class)->name('services');
Route::get('/contacto', Contact::class)->name('contact');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/login-admin', LoginAdmin::class)->name('login.admin');
Route::get('/dash', Dash::class)->name('dash');




Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

Route::group(['middleware' => ['role:admin']], function () { 
    Route::get('/admin/pacientes', Patient::class)->name('admin.pacientes');
    Route::get('/admin/editar-paciente/{id}', EditPatient::class)->name('edit.patient');
    Route::get('/admin/doctores', Doctor::class)->name('admin.doctor');
    Route::get('/admin/editar-doctor/{id}', EditDoctor::class)->name('edit.doctor');
    Route::get('/admin/editar-jornada-medico/{id}', EditDoctorSchedule::class)->name('edit.doctor_schedule');
    Route::get('/admin/especialidades', Specialty::class)->name('admin.specialty');
    Route::get('/admin/editar-especialidad/{id}', EditSpecialty::class)->name('edit.specialty');
    Route::get('/admin/calendario-de-turnos', Calendar::class)->name('admin.calendar');
});


Route::group(['middleware' => ['role:paciente']], function () { 
    Route::get('/pacientes/turnos', Turns::class)->name('paciente.turns');
    Route::get('/pacientes/turnos-medico/{id}', TurnsDoctor::class)->name('paciente.turns_doctor');
});




