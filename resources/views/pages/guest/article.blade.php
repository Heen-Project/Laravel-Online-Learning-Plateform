@extends('master.masterGuest')

@section('section_1')
<main class="display_1">
   <h1>{{ $article->title }}</h1>@include('include.etc.creatorName.creatorNameArticle')
   <br>
   <hr>
  {!! html_entity_decode($article->description) !!}
</main>
@stop

@section('section_2')
@include('include.guest.commentShowGuest')
{!! $comments->render() !!}
@stop