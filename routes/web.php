<?php


//Importacion de clases
use App\Livewire\Pages\Index;
use App\Livewire\Pages\Services;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Login;
use App\Livewire\Pages\Register;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Dash;
use App\Livewire\Pages\LoginAdmin;
use App\Livewire\Pages\Settings;
use App\Livewire\Pages\PasswordRecovery;
use App\Livewire\Pages\ChangePassword;
use App\Livewire\Pages\Paciente\Turns;
use App\Livewire\Pages\Paciente\TurnsDoctor;
use App\Livewire\Pages\Paciente\Suggestions;
use App\Livewire\Pages\Admin\Patient;
use App\Livewire\Pages\Admin\Doctor;
use App\Livewire\Pages\Admin\EditDoctor;
use App\Livewire\Pages\Admin\EditDoctorSchedule;
use App\Livewire\Pages\Admin\Specialty;
use App\Livewire\Pages\Admin\Calendar;
use App\Livewire\Pages\Admin\SuggestionsAdmin;
use App\Livewire\Pages\Admin\Products; 
use App\Livewire\Pages\Admin\PurchaseOrders; 
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Admin\Users;
use App\Models\User;
use App\Http\Controllers\AccountVerifyController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Http\Request;
use App\Http\Controllers\ImportUsersController;







//Rutas sin middlewares
Route::get('/', Index::class)->name('index');
Route::get('/servicios', Services::class)->name('services');
Route::get('/contacto', Contact::class)->name('contact');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/login-admin', LoginAdmin::class)->name('login.admin');
Route::get('/dash', Dash::class)->name('dash');
Route::get('/recuperar-contraseña', PasswordRecovery::class)->name('password.recovery');
Route::get('/cambiar-contraseña/{token}', ChangePassword::class)->name('password.change');
Route::get('/verify/{token}', [AccountVerifyController::class, 'verifyEmail'])->name('verify');


Route::get('/verified-account', function () {
    return view('account-verified');
})->name('account-verified');









//Rutas para usuarios en general
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/configuracion', Settings::class)->name('settings');
});






//Rutas para administradores
Route::group(['middleware' => ['role:admin']], function () { 
    Route::get('/admin/pacientes', Patient::class)->name('admin.pacientes');
    Route::get('/admin/doctores', Doctor::class)->name('admin.doctor');
    Route::get('/admin/editar-doctor/{id}', EditDoctor::class)->name('edit.doctor');
    Route::get('/admin/editar-jornada-medico/{id}', EditDoctorSchedule::class)->name('edit.doctor_schedule');
    Route::get('/admin/especialidades', Specialty::class)->name('admin.specialty');
    Route::get('/admin/calendario-de-turnos', Calendar::class)->name('admin.calendar');
    Route::get('/admin/quejas-y-sugerencias', SuggestionsAdmin::class)->name('admin.suggestions');
    Route::get('/admin/inventario', Products::class)->name('admin.products');
    Route::get('/admin/ordenes-compra', PurchaseOrders::class)->name('admin.purchase_orders');
    Route::get('/admin/usuarios', Users::class)->name('admin.users');
    Route::post('/import', [ImportUsersController::class, 'import'])->name('import-users');
});





//Rutas para pacientes
Route::group(['middleware' => ['role:paciente']], function () { 
    Route::get('/pacientes/turnos', Turns::class)->name('paciente.turns');
    Route::get('/pacientes/turnos-medico/{id}', TurnsDoctor::class)->name('paciente.turns_doctor');
    Route::get('/pacientes/quejas-y-sugerencias', Suggestions::class)->name('paciente.suggestions');
});





//Rutas para empleados
Route::group(['middleware' => ['role:empleado']], function () { 
    Route::get('/empleado/pacientes', Patient::class)->name('empleado.pacientes');
    Route::get('/empleado/calendario-de-turnos', Calendar::class)->name('empleado.calendar');
});

