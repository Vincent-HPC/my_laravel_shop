<?php

// 檔案位置：app/Http/Controllers/UserAuthController.php

namespace App\Http\Controllers;

use App\Shop\Entity\User;  			// User Eloquent ORM Model
use App\Jobs\SendSignUpMailJob;
use Mail;
use Validator; 
use Hash;
use DB;
use Exception;



class UserAuthController extends Controller {

	//register Page
	public function signUpPage(){
		$binding = [
			'title' => trans('shop.auth.sign-up'),
		];
		return view('auth.signUp',$binding);
	}


	public function signUpProcess(){
		// receive input data
		$input = request()->all();

		$rules = [
			'nickname' => [
					'required',
					'max:50',
			],
			'email' => [
					'required',
					'max:150',
					'email',
			],
			'password' => [
					'required',
					'same:password_confirmation',
					'min:6',
			],
			'password_confirmation' => [
					'required',
					'min:6',
			],
			'type' => [
					'required',
					'in:G,A',
			],
    ];

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {
			// validate error
			return redirect('/user/auth/sign-up')
					->withErrors($validator)
					->withInput();
		}

		//Encrypt pwd
		$input['password'] = Hash::make($input['password']);

		//  新增會員資料
		$Users = User::create($input);


		// 寄送註冊通知信
		$mail_binding = [
				'nickname' => $input['nickname'],
				'email' => $input['email'],
		];

		// Mail::send('email.signUpEmailNotification',$mail_binding,
		// 		function($mail) use ($input)
		// 		{
		// 				$mail->to($input['email']);
		// 				$mail->from('pchuang92738@gmail.com');
		// 				$mail->subject('恭喜註冊 My Shop Laravel 成功');
		// 		}
		// );

		SendSignUpMailJob::dispatch($mail_binding)
				->onQueue('high');

		// 重新導向到登入頁
		return redirect('/user/auth/sign-in');
	}


	public function signInPage(){
		$binding = [
			'title' => trans('shop.auth.sign-in'),
		];
		return view('auth.signIn', $binding);
	}

	public function signInProcess(){
		// receive input data
		$input = request()->all();

		$rules = [
			'email' => [
					'required',
					'max:150',
					'email',
			],
			'password' => [
					'required',
					'min:6',
			],
    ];

		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {
			// validate error
			return redirect('/user/auth/sign-in')
					->withErrors($validator)
					->withInput();
		}

		// *****************
		// DB::enableQueryLog();

		//  Get User pwd from DB
		$User = User::where('email',$input['email'])->firstOrFail();

		// var_dump(DB::getQueryLog());
		// exit;
		// *****************


		// Check Pwd
		$is_password_correct = Hash::check($input['password'], $User->password);

		if(!$is_password_correct){
			// pwd errors return error msg
			$error_message = [
				'msg' => [
					'密碼驗證錯誤',
				],
			];
			return redirect('/user/auth/sign-in')
					->withErrors($error_message)
					->withInput();
		}

		// session record user_id
		session()->put('user_id', $User->id);

		return redirect()->intended('/');
	}

	public function signOut(){
		// clear Session
		session()->forget('user_id');

		// redirect to HomePage
		return redirect('/user/auth/sign-in');
	}

}
