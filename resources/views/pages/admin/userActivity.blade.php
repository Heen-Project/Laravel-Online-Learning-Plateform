@extends('master.masterAdmin')

@section('section_1')
<main class="activity">
	<section class="displayUser">
		<div class="adminLightColor font">
			<h2>{{$user->username}}</h2>
		</div>
		<table>
			<tr>
			<td rowspan="3" width="20%"><img src="{{$user->avatar}}"></td>
				<td width="80%"><h3>{{$user->firstName}} {{$user->lastName}}</h3></td>
			</tr>
			<tr>
				<td><h4>{{ trans('dictionary.register_date') }}	{{ date('F d, Y', strtotime($user->created_at))}}</h4></td>
			</tr>
			<tr><td align="right"><h4>Total Points:  {{$user->point}}, Rank {{$rank}}</h4></td></tr>
		</table>
	</section>

	@if(!empty($viewArticles))
	<br>
	<hr>
	<br>
	<section class="displayActivity">
		<div class="adminLightColor font">
			<h2>{{ trans('dictionary.last_article_viewed') }}</h2>
		</div>
		<table>
			<tr style="background-color: #9e9e9e; color:white">
				<td width="80%">{{ trans('dictionary.article') }}</td>
				<td width="20%">{{ trans('dictionary.seen') }}</td>
			</tr>
			@foreach($viewArticles as $view)
			<tr class="loop">
				<td>
					<a href="{{action('ArticleController@show', $view->article->id) }}">{{ $view->article->title }}</a>
				</td>
				<td><a href="{{action('ArticleController@show', $view->article->id) }}">{{ $view->article->created_at->diffForHumans() }}</a></td>
			</tr>
			@endforeach 
		</table>
	</section>
	@endif

	@if($activities->count()!=0)
	<br>
	<hr>
	<br>
	<section class="displayActivity">
		<div class="adminLightColor font">
			<h2>{{ trans('dictionary.activity_list') }}</h2>
		</div>
		<table>
		<tr style="background-color: #9e9e9e; color:white">
			<td width="20%">{{ trans('dictionary.date') }}</td>
			<td width="75%">{{ trans('dictionary.description') }}</td>
			<td width="5%">{{ trans('dictionary.point') }}</td>
		</tr>
			 @foreach($activities as $activity)
			 <tr class="loop">
			 	<td>{{ $activity->created_at->diffForHumans() }}</td>
			 	<td>{{ $activity->description }}
			 		<ul style="display:none">
			 			<li>
			 				<span class="content" style="display:block">
			 				@if ($activity->typeId == 1)
			 				<a href="{{ action('LessonController@show', $activity->destinationId) }}">{{ $activity->content }}</a>
			 				@elseif ($activity->typeId == 3)
			 				<a href="{{ action('DiscussionController@show', $activity->destinationId) }}">{{ $activity->content }}</a>
			 				@elseif ($activity->typeId == 2)
			 				{{--*/
			 				$comment = \App\Comment::withTrashed()->find($activity->destinationId);
			 				/*--}}
			 				@if ($comment->lessonId != null)
			 				<a href="{{ action('LessonController@show', $comment->lessonId) }}">{!! html_entity_decode($activity->content) !!}</a>
			 				@elseif ($comment->articleId != null)
			 				<a href="{{ action('ArticleController@show', $comment->articleId) }}">{!! html_entity_decode($activity->content) !!}</a>
			 				@elseif ($comment->discussionId != null)
			 				<a href="{{ action('DiscussionController@show', $comment->discussionId) }}">{!! html_entity_decode($activity->content) !!}</a>
			 				@endif
			 				@endif
			 			</span>
			 		</li>
			 	</ul>
			 </td>
			 <td >{{ $activity->point }}</td>
		</tr>
				 @endforeach 
		</table>
	</section>
	@endif
	{!! $activities->render() !!}
</main>   
@stop