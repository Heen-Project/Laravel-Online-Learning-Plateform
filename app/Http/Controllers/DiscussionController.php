<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Request;

class DiscussionController extends Controller
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
        $user = Auth::user();
        if ($user->role == 'user')
            return view ('pages.user.viewDiscussionNew', compact('user', 'discussions'));
        else if ($user->role == 'admin') 
            return view ('pages.admin.viewDiscussionNew', compact('user', 'discussions'));
    }

    public function indexLatest($sort)
    {
        if (Request::has('search')){
            $search = Request::get('search');
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
        
        $user = Auth::user();

        if ($user->role == 'user')
            return view ('pages.user.viewDiscussionNew', compact('user', 'discussions'));
        else if ($user->role == 'admin') 
            return view ('pages.admin.viewDiscussionNew', compact('user', 'discussions'));
    }

    public function index()
    {
        $user = Auth::user();
        $categories = \App\LessonCategory::orderBy('created_at','desc')->paginate(5);
        if ($user->role == 'user')
            return view ('pages.user.viewDiscussion', compact('user', 'categories'));
        else if ($user->role == 'admin')
            return view ('pages.admin.viewDiscussion', compact('user', 'categories'));
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
            return view ('pages.user.createDiscussion', compact('user', 'categories'));
        else if ($user->role == 'admin') 
            return view ('pages.admin.createDiscussion', compact('user', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\DiscussionCreateRequest $validator)
    {
        $request = Request::all();
        $user = Auth::user();
        $data = [
                'userId'        => $user->id,
                'categoryId'    => $request['category'],
                'title'         => $request['title'],
                'description'   => $request['description'],
            ];
        flash()->success('Successfully created a new discussion');
        \App\Discussion::Create($data);

        // Post a Comment +1, Delete a Comment -1, Comment Report Inappropriate -5
        // Submitted Course / Lesson Approved +50
        // Open a Discussion +1, Discussion Closed +10, Discussion Deleted -30
        $discussion = \App\Discussion::where('title', $request['title'])->first();
        if ($user->role =='user'){
            $userActivity = ['userId' => $user->id,
              'destinationId' => $discussion->id,
              'typeId' => 3,
              'point' => 1,
              'content' => $request['title'], 
              'description'=> 'Open a Discussion'];
            \App\UserActivity::Create($userActivity);
            $user->point +=1;
            $user->save();
        }

        return redirect ('discussion');       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $discussion = \App\Discussion::findOrFail($id);
        $comments = \App\Comment::withTrashed()->where('discussionId', $discussion->id)->orderBy('created_at','asc')->paginate(7);
        $discussion->viewCount+=1;
        $discussion->save();
        if ($user->role == 'user')
            return view('pages.user.discussion', compact('discussion', 'comments'));
        else if ($user->role == 'admin') 
            return view('pages.admin.discussion', compact('discussion', 'comments'));
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
