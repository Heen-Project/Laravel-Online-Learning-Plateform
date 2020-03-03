<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
// use App\Http\Controllers\Controller;
use Request;

class LessonCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $lessonCategories = \App\LessonCategory::orderBy('created_at','desc')->paginate(5);
        return view('pages.admin.viewLessonCategory', compact('lessonCategories'));
        // return $LessonCategories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // return view ('LessonCategory.create');
        return view ('pages.admin.createLessonCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\LessonCategoryCreateRequest $request)
    {
        \App\LessonCategory::Create(Request::all());
        // LessonCategoryController::index();
        flash()->success('Successfully insert a new lesson category');
        return redirect ('admin/lessonCategory');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    // public function show(LessonCategory $LessonCategory)
    {
        $lessonCategory = \App\LessonCategory::findOrFail($id);
        $lessons = \App\Lesson::where('categoryId', $lessonCategory->id)->where('approval', true)->orderBy('created_at','desc')->paginate(5);
        // return $lessonCategory;
        return  view ('pages.admin.lessonCategory', compact('lessonCategory', 'lessons'));
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
