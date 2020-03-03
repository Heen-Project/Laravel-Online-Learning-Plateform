@extends('master.masterAdmin')

@section('section_1')
<main class="display_3">
  <!-- <header class="adminLightColor"> -->
    <h1>{{ $lesson->title }}</h1>@include('include.etc.creatorName.creatorNameLesson')
    <br>
    <hr>
  <!-- </header> -->
    <h2>{!! html_entity_decode($lesson->description) !!}</h2>
  	<ul>
    @foreach($articles as $article)
    	<li>
    		<h3><span><a href="{{action('ArticleController@show', $article->id)}}">{{ $article->title }}</a></span>@include('include.etc.creatorName.creatorNameArticle')</h3>
          <a href="{{action('ArticleController@show', $article->id)}}">
            <p>{!! html_entity_decode(str_limit($article->description, 250, '...')) !!}</p>  
          </a>
       </li>
    	@endforeach
    </ul>
</main>
{!! $articles->render() !!}
@stop

@section('section_2')
@include('include.etc.commentShow')
{!! Form::open(['action'=>'CommentController@storeLesson']) !!}
{!! Form::hidden('userId', Auth::user()->id ) !!}
{!! Form::hidden('lessonId', $lesson->id ) !!}
@include('include.etc.commentForm')
@stop