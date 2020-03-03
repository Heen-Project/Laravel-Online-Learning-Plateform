@extends('master.masterAdmin')

@section('section_1')
		<article>
			<h2>{{ $userLocal->username }}</h2>
			<p>{{ $userLocal->id }}</p>
			<p>{{ $userLocal->email }}</p>
			<p>{{ $userLocal->firstName }} {{ $userLocal->lastName }}</p>
			<p>{{ $userLocal->password }}</p>
			<p>{{ $userLocal->created_at->diffForHumans() }}</p>
			<p>{{ $userLocal->updated_at->diffForHumans() }}</p>
		</article>
@stop