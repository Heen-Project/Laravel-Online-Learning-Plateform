@extends('master.masterGuest')

@section('section_1')
<main class="display_7">
	<h1>{{ trans('dictionary.discussion') }}</h1>
	<br>
	{!! Form::open(['url'=>'/guest/discussion/'.Request::segment(3).'/'.Request::segment(4), 'method'=>'GET']) !!}
	<div align="right">
		{!! Form::text('search', null, ['id'=>'searchBox']) !!}
		{!! Form::submit(trans('dictionary.search'), ['class'=>' font', 'id'=>'searchButton']) !!}
	</div>
	{!! Form::close() !!}
	<h4><span style="float:left;">{{ trans('dictionary.sort_by') }}: <a href="{{ action('GuestController@discussionIndexLatest') }}">{{ trans('dictionary.created_date') }}</a> | <a href="{{ action('GuestController@discussionIndexPopular') }}">{{ trans('dictionary.view_count') }}</a></span><span style="float:right">{{ trans('dictionary.order_by') }}: <a href="/guest/discussion/{{Request::segment(3)}}/asc"> Asc</a> | <a href="/guest/discussion/{{Request::segment(3)}}/desc">Desc</a></span></h4>
	<br>
	<ul>

		@foreach($discussions as $discussion)
		<li>
			<h3><span><a href="{{action('GuestController@discussionShow', $discussion->id)}}" class="tooltip" title="{{ date('F d, Y', strtotime($discussion->created_at))}}">{{ str_limit($discussion->title, 100, '...') }}</a></span>@include('include.etc.creatorName.creatorNameDiscussion')</h3>
		</li>

		@endforeach 
	</ul> 
</main>
{!! $discussions->appends(Request::except('page'))->render() !!}
@stop