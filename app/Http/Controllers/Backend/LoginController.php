<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller {
    /** Show Login Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm() {
        if (\Auth::check()) {
            return redirect()->route('backend-dashboard');
        }
        return view('backend.auth.login');
    }

    public function postLogin(LoginRequest $request) {
        $user = \Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if ($user) {
            \Auth::login(\Auth::user(), true);
            return redirect('/backend/dashboard');
        }
        return view('backend.auth.login', [
            'message' => "Email or password is incorrect",
        ]);
    }

    public function logout() {
        \Auth::logout();
        return redirect()->route('backend-login');
    }
}
