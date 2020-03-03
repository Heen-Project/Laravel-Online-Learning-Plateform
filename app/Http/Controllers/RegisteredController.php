<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Request;
use Mail;
use Flash;
use App;

class RegisteredController extends Controller
{
    public function __construct()
    {
        $this->middleware('registered');
    }
    
    public function login(){
    	$userLocal = Auth::user();
    	if ($userLocal->role == 'user')
    	return view ('pages.user.home', compact('userLocal'));
    	else if ($userLocal->role == 'admin')
    	return view ('pages.admin.home', compact('userLocal'));
    }

    public function logout(){
    	Auth::logout();
    	return redirect ('index');
    }

    public function profilePage()
    {
        $userLocal = Auth::user();
        if ($userLocal->role == 'user')
        return view ('pages.user.profileUpdate', compact('userLocal'));
        else if ($userLocal->role == 'admin')
        return view ('pages.admin.profileUpdate', compact('userLocal'));
    }

    public function updateProfile()
    {
        $user = Auth::User();
        $request = Request::all();
        // dd($request);
        $destinationPath = public_path().'\image\\';
        $fileName = $user->username;
        $messages = '';
        $extension ='';

        if(Request::has('firstName')){
            echo 'ada nama depan ';
            $user->firstName = $request['firstName'];
            $messages = 'First Name has changed';
        }
        if(Request::has('lastName')){
            echo 'ada namabelakang ';
            $user->lastName = $request['lastName'];
            $messages = 'Last Name has changed';
        }
        if(Request::hasFile('avatar')){
            echo 'ada file ';
            if (Request::file('avatar')->isValid())
            {
                echo 'no problem';
                // Request::file('avatar')->put($destinationPath);
                $extension = Request::file('avatar')->getClientOriginalExtension();
                Request::file('avatar')->move($destinationPath, $fileName.'.'.$extension);
                $messages = 'Profile picture has changed';
                // return $extension;
                $user->avatar = '/image/'.$fileName.'.'.$extension;
                // return  $user->avatar;
            }
        }
        if(Request::has('firstName') && Request::has('lastName') && Request::hasFile('avatar'))
            flash()->success('First Name, Last Name, Profile picture has changed');
        else if(Request::has('firstName') && Request::has('lastName'))
            flash()->success('First Name, Last Name has changed');
        else if(Request::has('firstName') && Request::hasFile('avatar'))
            flash()->success('First Name, Profile picture has changed');
        else if(Request::has('lastName') && Request::hasFile('avatar'))
            flash()->success('Last Name, Profile picture has changed');
        else
            flash()->success($messages);
            // return $request;
        $user->save();
        return redirect()->back();
    }

    public function requestChangePassword()
    {
        $user = Auth::User();
        $confirmation_code = str_random(30);
        $user->confirmation_code = $confirmation_code;
        $user->save();
        $sendData = [
            'username' => $user['username'],
            'firstName' => $user['firstName'],
            'lastName' => $user['lastName'],
            'confirmation_code' => $user['confirmation_code'],
            'email' => $user['email'],
        ];

        Mail::send('email.change', $sendData, function($message) use ($sendData) {
                $message->to($sendData['email'], $sendData['username'])
                ->subject('Bluejack Online Learning Password Change Verification');
        });

        $username = $user['username'];
        $email = $user['email'];
        flash()->success($username.', a verification has been sent to your mail, please check it at
            '.$email);

        return redirect()->back();
    }

    public function changePasswordPage($confirmation_code)
    {
        if(is_null($confirmation_code))
        {
            abort(404);
        }

        if (Auth::Guest()){
            flash('You must login first');
            return redirect('index');
        }
        else if (Auth::User()->confirmation_code != $confirmation_code){
            flash()->message('Wrong Pages');
            return redirect('home');
        }
        else if (Auth::User()->confirmation_code == $confirmation_code){
            $userLocal = Auth::User();
            if ($userLocal->role == 'user')
            return view ('pages.user.newPassword', compact('confirmation_code'));
            else if ($userLocal->role == 'admin')
            return view ('pages.admin.newPassword', compact('confirmation_code'));
        }
    }

    public function changePassword(Requests\ConfirmPasswordRequest $request)
    {
        $requestData = Request::all();
        $user = \App\User::where('confirmation_code', $requestData['confirmation_code'])->first();
        
        $user->password = bcrypt($requestData['password']);
        $user->confirmation_code = null;
        $user->save();
        $username = $user->username;
        Flash::message($username.' , you have successfully change your password');
        return redirect ('home');
    }

    public function tagSearch()
    {
        $request = Request::get('search')[0];
        // $search= $request['search']['0'];
        // return $request;
        $search=str_replace("@","",$request);
        // dd($search);
        // echo ($search);
        // return $search;
        $users = \App\User::where('username','like', '%'.$search.'%')->lists('username', 'id')->take(5);

        echo $users;
    }
}
