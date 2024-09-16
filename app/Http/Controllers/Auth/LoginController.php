<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Management;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    public function showLoginForm()
    {

        $countries = Management::select('country')
            ->orderBy('country', 'asc')
            ->groupBy('country')->get();
        return view('auth.login',  compact('countries'));
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function login(Request $request): RedirectResponse
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'country' => 'required',
        ]);

        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $user = Auth::user();
            if ($user->country === $input['country']) {
                if ($user->status === 'active') {
                    Session::put('avatar', $user->avatar);
                    if ($user->type === 'employee') {
                        return redirect()->route('home');
                    } elseif ($user->type === 'admin') {
                        return redirect()->route('admin.home');
                    }
                } elseif ($user->status === 'suspended') {
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['suspended' => 'Your account is suspended.']);
                }
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['country' => 'You are not authorized to log in from your country.']);
            }
        } else {
            return redirect()->back()->withErrors(['login-error' => 'Invalid email or password.']);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        session()->forget('login_attempts');
        session()->forget('show_reset_password');
    }
}
