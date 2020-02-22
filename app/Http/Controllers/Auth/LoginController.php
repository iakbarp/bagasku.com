<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Support\Facades\GlobalAuth;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectTo()
    {
        if (Auth::check() && (Auth::user()->isRoot() || Auth::user()->isAdmin())) {
            return redirect()->route('admin.dashboard')->with('signed', 'Anda telah masuk.');

        } else {
            if (Auth::user()->get_bio->tgl_lahir != null && Auth::user()->get_bio->jenis_kelamin != null &&
                Auth::user()->get_bio->alamat != null && Auth::user()->get_bio->provinsi_id != null &&
                Auth::user()->get_bio->kota_id != null && Auth::user()->get_bio->hp != null) {
                return back()->with('signed', 'Anda telah masuk.');

            } else {
                return back()->with('biodata', 'Anda telah masuk! Untuk dapat menggunakan fitur ' .
                    env('APP_NAME') . ' sepenuhnya, silahkan lengkapi biodata Anda terlebih dahulu.');
            }
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    /**
     * Perform login process for users & admins
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        if (GlobalAuth::login(['email' => $request->email, 'password' => $request->password])) {
            if (session()->has('intended')) {
//                $this->redirectTo = session('intended');
                session()->forget('intended');
            }

            return $this->redirectTo();
        }

        return back()->withInput($request->all())->with([
            'error' => 'Email atau kata sandi Anda salah.'
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        GlobalAuth::logout();

        return redirect()->route('beranda')->with('logout', 'Anda telah keluar.');
    }
}
