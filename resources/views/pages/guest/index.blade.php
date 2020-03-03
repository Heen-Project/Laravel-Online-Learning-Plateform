@extends('master.masterGuest')

@section('section_1')
	@foreach($users as $user)
		<article>
			<h2>{{ $user->username }}</h2>
			<p>{{ $user->email }}</p>
			<p>{{ $user->firstName }} {{ $user->lastName }}</p>
			<p>{{ $user->password }}</p>
			<p>{{ $user->created_at->diffForHumans() }}</p>
			<p>{{ $user->updated_at->diffForHumans() }}</p>
			<img src="{{ $user->avatar }}" alt="{{ $user->avatar }}">
		</article>
	@endforeach
	<div
	  class="fb-like"
	  data-share="true"
	  data-width="450"
	  data-show-faces="true">
	</div>
@stop