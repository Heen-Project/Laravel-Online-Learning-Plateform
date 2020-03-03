<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Request;
use Flash;
use Mail;

class SubscriberController extends Controller
{
    //
	public function subscribe()
	{
		$user = Auth::User();
		if ($user->subscribe == false){


			$sendData = [
			'username' => $user['username'],
			'firstName' => $user['firstName'],
			'lastName' => $user['lastName'],
			'email' => $user['email'],
			];

			Mail::send('email.subscribe', $sendData, function($message) use ($sendData) {
				$message->to($sendData['email'], $sendData['username'])
				->subject('Bluejack Online Learning Subscribe');
			});
			
			$user->subscribe = true;
			$user->save();

			return view ('pages.user.subscribe');

		}
		else if ($user->subscribe== true){
			flash()->error("You have already subscribe");
			return redirect('home');
		}
	}

	public function unsubscribe()
	{
		$user = Auth::User();
		if ($user->subscribe == true){
			

			$sendData = [
			'username' => $user['username'],
			'firstName' => $user['firstName'],
			'lastName' => $user['lastName'],
			'email' => $user['email'],
			];

			Mail::send('email.unsubscribe', $sendData, function($message) use ($sendData) {
				$message->to($sendData['email'], $sendData['username'])
				->subject('Bluejack Online Learning Unsubscribe');
			});
			$user->subscribe = false;
			$user->save();

			return view ('pages.user.unsubscribe');
		}
		else if ($user->subscribe== false){
			flash()->error("You have already unsubscribe");
			return redirect('home');
		}
	}

	public function create()
	{
		return view('pages.admin.createNewsletter');
	}

	public function sendNewsletter(Requests\NewsRequest $request)
	{
		$users = \App\User::where('subscribe', true)->get();
		 // return $request->news;
		// return $users;
		foreach ($users as $user) {
			$sendData = [
			'username' => $user['username'],
			'firstName' => $user['firstName'],
			'lastName' => $user['lastName'],
			'email' => $user['email'],
			'news' => $request->news,
			];
			Mail::send('email.newsLetter', $sendData, function($message) use ($sendData) {
				$message->to($sendData['email'], $sendData['username'])
				->subject('Bluejack Online Learning News');
			});
		}
		flash()->success (" Newsletter Send ");
		return redirect ('home');
	}
}
