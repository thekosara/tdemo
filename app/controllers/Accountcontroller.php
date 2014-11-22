<?php
class Accountcontroller extends BaseController{


	public function getSignIn()
	{
		return View::make('account.signin'); 


	}
	public function postSignIn()
	{
		$validator = Validator::make(Input::all(),
	array(
		'email' =>'required|email',
		'password' =>'required',
		

		));
		if($validator->Fails()){

				return Redirect::route('account-sign-in')
						->withErrors($validator)
						->withInput();


		}else{

			$auth =Auth::attempt(array(
				'email'=>Input::get('email'),
				'password'=>Input::get('password'),
				'active'=>1


				));
			if($auth){
				return Redirect::intended('/');


			}else{


				return Redirect::route('account-sign-in')
				->with('global','Email password wrong combination or Account not activated');
			}
				return Redirect::route('account-sign-in')
				->with('global','There was a problem signing in');

		}




	}

	public function getCreate()
	{
		return View::make('account.create'); 


	}
	public function postCreate()
	{
$validator = Validator::make(Input::all(),
	array(
		'email' =>'required|max:50|email|unique:users',
		'username' =>'required|max:20|min:3|unique:users',
		'password' =>'required|min:6',
		'vpassword' =>'required|same:password'




		));

if($validator->Fails()){
	return Redirect::route('account-create')
	->withErrors($validator)
	->withInput();

}else{
	$email = Input::get('email');
	$username = Input::get('username');
	$password = Input::get('password');
	
	//activation
	$code =str_random(60);

	$user = User::create(array(
	'email'=>$email,
	'username'=>$username,
	'password'=>Hash::make($password),
	'code'=>$code,
	'active'=>0


));
	if($user){
		//email  
		Mail::send('emails.auth.activate', array('link' => URL::route('account-activate',$code),
			'username' => $username),
			function($message) use ($user){
				$message->to($user->email, $user->username)->
				subject('Activate your account');
		});

		return Redirect::route('home') 
		->with('global','your account has been created!we have sent you an email');


			}
		}
	}
	public function getActivate($code)
	{
	$user = User::where('code','=', $code)->where ('active','=', 0);
if($user->count()){
	$user = $user->first();

	$user->active =1;
	$user->code ='';

	if($user->save()){

	return Redirect::route('home')
		->with('global','Activated! you can now sign in!');

		}
		}
		return Redirect::route('home')
		->with('global','We could not activate your account.try again later.');
	}
	}

