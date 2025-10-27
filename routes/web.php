<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('tasks.index');
    }
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    return redirect()->route('tasks.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/toggle-complete', [TaskController::class, 'toggleComplete'])
        ->name('tasks.toggle-complete');
});

require __DIR__ . '/auth.php';
