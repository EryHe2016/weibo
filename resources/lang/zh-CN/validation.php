<?php

return [

	'custom' =>[
		'name' => [
			'required' => '用户名不能为空',
			'regex' => '用户名规则不正确，5到10个字符或数字',
		],
		'email' => [
			'required' => '邮箱地址不能为空！',
			'email' => '邮箱格式不正确',
			'exists' => '该邮箱不存在'
		],
		'password' => [
			'required' => '密码不能为空',
			'same' => '两次密码不一致'
		],
	],

];