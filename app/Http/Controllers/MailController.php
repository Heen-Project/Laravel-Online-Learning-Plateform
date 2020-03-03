<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Request;
use Validator;
use Auth;
use Mail;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

   public function register(){
    		$validator= Validator::make(Request::all(), [
            'username'=>'required|min:4|unique:users',
            'firstName'=>'required|min:3|alpha',
            'lastName'=>'alpha',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
        ]);

        if($validator->fails()){
            return $validator->errors()->first();
        }
        else if ($validator->passes())
      	{ 
            $register = Request::all();
			//$confirmation_code = str_random(30);
    		$confirmation_code = str_random(30);
    		$register['firstName']= ucfirst(strtolower($register['firstName']));
            $register['lastName']= ucfirst(strtolower($register['lastName']));
    		$register['password'] = bcrypt($register['password']);
    		$register['confirmation_code'] = $confirmation_code;
            $register['avatar'] = '/image/default/'.$register['username'].'DefaultAvatar.jpeg';
    	    \App\User::create($register);
    		Mail::send('email.verification', $register, function($message) use ($register) {
                $message->to($register['email'], $register['username'])
                ->subject('Bluejack Online Learning Email Verification');
            });
            flash()->success('Thanks for signing up! Please check your email.');
            return null;
        }
	}

	public function verify($confirmation_code)
    {
        if(is_null($confirmation_code))
        {
            abort(404);
        }

        $user = \App\User::where('confirmation_code', $confirmation_code)->firstOrFail();
				
        if (is_null($user))
        {
    		abort(404);
        }
        if ($user->confirmed==0){
            $user->confirmed = 1;
            $user->confirmation_code = null;
            $user->save();
            //string substr ( string $string , int $start [, int $length ] )
            $initial = substr($user['firstName'],0,1).substr($user['lastName'],0,1);
            //Flash::overlay('You have successfully verified your account.');
            $username = $user['username'];
    		Flash::message('You have successfully verified your '.$user->username.' account.');
            return view ('pages.guest.successRegistered', compact('username','initial'));
        }
    }

    public function login()
    {

	   $validator= Validator::make(Request::all(), [
            'username'=>'required|exists:users',
            'password'=>'required',
      ]);
      
      if($validator->fails()){
          echo $validator->errors()->first();
      }
      else{

        $request = Request::all();

        $credentials = [
            'username' => $request['username'],
            'password' => $request['password'],
            'confirmed' => true,
        ];
        if (!Auth::attempt($credentials)) {
			$userUsername = \App\User::where('username', $request['username'])->firstOrFail();
			if($userUsername->confirmed) echo 'Username and Password Unmatched';
			else echo'You Must Activate Your Account First';
		}
        else 
        {
      	    return null;
        }
      }
    }
}