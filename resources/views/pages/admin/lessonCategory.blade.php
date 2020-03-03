@extends('master.masterAdmin')

@section('section_1')
<main class="display_3">
  <!-- <header class="adminLightColor"> -->
    <h1>{{ $lessonCategory->category }}</h1>
  <!-- </header> -->
  	<ul>
    @foreach($lessons as $lesson)
    	<li>
    		<h3><span><a href="{{action('LessonController@show', $lesson->id)}}">{{ $lesson->title }}</a></span> <span style="float:right;font-size:12px;vertical-align:middle;font-weight:normal;font-style:italic"><a href="">Created {{$lesson->created_at->diffForHumans()}} by {{$lesson->creator->username}}</a></span></h3>
          <a href="{{action('LessonController@show', $lesson->id)}}">
            <p>{!! html_entity_decode(str_limit($lesson->description, 250, '...')) !!}</p>  
          </a>
       </li>
    	@endforeach
    </ul>
</main>
{!! $lessons->render() !!}
@stop