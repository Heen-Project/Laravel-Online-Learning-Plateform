@extends('master.masterAdmin')

@section('section_1')
<main class="display_2">
  <!-- <header class="adminLightColor"> -->
    <h1>{{ trans('dictionary.lesson') }}</h1>
  <!-- </header> -->
    {!! Form::open(['url'=>'/lesson/'.Request::segment(2).'/'.Request::segment(3), 'method'=>'GET']) !!}
  <div align="right">
    {!! Form::text('search', null, ['id'=>'searchBox']) !!}
    <!-- {{--!! Form::hidden('sort', Request::segment(3), ['style'=>'display:none']) !!--}} -->
    {!! Form::submit(trans('dictionary.search'), ['class'=>' font', 'id'=>'searchButton']) !!}
  </div>
  {!! Form::close() !!}
  <h4><span style="float:left;">{{ trans('dictionary.sort_by') }}: <a href="{{ action('LessonController@indexLatest') }}">{{ trans('dictionary.created_date') }}</a> | <a href="{{ action('LessonController@indexPopular') }}">{{ trans('dictionary.view_count') }}</a></span><span style="float:right">{{ trans('dictionary.order_by') }}: <a href="/lesson/{{Request::segment(2)}}/asc"> Asc</a> | <a href="/lesson/{{Request::segment(2)}}/desc">Desc</a></span></h4>
    <br>
    @foreach($lessons as $lesson)
    <ul>
      <li>
          <h3 class="adminLightColor"><span><a href="{{action('LessonController@show', $lesson->id)}}" class="tooltip" title="{{ date('F d, Y', strtotime($lesson->created_at))}}">{{ $lesson->title }}</a></span>@include('include.etc.creatorName.creatorNameLesson')</h3>
          <a href="{{action('LessonController@show', $lesson->id)}}">
            <p>{!! html_entity_decode(str_limit($lesson->description, 250, '...')) !!}</p>  
          </a>
       </li>
    </ul>
    @endforeach  

</main>
{!! $lessons->appends(Request::except('page'))->render() !!}
@stop