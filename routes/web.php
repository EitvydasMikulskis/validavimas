<?php
require __DIR__.'/auth.php';

use App\Settings\GeneralSettings;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');
    Route::post('students/{id}/restore', [StudentController::class, 'restore'])->name('students.restore');
    Route::delete('students/{id}/forceDelete', [StudentController::class, 'forceDelete'])->name('students.forceDelete');

    Route::resource('students', StudentController::class)->except(['show']);
});

Route::get('/test', function () {

    // Įrašymas
    Setting::set('site_name', 'Testavimas');

    // Nuskaitymas
    $siteName = Setting::get('site_name');

    // Su default reikšme
    $timezone = Setting::get('timezone', 'Europe/Vilnius');

    return [
        'site_name' => $siteName,
        'timezone' => $timezone
    ];
});

Route::get('/settings-test', function () {

    $settings = app(GeneralSettings::class);

    // parodyti dabartines reikšmes
    $before = [
        'site_name' => $settings->site_name,
        'timezone' => $settings->timezone,
        'maintenance_mode' => $settings->maintenance_mode,
    ];

    // pakeisti reikšmę
    $settings->site_name = 'Mano puslapis';

    // išsaugoti
    $settings->save();

    // nuskaityti iš naujo
    $updated = app(GeneralSettings::class);

    return [
        'before' => $before,
        'after' => [
            'site_name' => $updated->site_name,
            'timezone' => $updated->timezone,
            'maintenance_mode' => $updated->maintenance_mode,
        ]
    ];
});

Route::get('/phone-validation', [StudentController::class, 'phoneForm']);
Route::post('/phone-validation', [StudentController::class, 'validatePhone']);