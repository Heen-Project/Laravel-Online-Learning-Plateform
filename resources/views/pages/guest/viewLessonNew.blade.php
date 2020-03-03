@extends('master.masterGuest')

@section('section_1')
<main class="display_2">
  <h1>{{ trans('dictionary.lesson') }}</h1>
  {!! Form::open(['url'=>'/guest/lesson/'.Request::segment(3).'/'.Request::segment(4), 'method'=>'GET']) !!}
  <div align="right">
    {!! Form::text('search', null, ['id'=>'searchBox']) !!}
    {!! Form::submit(trans('dictionary.search'), ['class'=>' font', 'id'=>'searchButton']) !!}
  </div>
  {!! Form::close() !!}
  <h4><span style="float:left;">{{ trans('dictionary.sort_by') }}: <a href="{{ action('GuestController@lessonIndexLatest') }}">{{ trans('dictionary.created_date') }}</a> | <a href="{{ action('GuestController@lessonIndexPopular') }}">{{ trans('dictionary.view_count') }}</a></span><span style="float:right">{{ trans('dictionary.order_by') }}: <a href="/guest/lesson/{{Request::segment(3)}}/asc"> Asc</a> | <a href="/guest/lesson/{{Request::segment(3)}}/desc">Desc</a></span></h4>
  <br>
  @foreach($lessons as $lesson)
  <ul>
    <li>
      <h3 class="guestLightColor"><span><a href="{{action('GuestController@lessonShow', $lesson->id)}}" class="tooltip" title="{{ date('F d, Y', strtotime($lesson->created_at))}}">{{ $lesson->title }}</a></span>@include('include.etc.creatorName.creatorNameLesson')</h3>
      <a href="{{action('GuestController@lessonShow', $lesson->id)}}">
        <p>{!! html_entity_decode(str_limit($lesson->description, 250, '...')) !!}</p>  
      </a>
    </li>
  </ul>
  @endforeach  

</main>
{!! $lessons->appends(Request::except('page'))->render() !!}
@stop