<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Request;

class ArticleController extends Controller
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
    
    public function index()
    {
        $user = Auth::user();
        $lessons = \App\Lesson::where('approval',1)->orderBy('created_at','desc')->paginate(5);

        // $lessons = $temp();
        // dd( $temp);
        if ($user->role == 'user')
            return view ('pages.user.viewArticle', compact('user', 'lessons'));
        else if ($user->role == 'admin') 
            return view ('pages.admin.viewArticle', compact('user', 'lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        $temp = \App\Lesson::where('approval',1);
        $lessons = $temp->lists('title', 'id');
        // $lessons = \App\Lesson::lists('title', 'id');
        if ($user->role == 'user')
            return view ('pages.user.createArticle', compact('user', 'lessons'));
        else if ($user->role == 'admin') 
            return view ('pages.admin.createArticle', compact('user', 'lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\ArticleCreateRequest $validator)
    {
        $request = Request::all();
        $user = Auth::user();

        $fileName= Request::file('file')->getClientOriginalName();
        $content = '';
        $extension = '';
        $info = '';
        // return $fileName;
        // dd (Request::hasFile('uploadedFile'));
        if(Request::hasFile('file')){
            // echo 'ada file ';
            if (Request::file('file')->isValid())
            {
                // echo 'no problem';
                $extension = Request::file('file')->getClientOriginalExtension();
                if ($extension == 'png' || $extension == 'jpeg' || $extension == 'gif'|| $extension == 'jpg'){
                    Request::file('file')->move(public_path().'\uploaded\image\\', $fileName);
                    // $content = '<img src="'.public_path().'\uploaded\image\\'.$fileName.'" style="display:block;" width="200px" height="200px">';
                    $content = '<img src="/uploaded/image/'.$fileName.'" width="80%">';
                    $info=', image successfully uploaded';
                }
                else if ($extension == 'mp4' || $extension == 'ogv' || $extension == 'webm'){
                    Request::file('file')->move(public_path().'\uploaded\video\\', $fileName);
                    //<source src="'.public_path().'\uploaded\video\\'.$fileName.'" type="video/'.$extension.'">
                    $content='<div id="video-container">'.
                              '<video id="video" width="100%">'.
                                '<source src="/uploaded/video/'.$fileName.'" type="video/'.$extension.'">'.
                                '<p>'.
                                  'Play Failed'.
                                '</p>'.
                              '</video>'.
                              '<div id="video-controls">'.
                                '<button type="button" id="play-pause"><i class="fa fa-play-circle"></i></button>'.
                                '<button type="button" id="stop"><i class="fa fa-stop"></i></button>'.
                                '<input type="range" id="seek-bar" value="0">'.
                                '<button type="button" id="fast-forward"><i class="fa fa-forward"></i></button>'.
                                '<input type="range" id="volume-bar" min="0" max="1" step="0.05" value="1">'.
                                '<button type="button" id="mute"><i class="fa fa-volume-up"></i></button>'.
                                '<button type="button" id="full-screen"><i class="fa fa-expand"></i></button>'.
                              '</div>'.
                            '</div>';
                     $info=', video successfully uploaded';
                }
            }
        }
        $description =  $content.'<p>'.$request['description'].'</p>';

        // return $content;
        // dd($request, $user, $description);


        $data = [
            'userId'        => $user->id,
            'lessonId'      => $request['lesson'],
            'title'         => $request['title'],
            'description'   => $description,
        ];
        flash()->success('Successfully created a new article'.$info);
        \App\Article::Create($data);
        return redirect ('article');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    // public function show(Article $article)
    {
        $article = \App\Article::findOrFail($id);
        $user = Auth::user();
        $comments = \App\Comment::withTrashed()->where('articleId', $article->id)->orderBy('created_at','asc')->paginate(7);

        $data = ['userId'=> $user->id,
        'articleId'=>$article->id,
        'categoryId' =>$article->lesson->category->id,
        ];
        \App\ViewArticle::Create($data);
        $article->viewCount += 1;
        $article->save();
        $article->lesson->viewCount += 1;
        $article->lesson->save();

        if ($user->role == 'user')
            return view('pages.user.article', compact('article', 'comments'));
        else if ($user->role == 'admin') 
            return view('pages.admin.article', compact('article', 'comments'));
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
