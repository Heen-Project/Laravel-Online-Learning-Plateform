<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('welcome');
});

//GUEST
Route::get('index', 'GuestController@index');
Route::post('guest/login', 'MailController@login');
Route::post('guest/register', 'MailController@register');
Route::get('guest/lessons', 'GuestController@lessons');
Route::get('guest/article', 'GuestController@article');
Route::get('guest/login/facebook', 'GuestController@facebookLogin');
Route::get('guest/register/verify/{confirmation_code}','MailController@verify');
Route::get('guest/password/reset/','GuestController@resetPasswordPage');
Route::post('guest/password/reset/','GuestController@resetPassword');
Route::get('guest/password/verify/{confirmation_code}','GuestController@resetVerifyPage');
Route::post('guest/password/verify/{confirmation_code}','GuestController@resetVerify');
Route::get('guest/register/facebook/{code}','GuestController@facebookRegisterPage');
Route::post('guest/register/facebook/{code}', 'GuestController@facebookRegister');
Route::get('guest/facebook', 'GuestController@facebook');
Route::get('guest/facebook/redirect', 'GuestController@redirect');
Route::get('guest/lesson/latest/{sort}', 'GuestController@lessonIndexLatest');
Route::get('guest/lesson/popular/{sort}', 'GuestController@lessonIndexPopular');
Route::get('guest/lesson', 'GuestController@lessonIndex');
Route::get('guest/lesson/{id}', 'GuestController@lessonShow');
Route::get('guest/article', 'GuestController@articleIndex');
Route::get('guest/article/{id}', 'GuestController@articleShow');
Route::get('guest/discussion/latest/{sort}', 'GuestController@discussionIndexLatest');
Route::get('guest/discussion/popular/{sort}', 'GuestController@discussionIndexPopular');
Route::get('guest/discussion', 'GuestController@discussionIndex');
Route::get('guest/discussion/{id}', 'GuestController@discussionShow');

//MEMBER
Route::get('activity/myself','ActivityController@myActivity');
// Route::get('home','UserController@home');
// Route::get('user/logout','UserController@logout');
Route::group(['middleware' => 'member'], function () {
	Route::get('subscribe/unsubscribe', 'SubscriberController@unsubscribe');
	Route::get('subscribe/subscribe', 'SubscriberController@subscribe');
});
Route::group(['middleware' => 'admin'], function () {
	Route::get('subscribe/create', 'SubscriberController@create');
	Route::post('subscribe/send', 'SubscriberController@sendNewsletter');
});


//ADMIN
Route::Resource('admin/lessonCategory', 'LessonCategoryController', ['only' => ['index', 'create', 'store', 'show']]);
Route::get('admin/lessonApproval', 'AdminController@approvalPage');
Route::post('admin/lessonApproval', 'AdminController@approval');
Route::get('admin/pendingLesson/{id}', 'AdminController@pendingLesson');
Route::get('admin/discussion/close/{id}', 'AdminController@closeDiscussion');
Route::get('admin/discussion/delete/{id}', 'AdminController@deleteDiscussion');
Route::delete('admin/comment/inappropriate/', 'AdminController@inappropriateComment');

//REGISTERED
Route::get('home','RegisteredController@login');
Route::get('logout','RegisteredController@logout');
// Route::get('lesson/redirect/{condition}','LessonController@view');
Route::get('lesson/popular/{sort}', 'LessonController@indexPopular');
Route::get('lesson/latest/{sort}', 'LessonController@indexLatest');
// Route::get('lesson/create', 'LessonController@create');
// Route::post('lesson', 'LessonController@store');
// Route::get('lesson/{id}', 'LessonController@show');
Route::Resource('lesson', 'LessonController', ['only' => ['index', 'create', 'store', 'show']]);
// Route::get('lesson/{condition}','LessonController@show');
Route::Resource('article', 'ArticleController', ['only' => ['index', 'create', 'store', 'show']]);
Route::get('discussion/popular/{sort}', 'DiscussionController@indexPopular');
Route::get('discussion/latest/{sort}', 'DiscussionController@indexLatest');
Route::Resource('discussion', 'DiscussionController', ['only' => ['index', 'create', 'store', 'show']]);
Route::post('comment/lesson', 'CommentController@storeLesson');
Route::post('comment/article', 'CommentController@storeArticle');
Route::post('comment/discussion', 'CommentController@storeDiscussion');
Route::put('comment/update', 'CommentController@updateComment');
Route::delete('comment/delete', 'CommentController@deleteComment');
Route::get('profile/edit', 'RegisteredController@profilePage');
Route::put('profile', 'RegisteredController@updateProfile');
Route::get('profile/password/{id}', 'RegisteredController@requestChangePassword');
Route::get('profile/password/edit/{confirmation_code}', 'RegisteredController@changePasswordPage');
Route::put('profile/password/edit/', 'RegisteredController@changePassword');
Route::post('search/tag', 'RegisteredController@tagSearch');

//ALL
Route::get('activity/user/username/{id}','ActivityController@userActivityShow');
Route::get('activity/user/{id}','ActivityController@userActivityPage');
Route::get('activity/topUser','ActivityController@topUserPage');
Route::get('rss', 'RssController@index');
Route::get('language/id', function(){
	\Session::put('locale', 'id');
	return redirect()->back();
});
Route::get('language/en', function(){
	\Session::put('locale', 'en');
	return redirect()->back();
});

Route::get('test',function(){
 // $user = Auth::User();
	// $data = \App\ViewArticle::where('userId', '!=', $user->id)->get()->all();
	// return session()->get('user');
	// return \App\Article::all()->detailViews->where('userId', '!=', $user)->get()->all();
	// return session()->get('recommendArticle');
	// return  Request::cookie('country');
	// return view('include.etc.svg');
	// return $tomorrow =  Carbon\Carbon::getDurationAttribute(Carbon\Carbon::tomorrow());
	$time= Carbon\Carbon::tomorrow();
	 return  Carbon\Carbon::tomorrow('Asia/Jakarta');
});

