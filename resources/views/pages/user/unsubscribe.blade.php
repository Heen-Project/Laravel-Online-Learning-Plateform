@extends('master.masterUser')

@section('head')
<meta http-equiv="refresh" content="3;url=http://localhost:8000/home">
@stop

@section('section_1')

<h1>{{ trans('dictionary.__unsubscribe__info_text') }}</h1>
<br>
<h3 style="display:inline" ><meta http-equiv="refresh" content="5;url=http://localhost:8000/home">{{ trans('dictionary.click_here') }} </a> {{ trans('dictionary.__redirect_info_text') }}</h3>
<br>
<br>

@stop