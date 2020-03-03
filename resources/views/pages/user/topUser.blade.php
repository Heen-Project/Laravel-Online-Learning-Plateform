@extends('master.masterUser')

@section('section_1')
<main class="activity">
	<section class="displayActivity">
		<div class="userLightColor font">
			<h2>{{ trans('dictionary.top_user') }}</h2>
		</div>
		<table>
			<tr style="background-color: #9e9e9e; color:white">
				<td width="5%">{{ trans('dictionary.rank') }}</td>
				<td width="75%">{{ trans('dictionary.username') }}</td>
				<td width="20%">{{ trans('dictionary.total_points') }}</td>
			</tr>
			{{--*/ $rank = 1 /*--}}
			@foreach ($users as $user)
			<tr>
					<td>{{ $rank++ }}</td>
					<td><a href="{{ action('ActivityController@userActivityPage', $user->id) }}">{{ $user->username }}</a></td>
					<td>{{ $user->point }}</td>
			</tr>
			@endforeach 
		</table>
	</section>
</main>
@stop