@extends('master.masterAdmin')

@section('section_1')
<main class="display_1">
  <!-- <header class="adminLightColor"> -->
   <h1>{{ $article->title }}</h1>@include('include.etc.creatorName.creatorNameArticle')
   <br>
   <hr>
  <!-- </header> -->
  {!! html_entity_decode($article->description) !!}
</main>
@stop

@section('section_2')
@include('include.etc.commentShow')
{!! $comments->render() !!}
{!! Form::open(['action'=>'CommentController@storeArticle']) !!}
{!! Form::hidden('userId', Auth::user()->id ) !!}
{!! Form::hidden('articleId', $article->id ) !!}
@include('include.etc.commentForm')
@stop