@extends('master.masterGuest')

@section('section_1')
<main class="display_2">
    <h1>Lesson</h1>
  
  <br>
    @foreach($categories as $category)
    <ul>
      <h2  class="guestDarkColor">{{ $category->category }}</h2>
       @foreach($category->lessons()->where('approval', true)->orderBy('created_at','desc')->take(2)->get()->all() as $lesson)
        <li>
          <h3 class="guestLightColor"><span><a href="{{action('GuestController@lessonShow', $lesson->id)}}" class="tooltip" title="{{ date('F d, Y', strtotime($lesson->created_at))}}">{{ $lesson->title }}</a></span>@include('include.etc.creatorName.creatorNameLesson')</h3>
          <a href="{{action('GuestController@lessonShow', $lesson->id)}}">
            <p>{!! html_entity_decode(str_limit($lesson->description, 250, '...')) !!}</p>  
          </a>
       </li>
    	@endforeach
    </ul>
    @endforeach  

</main>
{!! $categories->appends(Request::except('page'))->render() !!}
@stop