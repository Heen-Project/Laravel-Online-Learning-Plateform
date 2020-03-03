@extends('master.masterAdmin')

@section('section_1')
  <section class="form font">
    <h1>{{trans('dictionary.send_newsletter')}}</h1>
    <hr width="95%">
    {!! Form::open(['action'=>'SubscriberController@sendNewsletter', 'method'=>'POST']) !!}
    <div>
      {!! Form::textarea('news', null, ['class'=>'textArea']) !!}
      @if ($errors->any())
      <ul class="errForm">
        @foreach ($errors->all() as $error)
        <li>
          {{ $error }}
        </li>
        @endforeach
      </ul>
      @endif
      {!! Form::submit(trans('dictionary.send'), ['class'=>'adminLightColor adminButton font', 'style'=>'width:99%']) !!}
      {!! Form::close() !!}
    </div>

    @include('include.etc.scriptJQueryTextEditor')
</section>
@stop
