@extends('master.masterUser')

@section('section_1')
	<section class="form font">
    <h1>{{trans('dictionary.create_article')}}</h1>
    {!! Form::open(['action'=>'ArticleController@store', 'files' => true]) !!}
    <div>
      {!! Form::label('title',  trans('dictionary.title').' : ', ['class'=>'label']) !!}
      {!! Form::text('title', null, ['class'=>'textBox']) !!}
      {!! Form::label('lesson',  trans('dictionary.lesson').' : ', ['class'=>'label']) !!}
      {!! Form::select('lesson', $lessons, null, ['class'=>'dropDown']) !!}
      {!! Form::label('description',  trans('dictionary.article_content').' : ', ['class'=>'label']) !!}
      {!! Form::textarea('description', null, ['class'=>'textArea']) !!}
      {!! Form::label('file',  trans('dictionary.image_or_video').' : ', ['class'=>'label']) !!}
      {!! Form::file('file', ['class'=>'file', 'accept'=>'.png, .jpeg, .gif, .jpg, .webm, .ogv, .mp4']) !!}
      @if ($errors->any())
			<ul class="errForm">
				@foreach ($errors->all() as $error)
	      <li>
	      	{{ $error }}
	      </li>
	      @endforeach
      </ul>
			@endif
      {!! Form::submit(trans('dictionary.create'), ['class'=>'userLightColor userButton font', 'style'=>'width:99%']) !!}
      {!! Form::close() !!}
    </div>

    @include('include.etc.scriptJQueryTextEditor')
</section>
@stop
