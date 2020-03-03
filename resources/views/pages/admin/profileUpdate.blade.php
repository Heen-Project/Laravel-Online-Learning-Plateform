@extends('master.masterAdmin')


@section('section_1')
<h1>{{$userLocal->username}}'s {{trans('dictionary.profile_update')}}</h1>
	{!! Form::open(['method'=>'PUT','action'=>['RegisteredController@updateProfile'], 'files' => true]) !!}

	{!! Form::label('firstName', trans('dictionary.first_name').' : ', ['class'=>'label']) !!}
	{!! Form::text('firstName', null, ['class'=>'textBox']) !!}
	{!! Form::label('lastName', trans('dictionary.last_name').' : ', ['class'=>'label']) !!}
	{!! Form::text('lastName', null, ['class'=>'textBox']) !!}
	{!! Form::label('avatar', trans('dictionary.profile_picture').' : ', ['class'=>'label']) !!}
	{!! Form::file('avatar', ['class'=>'file', 'accept'=>'image/*']) !!}
	{!! Form::label('password', trans('dictionary.request_password_change').' : ', ['class'=>'label']) !!}	
	<a href="{{ action('RegisteredController@requestChangePassword') }}">
	{!! Form::button(trans('dictionary.request'), ['class'=>'blankButton font', 'style'=>'width:70%; padding:1%; margin:auto']) !!}
	</a>
	{!! Form::submit(trans('dictionary.save'), ['class'=>'adminLightColor adminButton font', 'style'=>'width:45%; display:inline-block']) !!}
	{!! Form::reset(trans('dictionary.reset'), ['class'=>'adminLightColor adminButton font', 'style'=>'width:45%; display:inline-block']) !!}
	{!! Form::close() !!}
@stop