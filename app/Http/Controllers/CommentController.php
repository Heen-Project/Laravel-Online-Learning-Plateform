<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('registered');
    }

    public function storeLesson(Requests\CommentRequest $request)
    {
    	$data = [
    		'userId' => $request->userId,
    		'lessonId' => $request->lessonId,
    		'content' => $request->content,
    	];
        \App\Comment::Create($data); 

        // Post a Comment +1, Delete a Comment -1, Comment Report Inappropriate -5
        // Submitted Course / Lesson Approved +50
        // Open a Discussion +1, Discussion Closed +10, Discussion Deleted -30
        $comment = \App\Comment::where('content', $request->content)->first();
        if ($comment->creator->role =='user'){
            $userActivity = ['userId' => $comment->creator->id,
              'destinationId' => $comment->id,
              'typeId' => 2,
              'point' => 1,
              'content' => $comment->content, 
              'description'=> 'Post a Comment'];
            \App\UserActivity::Create($userActivity);
            $comment->creator->point +=1;
            $comment->creator->save();
        }
        

    	flash()->success('Comment Added');
    	return redirect()->back();
    }

    public function storeArticle(Requests\CommentRequest $request)
    {
    	$data = [
    		'userId' => $request->userId,
    		'articleId' => $request->articleId,
    		'content' => $request->content,
    	];
        \App\Comment::Create($data); 

        // Post a Comment +1, Delete a Comment -1, Comment Report Inappropriate -5
        // Submitted Course / Lesson Approved +50
        // Open a Discussion +1, Discussion Closed +10, Discussion Deleted -30
        $comment = \App\Comment::where('content', $request->content)->first();
        if ($comment->creator->role =='user'){
            $userActivity = ['userId' => $comment->creator->id,
              'destinationId' => $comment->id,
              'typeId' => 2,
              'point' => 1,
              'content' => $comment->content, 
              'description'=> 'Post a Comment'];
            \App\UserActivity::Create($userActivity);
            $comment->creator->point +=1;
            $comment->creator->save();
        }

    	flash()->success('Comment Added');
    	return redirect()->back();
    }

    public function storeDiscussion(Requests\CommentRequest $request)
    {
    	$data = [
    		'userId' => $request->userId,
    		'discussionId' => $request->discussionId,
    		'content' => $request->content,
    	];
        \App\Comment::Create($data); 

        // Post a Comment +1, Delete a Comment -1, Comment Report Inappropriate -5
        // Submitted Course / Lesson Approved +50
        // Open a Discussion +1, Discussion Closed +10, Discussion Deleted -30
        $comment = \App\Comment::where('content', $request->content)->first();
        if ($comment->creator->role =='user'){
            $userActivity = ['userId' => $comment->creator->id,
              'destinationId' => $comment->id,
              'typeId' => 2,
              'point' => 1,
              'content' => $comment->content, 
              'description'=> 'Post a Comment'];
            \App\UserActivity::Create($userActivity);
            $comment->creator->point +=1;
            $comment->creator->save();
        }
        

    	flash()->success('Comment Added');
    	return redirect()->back();
    }

    public function updateComment()
    {
        $request = Request::all();
        $comment = \App\Comment::findOrFail($request['id']);
        $comment->content = $request['content'];
        $comment->save();
        flash()->success('Comment successfully edited');
        return redirect()->back();
    }

    public function deleteComment()
    {
        $request = Request::all();
        $comment = \App\Comment::findOrFail($request['id']);

        // Post a Comment +1, Delete a Comment -1, Comment Report Inappropriate -5
        // Submitted Course / Lesson Approved +50
        // Open a Discussion +1, Discussion Closed +10, Discussion Deleted -30
        if ($comment->creator->role =='user'){
            $userActivity = ['userId' => $comment->creator->id,
              'destinationId' => $comment->id,
              'typeId' => 2,
              'point' => -1,
              'content' => $comment->content, 
              'description'=> 'Delete a Comment'];
            \App\UserActivity::Create($userActivity);
            $comment->creator->point -=1;
            $comment->creator->save();
        }
        

        $comment->delete();
        flash()->success('Comment successfully deleted');
        return redirect()->back();
    }
}
