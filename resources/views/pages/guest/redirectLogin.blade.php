@extends('master.masterGuest')

@section('head')
<meta http-equiv="refresh" content="5;url=http://localhost:8000/guest/facebook?code={{ $code = Request::get('code') }}&state={{$state = Request::get('state')}}#_=_">
@stop

@section('section_1')

<br>
<h3 style="display:inline" ><a href="http://localhost:8000/guest/facebook?code={{$code}}&state={{$state}}#_=_">{{ trans('dictionary.click_here') }} </a> {{ trans('dictionary.__redirect_info_text') }}</h3>
<h1>OR</h1>
<h3 style="display:inline" ><a href="http://localhost:8000/guest/register/facebook/redirect?code={{$code}}&state={{$state}}#_=_">{{ trans('dictionary.click_here') }} </a> {{ trans('dictionary.to_register') }}</h3>
<br>
<br>

@stop