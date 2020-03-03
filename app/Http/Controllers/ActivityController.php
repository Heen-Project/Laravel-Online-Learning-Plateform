<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class ActivityController extends Controller
{

	public function userActivityPage($id)
	{
		$user = \App\User::find($id);
		// $user = \App\User::where('username', $id)->first();
		// dd($user);
		$users = \App\User::where('point', '!=', 0)->orderBy('point','desc')->get()->all();
		$viewArticles = \App\ViewArticle::where('userId', $user->id)->orderBy('created_at','desc')->take(5)->get()->all();
		$rank = 1;
		if ($user->role =='user'){
			$activities = \App\UserActivity::where('userId', $user->id)->orderBy('created_at','desc')->paginate(5);
			// $points = \App\UserActivity::where('userId', $user->id)->lists('point');
			// dd($activities);
			foreach ($users as $temp) {
				if ($temp->id == $user->id){
					break;
				}
				else {
					$rank+=1;
				}
			}
			// return $rank;
			if (Auth::Guest())
				return view('pages.guest.userActivity', compact('user', 'activities', 'rank', 'viewArticles'));
			else if (Auth::User()->role == 'user')
				return view('pages.user.userActivity', compact('user', 'activities', 'rank', 'viewArticles'));
			else if (Auth::User()->role == 'admin')
					return view('pages.admin.userActivity', compact('user', 'activities', 'rank', 'viewArticles'));
		}
		else {
			return redirect('index');
		}
	}

	public function topUserPage()
	{
		$users = \App\User::where('point', '!=', 0)->orderBy('point','desc')->take(5)->get()->all();
		if (Auth::Guest())
			return view('pages.guest.topUser', compact('users'));
		else if (Auth::User()->role == 'user')
			return view('pages.user.topUser', compact('users'));
		else if (Auth::User()->role == 'admin')
				return view('pages.admin.topUser', compact('users'));
	}

	public function myActivity()
	{
		if (Auth::Guest())
			return redirect('index');
		else {
			$user = Auth::User();
			$users = \App\User::where('point', '!=', 0)->orderBy('point','desc')->get()->all();
			$viewArticles = \App\ViewArticle::where('userId', $user->id)->orderBy('created_at','desc')->take(5)->get()->all();
			$rank = 1;
			if ($user->role =='user'){
				$activities = \App\UserActivity::where('userId', $user->id)->orderBy('created_at','desc')->paginate(5);
			// $points = \App\UserActivity::where('userId', $user->id)->lists('point');
			// dd($activities);
				foreach ($users as $temp) {
					if ($temp->id == $user->id){
						break;
					}
					else {
						$rank+=1;
					}
				}
			// return $rank;

				if (Auth::User()->role == 'user')
					return view('pages.user.userActivity', compact('user', 'activities', 'rank', 'viewArticles'));
				else if (Auth::User()->role == 'admin')
					return view('pages.admin.userActivity', compact('user', 'activities', 'rank', 'viewArticles'));
			}
			else {
				return redirect('index');
			}
		}
	}

	public function userActivityShow($id)
	{
		// $user = \App\User::find($id);
		$search=str_replace("%20"," ",$id);
		$user = \App\User::where('username', $search)->first();
		// dd($user);
		$users = \App\User::where('point', '!=', 0)->orderBy('point','desc')->get()->all();
		$viewArticles = \App\ViewArticle::where('userId', $user->id)->orderBy('created_at','desc')->take(5)->get()->all();
		$rank = 1;
		if ($user->role =='user'){
			$activities = \App\UserActivity::where('userId', $user->id)->orderBy('created_at','desc')->paginate(5);
			// $points = \App\UserActivity::where('userId', $user->id)->lists('point');
			// dd($activities);
			foreach ($users as $temp) {
				if ($temp->id == $user->id){
					break;
				}
				else {
					$rank+=1;
				}
			}
			// return $rank;
			if (Auth::Guest())
				return view('pages.guest.userActivity', compact('user', 'activities', 'rank', 'viewArticles'));
			else if (Auth::User()->role == 'user')
				return view('pages.user.userActivity', compact('user', 'activities', 'rank', 'viewArticles'));
			else if (Auth::User()->role == 'admin')
					return view('pages.admin.userActivity', compact('user', 'activities', 'rank', 'viewArticles'));
		}
		else {
			return redirect('index');
		}
	}
}
