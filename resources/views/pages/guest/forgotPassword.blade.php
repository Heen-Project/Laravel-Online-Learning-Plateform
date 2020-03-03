@extends('master.masterGuest')

@section('section_1')
  <section style="width:30%;margin:3% auto;" class="form">
    <header class="guestLightColor">
    <h3>{{trans('dictionary.forgot_password')}}</h3>
    </header>
    {!! Form::open([action('GuestController@resetPassword')]) !!}
    <div >
      {!! Form::label('username', trans('dictionary.username').' : ', ['class'=>'label']) !!}
      {!! Form::text('username', null, ['class'=>'textBox']) !!}
      {!! Form::label('email', trans('dictionary.email').' : ', ['class'=>'label']) !!}
      {!! Form::email('email', null, ['class'=>'textBox']) !!}
      
				@if ($errors->any())
				<ul class="errRegister">
					@foreach ($errors->all() as $error)
			      <li style="margin:2% auto;padding:1%;">
			      	{{ $error }}
			      </li>
		      @endforeach
	      </ul>
				@endif
			{!! Form::submit(trans('dictionary.request'), ['class'=>'guestLightColor guestButton', 'style'=>'margin:3% auto;font-size:18px;width:99%']) !!}
    </div>
    {!! Form::close() !!}
  </section>
@stop