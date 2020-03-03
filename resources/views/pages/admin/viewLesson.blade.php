@extends('master.masterAdmin')

@section('section_1')
<main class="display_2">
  <!-- <header class="adminLightColor"> -->
    <h1>Lesson</h1>
  <!-- </header> -->
  
  <!-- <h4><span style="float:left;">Sort By: <a href="redirect?page=1&orderby={{ Request::get('orderby') }}&sortby=created_at">Create Date</a> | <a href="redirect?page=1&orderby={{ Request::get('orderby') }}&sortby=viewCount">View Count</a></span><span style="float:right">Order By: <a href="redirect?page=1&orderby=asc&sortby={{ Request::get('sortby') }}"> ASC</a> | <a href="redirect?page=1&orderby=desc&sortby={{ Request::get('sortby') }}">DESC</a></span></h4> -->
    <br>
    @foreach($categories as $category)
    <ul>
      <h2  class="adminDarkColor">{{ $category->category }}</h2>
       @foreach($category->lessons()->where('approval', true)->orderBy('created_at','desc')->take(2)->get()->all() as $lesson)
        <li>
          <h3 class="adminLightColor"><span><a href="{{action('LessonController@show', $lesson->id)}}" class="tooltip" title="{{ date('F d, Y', strtotime($lesson->created_at))}}">{{ $lesson->title }}</a></span>@include('include.etc.creatorName.creatorNameLesson')</h3>
          <a href="{{action('LessonController@show', $lesson->id)}}">
            <p>{!! html_entity_decode(str_limit($lesson->description, 250, '...')) !!}</p>  
          </a>
       </li>
    	@endforeach
    </ul>
    @endforeach  

</main>
{!! $categories->appends(Request::except('page'))->render() !!}
@stop