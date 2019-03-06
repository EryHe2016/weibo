<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Zend\Diactoros\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 展示忘记密码输入邮箱页面
     */
    /*public function showLinkRequestForm()
    {
        return view('auth.password.email');
    }*/

    /**
     * 发送重置密码邮件
     */
    /*public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists',
        ]);
    }*/
}
