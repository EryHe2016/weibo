<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    /**
     * 展示用户列表 GET	/users
     */
    public function index()
    {

    }

    /**
     * 展示用户个人信息		GET	/users/{id}
     */
    public function show(User $user)
    {
    	return view('users.show', compact('user'));
    }

    /**
     * 展示创建用户页面		GET	/users/create
     */
    public function create()
    {
    	return view('users.create');
    }

    /**
     * 创建用户		POST	/users
     */
    public function store(Request $request)
    {
    	//表单验证
    	$this->validate($request, [
    		'name' => 'required|regex:[\w{5,10}]',
    		'email' => 'required|email|unique:users',
    		'password' => 'required|same:password_confirmation',

    	]);

    	//验证通过保存用户信息
    	$user = User::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password)
    	]);

        //注册成后，发送邮箱激活邮件
        $this->sendEmailConformationTo($user);
    	session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
    	//return redirect()->route('users.show', [$user]);
        return redirect('/');
    }

    /**
     * 发送邮箱激活链接邮件
     */
    public function sendEmailConformationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'summer@example.com';
        $name = 'summer';
        $to = $user->email;
        $subject = '感谢注册 Weibo 应用！请确认你的邮箱。';
        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject){
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    /**
     * 邮箱激活
     */
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->activated = true;
        $user->activation_token = '';
        $user->save();
        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    /**
     * 编辑用户个人资料页面	GET	/users/{user}/edit
     */
    public function edit()
    {

    }

    /**
     * 更新用户信息	PATCH	/users/{user}
     */
    public function update()
    {

    }

    /**
     * 删除用户	DELETE	/users/{user}
     */
    public function destory()
    {

    }
}
