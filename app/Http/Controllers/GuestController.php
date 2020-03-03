<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Request;
use Validator;
use Auth;
use Mail;
use Socialize;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

	public function index()
    {
    	$users = \App\User::all();
    	return view ('pages.guest.index', compact('users'));
    }
    
    public function facebookRegisterPage($code){
        $codeFacebook = Request::all()['code'];
        $stateFacebook = Request::all()['state'];
        $url = Request::Url().'?code='.$codeFacebook.'&state='.$stateFacebook.'#_=_';
        $url1 = 'guest/register/facebook?code='.$codeFacebook;
        $url2 = 'state='.$stateFacebook.'#_=_';
        $urlRedirect = 'http://localhost:8000/guest/register/facebook/data?code='.$codeFacebook.'&amp;state='.$stateFacebook.'#_=_';
        $urlRedirectPart1 = 'http://localhost:8000/guest/register/facebook/data?code='.$codeFacebook;
        $urlRedirectPart2 = 'state='.$stateFacebook.'#_=_';
        return view ('pages.guest.facebookRegister', compact('url', 'url1', 'url2', 'urlRedirect', 'urlRedirectPart1', 'urlRedirectPart2'));
    }

    public function facebookRegister($code)
    {
        $validator= Validator::make(Request::all(), [
            'username'=>'required|min:4|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){
            echo $validator->errors()->first();
        }
        else if ($validator->passes())
        {   
            $newData = Request::all();
            $userFacebook = Socialize::with('facebook')->user();
            $checkUser = \App\User::Where('facebookId', $userFacebook->id)->first();
            if (is_null($checkUser)){
                $userLocal = \App\User::Create([
                'username'   => $newData['username'],
                'password'   => bcrypt($newData['password']),
                'facebookId' => $userFacebook->id,
                'firstName'  => $userFacebook->user['first_name'],
                'lastName'   => $userFacebook->user['last_name'],
                'email'      => $userFacebook->user['email'],
                'avatar'     => $userFacebook->avatar,
                // 'link'       => $userFacebook->user['link'],
                'confirmed'  => true,
                ]);
            }else {
                if($checkUser['original']['username'] == null){
                    $checkUser->username=$newData['username'];
                    $checkUser->password=bcrypt($newData['password']);
                    $checkUser->save();
                    $userLocal = $checkUser;
                }
                else {
                    $userLocal = $checkUser;
                }
            }
            Auth::login($userLocal);
            return null;
        }
    }

    public function facebookLogin(){
        if (Auth::check()) {
            $userLocal = Auth::user();
            return redirect ('home');
        }
        else {
            if(!(Request::has('code'))){
                return \Socialize::with('facebook')->redirect();
            }
            else {
                GuestController::facebook();
            }
        }
    }
    public function resetPasswordPage()
    {
        return view ('pages.guest.forgotPassword'); 
    }

    public function resetPassword(Requests\ForgotPasswordRequest $request)
    {
        
        $request = Request::all();
        $user = \App\User::Where('email', $request['email'])->firstOrFail();
        $confirmation_code = str_random(30);
        $user['confirmation_code'] = $confirmation_code;
        $user->save();
        $sendData = [
            'username' => $user['username'],
            'firstName' => $user['firstName'],
            'lastName' => $user['lastName'],
            'confirmation_code' => $user['confirmation_code'],
            'email' => $user['email'],
        ];

        Mail::send('email.forgot', $sendData, function($message) use ($sendData) {
                $message->to($sendData['email'], $sendData['username'])
                ->subject('Bluejack Online Learning Password Reset Verification');
        });

        $username = $user['username'];
        $email = $user['email'];
        Flash::message($username.', a verification has been sent to your mail, please check it.
            '.$email);

        return view ('pages.guest.successMessage');
    }
  
    public function resetVerifyPage($confirmation_code)
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
        else {
            return view('pages.guest.newPassword', compact($user));
        }
    }

    public function resetVerify(Requests\ConfirmPasswordRequest $request, $confirmation_code)
    {
        $requestData = Request::all();
        $user = \App\User::where('confirmation_code', $confirmation_code)->first();
        
        $user->password = bcrypt($requestData['password']);
        $user->confirmation_code = null;
        $user->save();
        $username = $user->username;
        Flash::message($username.' , you have successfully change your password');

        return view ('pages.guest.successMessage');
    }

    public function facebook(){
        $userFacebook = Socialize::with('facebook')->user();
        $checkUser = \App\User::Where('facebookId', $userFacebook->id)->first();
            // dd( $userFacebook);

        if (is_null($checkUser)){
            $userLocal = \App\User::firstOrCreate([
            'facebookId' => $userFacebook->id,
            'firstName'  => $userFacebook->user['first_name'],
            'lastName'   => $userFacebook->user['last_name'],
            'email'      => $userFacebook->user['email'],
            'avatar'     => $userFacebook->avatar,
            // 'link'       => $userFacebook->user['link'],
            'confirmed'  => true,
            ]);
        }else {
            $userLocal = $checkUser;
        }
        Auth::login($userLocal);
        return redirect ('home');
    }

    public function redirect(){
        return view('pages.guest.redirectLogin');
    }


    public function articleIndex()
    {
        $lessons = \App\Lesson::where('approval',1)->orderBy('created_at','desc')->paginate(5);
        return view ('pages.guest.viewArticle', compact('lessons'));
    }

    public function articleShow($id)
    {
        $article = \App\Article::findOrFail($id);
        $comments = \App\Comment::where('articleId', $article->id)->orderBy('created_at','asc')->paginate(5);
        $data = ['articleId'=>$article->id, 
        'categoryId' =>$article->lesson->category->id,
        ];
        \App\ViewArticle::Create($data);
        $article->viewCount+=1;
        $article->save();
        $article->lesson->viewCount += 1;
        $article->lesson->save();
        return view('pages.guest.article', compact('article', 'comments'));
    }

    public function lessonIndexLatest($sort)
    {
        if (Request::has('search')){
            $search = Request::get('search');
            // return $search;
            if ($sort !=null && ($sort== 'asc' || $sort=='desc')){
                $lessons = \App\Lesson::where('approval', true)->where('title', 'like', '%'.$search.'%')->orderBy('created_at', $sort)->paginate(5);
            }
            else {
                $lessons = \App\Lesson::where('approval', true)->where('title', 'like', '%'.$search.'%')->orderBy('created_at','desc')->paginate(5);
            }
        }
        else {
            if ($sort !=null && ($sort== 'asc' || $sort=='desc')){
                $lessons = \App\Lesson::where('approval', true)->orderBy('created_at', $sort)->paginate(5);
            }
            else {
                $lessons = \App\Lesson::where('approval', true)->orderBy('created_at','desc')->paginate(5);
            }
        }
        
        return view ('pages.guest.viewLessonNew', compact('lessons'));
    }

    public function lessonIndexPopular($sort)
    {

        if (Request::has('search')){
            $search = Request::get('search');
            // return $search;
            if ($sort !=null && ($sort== 'asc' || $sort=='desc')){
                $lessons = \App\Lesson::where('approval', true)->where('title', 'like', '%'.$search.'%')->orderBy('viewCount', $sort)->paginate(5);
            }
            else {
                $lessons = \App\Lesson::where('approval', true)->where('title', 'like', '%'.$search.'%')->orderBy('viewCount','desc')->paginate(5);
            }
        }
        else{
            if ($sort !=null && ($sort== 'asc' || $sort=='desc')){
                $lessons = \App\Lesson::where('approval', true)->orderBy('viewCount', $sort)->paginate(5);
            }
            else {
                $lessons = \App\Lesson::where('approval', true)->orderBy('viewCount','desc')->paginate(5);
            }
        }
        return view ('pages.guest.viewLessonNew', compact('lessons'));
    }

    public function lessonIndex()
    {
        $categories = \App\LessonCategory::orderBy('created_at','desc')->paginate(5);
        $orderby = 'created_at';
        $sortby = 'desc';
        return view ('pages.guest.viewLesson', compact('categories', 'orderby', 'sortby'));
    }

    public function lessonShow($id)
    {

        $lesson = \App\Lesson::findOrFail($id);
        $comments = \App\Comment::where('lessonId', $lesson->id)->orderBy('created_at','asc')->get()->all();
        $articles = \App\Article::where('lessonId', $lesson->id)->orderBy('created_at','desc')->paginate(5);
        if ($lesson->approval == true){
            $lesson->viewCount += 1;
            $lesson->save();
            return view('pages.guest.lesson', compact('lesson', 'articles', 'comments'));       
        }
        else {
            abort(404);
        }
    }

    public function discussionIndexLatest($sort)
    {     
        if (Request::has('search')){
            $search = Request::get('search');
            // return $search;
            if ($sort !=null && ($sort== 'asc' || $sort=='desc')){
                $discussions = \App\Discussion::where('title', 'like', '%'.$search.'%')->orderBy('created_at', $sort)->paginate(5);
            }
            else {
                $discussions = \App\Discussion::where('title', 'like', '%'.$search.'%')->orderBy('created_at','desc')->paginate(5);
            }
        }
        else {
            if ($sort !=null && ($sort== 'asc' || $sort=='desc')){
                $discussions = \App\Discussion::orderBy('created_at', $sort)->paginate(5);
            }
            else {
                $discussions = \App\Discussion::orderBy('created_at','desc')->paginate(5);
            }
        }       

        return view ('pages.guest.viewDiscussionNew',  compact('discussions'));
    }

    public function discussionIndexPopular($sort)
    { 
         if (Request::has('search')){
            $search = Request::get('search');
            // return $search;
            if ($sort !=null && ($sort== 'asc' || $sort=='desc')){
                $discussions = \App\Discussion::where('title', 'like', '%'.$search.'%')->orderBy('viewCount', $sort)->paginate(5);
            }
            else {
                $discussions = \App\Discussion::where('title', 'like', '%'.$search.'%')->orderBy('viewCount','desc')->paginate(5);
            }
        }
        else{
            if ($sort !=null && ($sort== 'asc' || $sort=='desc')){
                $discussions = \App\Discussion::orderBy('viewCount', $sort)->paginate(5);
            }
            else {
                $discussions = \App\Discussion::orderBy('viewCount','desc')->paginate(5);
            }
        }
        
        return view ('pages.guest.viewDiscussionNew',  compact('discussions'));
    }

    public function discussionIndex()
    {        
        $categories = \App\LessonCategory::orderBy('created_at','desc')->paginate(5);
        return view ('pages.guest.viewDiscussion', compact('categories'));
    }

    public function discussionShow($id)
    {
        $discussion = \App\Discussion::findOrFail($id);
        $comments = \App\Comment::where('discussionId', $discussion->id)->orderBy('created_at','asc')->paginate(7);
        $discussion->viewCount+=1;
        $discussion->save();
        return view('pages.guest.discussion', compact('discussion', 'comments'));
    }
}