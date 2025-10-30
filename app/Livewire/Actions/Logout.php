<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        // Force full browser redirect to completely clear Inertia state
        return redirect('/')->withHeaders([
            'X-Inertia' => 'false',  // Tell Inertia to NOT handle this redirect
        ]);
    }
}
