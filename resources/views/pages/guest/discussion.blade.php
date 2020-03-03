@extends('master.masterGuest')

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
@include('include.guest.commentShowGuest')
{!! $comments->render() !!}
@stop