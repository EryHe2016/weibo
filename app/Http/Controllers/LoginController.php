<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;

class LoginController extends Controller
{

    /**
     * 展示登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credential = $this->validate($request, [
            'email' =>'required|email|exists:users',
            'password' => 'required'
        ]);

        if(Auth::attempt($credential, $request->has('remember'))){
            if(Auth::user()->activated){
                session()->flash('success', '欢迎回来！');
                $fallback = route('users.show', [Auth::user()]);
                return redirect()->intended($fallback);
            }else{
                Auth::logout();
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }
        }else{
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return back()->withInput();
        }
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出!');
        return redirect()->route('login');
    }
}
