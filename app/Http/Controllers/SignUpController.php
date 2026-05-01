<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function signup(Request $request): RedirectResponse
    {
        return redirect()
            ->route('login');
    }

    public function showLogin()
    {
        return redirect()
            ->route('login');
    }
}
