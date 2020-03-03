<aside>
	<section class="sidenav guestLightColor" style="vertical-align:middle;	text-align: center;">
		<br><br><br>
		<div style="text-align:center">
			<h2>
				{{ trans('dictionary.most_popular') }}
			</h2>
		</div>
		<table>
			<tr style="color:white" class="guestDarkColor">
				<td width="70%">{{ trans('dictionary.title') }}</td>
				<td width="10%">{{ trans('dictionary.viewer') }}</td>

			</tr>
			@foreach ($articlePopular as $popular)
			<tr>
				<td><a href="{{action('GuestController@articleShow', $popular->id) }}">{{str_limit($popular->title, 12, '...')}}</a></td>
				<td><a href="{{action('GuestController@articleShow', $popular->id) }}">{{ $popular->viewCount }}</a></td>
			</tr>
			@endforeach
		</table>
		<hr>
	</section>
</aside>