<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()
                ->route('todos.index');
        }

        return back()
            ->withErrors([
                'email' => 'メールアドレスまたはパスワードが正しくありません。',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }

    public function showSignup(): View {
        return view('auth.signup');
    }

    public function register(
        RegisterRequest $request,
        AuthService $service
    ) {
        // TODO: RegisterRequestでvalidateを実装
        $service->createUser($request->validated());

        return redirect('login');
    }
}
