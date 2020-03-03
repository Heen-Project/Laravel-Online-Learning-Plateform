@extends('master.masterUser')

@section('section_1')
<main class="display_2">
    <h1>{{ trans('dictionary.article') }}</h1>
  
    @foreach($lessons as $lesson)
    <ul>
      <h2  class="userDarkColor">{{ $lesson->title }}</h2>
      @foreach($lesson->articles()->orderBy('created_at', 'desc')->take(2)->get()->all() as $article)
        <li>
          <h3 class="userLightColor"><span><a href="{{action('ArticleController@show', $article->id)}}" class="tooltip" title="{{ date('F d, Y', strtotime($article->created_at))}}">{{ $article->title }}</a></span> @include('include.etc.creatorName.creatorNameArticle')</h3>
          <a href="{{action('ArticleController@show', $article->id)}}">
            {!! html_entity_decode(str_limit($article->description, 500, '...')) !!}
          </a>
       </li>
    	@endforeach
    </ul>
    @endforeach  
</main>
{!! $lessons->render() !!}
@stop