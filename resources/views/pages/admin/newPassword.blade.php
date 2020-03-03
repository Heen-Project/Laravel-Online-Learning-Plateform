@extends('master.masterAdmin')

@section('section_1')
  <section style="width:30%;margin:3% auto;" class="form">
    <header class="adminLightColor">
    <h3>{{trans('dictionary.change_password')}}</h3>
    </header>
     {!! Form::open(['method'=>'PUT', 'action'=>['RegisteredController@changePassword'] ]) !!}
    <div >
      {!! Form::label('password', trans('dictionary.password').' : ', ['class'=>'label']) !!}
      {!! Form::password('password', ['class'=>'textBox']) !!}
      {!! Form::label('password_confirmation', trans('dictionary.password_confirmation').' : ', ['class'=>'label']) !!}
      {!! Form::password('password_confirmation', ['class'=>'textBox']) !!}
      {!! Form::hidden('confirmation_code', $confirmation_code)!!}
      
        @if ($errors->any())
        <ul class="errRegister">
          @foreach ($errors->all() as $error)
            <li style="margin:2% auto;padding:1%;">
              {{ $error }}
            </li>
          @endforeach
        </ul>
        @endif
			{!! Form::submit(trans('dictionary.change_password'), ['class'=>'adminLightColor adminButton', 'style'=>'margin:3% auto;font-size:18px;width:99%']) !!}
    </div>
    {!! Form::close() !!}
  </section>
@stop