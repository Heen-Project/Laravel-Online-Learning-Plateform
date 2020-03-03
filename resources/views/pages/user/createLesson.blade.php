@extends('master.masterUser')

@section('section_1')
	<section class="form font">
    <h1>{{trans('dictionary.create_lesson')}}</h1>
    {!! Form::open(['action'=>'LessonController@store']) !!}
    <div>
      {!! Form::label('title', trans('dictionary.title').' : ', ['class'=>'label']) !!}
      {!! Form::text('title', null, ['class'=>'textBox']) !!}
      {!! Form::label('category', trans('dictionary.category').' : ', ['class'=>'label']) !!}
      {!! Form::select('category', $categories, null, ['class'=>'dropDown']) !!}
      {!! Form::label('description', trans('dictionary.short_description').' : ', ['class'=>'label']) !!}
      {!! Form::textarea('description', null, ['class'=>'textArea']) !!}

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