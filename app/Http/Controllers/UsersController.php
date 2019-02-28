<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    	session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
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
