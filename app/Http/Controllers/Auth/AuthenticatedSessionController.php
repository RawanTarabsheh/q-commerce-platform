<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
         // dd($request->all());
         $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        $email = trim($request->email);
        $password = trim($request->password);

        $user     = User::where('email', $email)->first();
        // Check email
        if (!isset($user->id)) {
            return redirect()->back()->with('error', __('auth.failed'));
        }
        // Check password
        if (!Hash::check($password, $user->password)) {
            return redirect()->back()->with('error', __('auth.password'));
        }
            if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
                $user = Auth::user();
                $success['token'] =  $user->createToken('oneWins', ['admin:all'])->accessToken;

                    return redirect()->intended(RouteServiceProvider::HOME);
            } }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
