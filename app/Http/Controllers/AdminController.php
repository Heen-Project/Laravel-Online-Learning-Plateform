<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function approvalPage()
    {
        $lessons = \App\Lesson::where('adminCheck',false)->get();
        return view ('pages.admin.lessonApproval', compact('lessons'));
    }
    public function approval(Requests\LessonApprovalRequest $request)
    {
        //string substr ( string $string , int $start [, int $length ] )
        $id = substr($request['approvalStatus'], 7);
        $status = substr($request['approvalStatus'], 0,7);
        $lesson = \App\Lesson::findOrFail($id);
        if ($status == 'approve'){
            $lesson->approval = true;

            // Post a Comment +1, Delete a Comment -1, Comment Report Inappropriate -5
            // Submitted Course / Lesson Approved +50
            // Open a Discussion +1, Discussion Closed +10, Discussion Deleted -30
            if ($lesson->creator->role =='user'){
                $userActivity = ['userId' => $lesson->creator->id,
                  'destinationId' => $lesson->id,
                  'typeId' => 1,
                  'point' => 50,
                  'content' => $lesson->title, 
                  'description'=> 'Submitted Course / Lesson Approved'];
                \App\UserActivity::Create($userActivity);
                $lesson->creator->point +=50;
                $lesson->creator->save();
            }

        }
        

        $lesson->adminCheck = true;
        $lesson->save();
        flash()->success('Lesson checked');
        return redirect('admin/lessonApproval');    
    }

    public function pendingLesson($id)
    {
    	$lesson = \App\Lesson::findOrFail($id);
	    return view('pages.admin.lesson', compact('lesson'));
    }

    public function deleteDiscussion($id)
    {
        $discussion = \App\Discussion::findOrFail($id);

        // Post a Comment +1, Delete a Comment -1, Comment Report Inappropriate -5
        // Submitted Course / Lesson Approved +50
        // Open a Discussion +1, Discussion Closed +10, Discussion Deleted -30
        if ($discussion->creator->role =='user'){
            $userActivity = ['userId' => $discussion->creator->id,
              'destinationId' => $discussion->id,
              'typeId' => 3,
              'point' => -30,
              'content' => $discussion->title, 
              'description'=> 'Discussion Deleted'];
            \App\UserActivity::Create($userActivity);
            $discussion->creator->point -=30;
            $discussion->creator->save();
        }
        


        $discussion->delete();
        flash()->success('Disscussion Deleted');
        return redirect()->back();
    }

    public function closeDiscussion($id)
    {
        $discussion = \App\Discussion::findOrFail($id);
        $discussion->status=false;

        // Post a Comment +1, Delete a Comment -1, Comment Report Inappropriate -5
        // Submitted Course / Lesson Approved +50
        // Open a Discussion +1, Discussion Closed +10, Discussion Deleted -30
        if ($discussion->creator->role =='user'){
            $userActivity = ['userId' => $discussion->creator->id,
              'destinationId' => $discussion->id,
              'typeId' => 3,
              'point' => 10,
              'content' => $discussion->title, 
              'description'=> 'Discussion Closed'];
            \App\UserActivity::Create($userActivity);
            $discussion->creator->point +=10;
            $discussion->creator->save();
        }
        

        $discussion->save();
        flash()->success('Disscussion Closed');
        return redirect()->back();
    }

    public function inappropriateComment()
    {
        $request = Request::all();
        // return $request;
        $comment = \App\Comment::findOrFail($request['id']);

        // Post a Comment +1, Delete a Comment -1, Comment Report Inappropriate -5
        // Submitted Course / Lesson Approved +50
        // Open a Discussion +1, Discussion Closed +10, Discussion Deleted -30
        if ($comment->creator->role =='user'){
            $userActivity = ['userId' => $comment->creator->id,
              'destinationId' => $comment->id,
              'typeId' => 2,
              'point' => -5,
              'content' => $comment->content, 
              'description'=> 'Comment Report Inappropriate'];
            \App\UserActivity::Create($userActivity);
            $comment->creator->point -=5;
            $comment->creator->save();
        }
        

        $comment->inappropriate = true;
        $comment->save();
        $comment->delete();
        flash()->success('Comment successfully mark inappropriate');
        return redirect()->back();
    }
}
