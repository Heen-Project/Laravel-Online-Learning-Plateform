
@extends('master.masterUser')

@section('section_1')
<main class="display_6">
<section>
	<h1>{{ $discussion->title }}</h1>@include('include.etc.creatorName.creatorNameDiscussion')
   <br>
   <hr>
  <p>{!! html_entity_decode($discussion->description) !!}</p>
</section>
</main>
@stop

@section('section_2')
@include('include.etc.commentShow')
{!! $comments->render() !!}
@if ($discussion->status == true)
	{!! Form::open(['action'=>'CommentController@storeDiscussion']) !!}
	{!! Form::hidden('userId', Auth::user()->id ) !!}
	{!! Form::hidden('discussionId', $discussion->id ) !!}
@include('include.etc.commentForm')
@endif
@stop