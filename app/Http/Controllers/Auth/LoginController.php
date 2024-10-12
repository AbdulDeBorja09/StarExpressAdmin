<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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
        return view('auth.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

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
        ]);
        $credentials = $request->only('email', 'password');



        $input = $request->only(['email', 'password', 'branch_id']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status === 'active') {
                Session::put('avatar', $user->avatar);
                
                if ($user->type === 'accountant') {
                    return redirect()->route('accountant.home');
                } elseif ($user->type === 'admin') {
                    return redirect()->route('admin.home');
                } elseif ($user->type === 'servicemanager') {
                    return redirect()->route('servicemanager.home');
                } else {
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['unauthorized' => 'Unauthorized user type.']);
                }
            } elseif ($user->status === 'suspended') {
                Auth::logout();
                return redirect()->route('login')->withErrors(['suspended' => 'Your account is suspended.']);
            }
        } else {
            return redirect()->route('login');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        session()->forget('login_attempts');
        session()->forget('show_reset_password');
    }
}
