<?php

// ----- LoginController ----- //
// namespace App\Http\Controllers\Auth;
// use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// ----! LoginController !---- //

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LogoutController extends Controller
{
    // ----- LoginController ----- //
    // use AuthenticatesUsers;
    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = '/home';
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('auth')->only('logout');
    // }
    // ----! LoginController !---- //

    /**
     * Handle the logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // ユーザーをログアウト

        $request->session()->invalidate(); // セッションを無効化
        $request->session()->regenerateToken(); // CSRFトークンを再生成

        // リダイレクト先を指定（例：ログインページ）
        return redirect('/login');
    }

}
