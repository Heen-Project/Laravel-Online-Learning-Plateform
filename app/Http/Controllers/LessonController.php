<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function __construct()
    {
        $this->middleware('registered');
    }
    
    public function indexPopular($sort)
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
        $user = Auth::user();
        if ($user->role == 'user')
            return view ('pages.user.viewLessonNew', compact('user', 'lessons'));
        else if ($user->role == 'admin') 
            return view ('pages.admin.viewLessonNew', compact('user', 'lessons'));
    }

    public function indexLatest($sort)
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
        else{
            if ($sort !=null && ($sort== 'asc' || $sort=='desc')){
                $lessons = \App\Lesson::where('approval', true)->orderBy('created_at', $sort)->paginate(5);
            }
            else {
                $lessons = \App\Lesson::where('approval', true)->orderBy('created_at','desc')->paginate(5);
            }
        }
        $user = Auth::user();

        if ($user->role == 'user')
            return view ('pages.user.viewLessonNew', compact('user', 'lessons'));
        else if ($user->role == 'admin') 
            return view ('pages.admin.viewLessonNew', compact('user', 'lessons'));
    }



    public function index()
    {
        
        //$lessons = \App\Lesson::all();
        $user = Auth::user();
        $categories = \App\LessonCategory::orderBy('created_at','desc')->paginate(5);
        $orderby = 'created_at';
        $sortby = 'desc';
        if ($user->role == 'user')
            // return redirect ('lesson/redirect?page=1&orderby=desc&sortby=created_at');
            return view ('pages.user.viewLesson', compact('user', 'categories', 'orderby', 'sortby'));
        else if ($user->role == 'admin') 
            // return redirect ('lesson/redirect?page=1&orderby=desc&sortby=created_at');
            return view ('pages.admin.viewLesson', compact('user', 'categories', 'orderby', 'sortby'));

        // if ($user->role == 'user')
        //     return view ('pages.user.viewLesson', compact('user', 'categories'));
        // else if ($user->role == 'admin') 
        //     return view ('pages.admin.viewLesson', compact('user', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        $categories = \App\Lessoncategory::orderBy('created_at','desc')->lists('category', 'id');
        if ($user->role == 'user')
            return view ('pages.user.createLesson', compact('user', 'categories'));
        else if ($user->role == 'admin') 
            return view ('pages.admin.createLesson', compact('user', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\LessonCreateRequest $validator)
    {
        $request = Request::all();
        $user = Auth::user();
        if ($user->role == 'user'){
             $data = [
                'userId'        => $user->id,
                'categoryId'    => $request['category'],
                'title'         => $request['title'],
                'description'   => $request['description'],
            ];
            flash('You submit a new Lesson, waiting admin approval');
        }
        else if ($user->role == 'admin') {
            $data = [
                'userId'        => $user->id,
                'categoryId'    => $request['category'],
                'title'         => $request['title'],
                'description'   => $request['description'],
                'adminCheck'    => true,
                'approval'      => true,                
            ];
             flash()->success('Successfully created a new lesson');
        }
        \App\Lesson::Create($data);

        return redirect ('lesson');       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // $comments = App\Post::find(1)->comments;
        $user = Auth::user();
        $lesson = \App\Lesson::findOrFail($id);
        $articles = \App\Article::where('lessonId', $lesson->id)->orderBy('created_at','desc')->paginate(7);
        $comments = \App\Comment::withTrashed()->where('lessonId', $lesson->id)->orderBy('created_at','asc')->get()->all();
        // dd($comments);
        // return $comments->get()->all();
        if ($lesson->approval == true){
            $lesson->viewCount += 1;
            $lesson->save();
            if ($user->role == 'user')
                return view('pages.user.lesson', compact('lesson', 'articles', 'comments'));
            else if ($user->role == 'admin') 
                return view('pages.admin.lesson', compact('lesson', 'articles', 'comments'));
            
        }
        else {
            abort(404);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
