<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordLink;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
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
            }
    }

    public function logout(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function user_register(){
        return view('auth.register');
        // return view('register.index');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('web')->login($user);
         return redirect(RouteServiceProvider::HOME);
    }
    public function forget_password()
    {
        return view('register.forget-password');
    }
    public function reset_password(Request $request)
    {
        $request->validate([
            'reset_email'   =>  ['required', 'email']
        ]);
        $data = [['email', $request->reset_email]];

        $user = User::getByUser($data);
        if ($user) {

        $resetLink = route('web.get_reset_password', $user->id);
        //  dd($resetLink);
            Mail::to($request->reset_email)->send(new ResetPasswordLink($user, $resetLink));
            return redirect()->back()->with('success', 'email sent added successfully.');

        }

        return response()->json(['errors' => ['reset_email' => 'Email not found!']], 422);
    }
    public function get_reset_password(User $user)
    {
        return view('register.reset-password', compact('user'));
    }
    public function post_reset_password(Request $request)
    {
        try {
            $request->validate([
                'new_password'      => ['required', 'string', 'min:8', Password::min(8)],
                'confirm_password'  => ['required', 'string', 'min:8', 'same:new_password', Password::min(8)],
            ]);
            $email = $request->email;
            $data = [
                'password' => Hash::make($request->confirm_password),
            ];
            if (User::updateByUser($email, $data))
                return redirect()->back()->with('success', __('web.change_password'));
            else
                return redirect()->back()->with('error', __('web.error_password'));
        } catch (QueryException $e) {
            return response()->json(['error' => 'Something worng.']);
        }
    }
}
