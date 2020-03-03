@extends('master.masterAdmin')

@section('section_1')
	<section class="form font">
    <!-- <header class="adminLightColor"> -->
    <h1>{{trans('dictionary.lesson_category')}}</h1>
    <!-- </header> -->
    {!! Form::open(['action'=>'LessonCategoryController@store']) !!}
    <div>
      {!! Form::label('category',  trans('dictionary.category').' : ', ['class'=>'label']) !!}
      {!! Form::text('category', null, ['class'=>'textBox']) !!}
      </div>
      @if ($errors->any())
        <ul class="errForm">
          @foreach ($errors->all() as $error)
            <li>
              {{ $error }}
            </li>
          @endforeach
        </ul>
        @endif
      {!! Form::submit(trans('dictionary.create'), ['class'=>'adminLightColor adminButton font', 'style'=>'width:99%']) !!}
    {!! Form::close() !!}
</section>
@stop