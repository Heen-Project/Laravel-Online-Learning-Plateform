@include('include.etc.navigationUserScript')
<nav class="userDarkColor userNav">
	<ul>
		<li><a href="#">{{ trans('dictionary.lesson') }}</a>
			<ul>
				<li><a href="{{action('LessonController@create')}}">{{ trans('dictionary.submit_lesson') }}</a></li>
				<li><a href="{{action('LessonController@indexLatest')}}">{{ trans('dictionary.view_lesson') }}</a></li>
			</ul>
		</li>
		<li><a href="#">{{ trans('dictionary.article') }}</a>
			<ul>
				<li><a href="{{action('ArticleController@create')}}">{{ trans('dictionary.create_article') }}</a></li>
				<li><a href="{{action('ArticleController@index')}}">{{ trans('dictionary.view_article') }}</a></li>
			</ul>
		</li>
		<li><a href="#">{{ trans('dictionary.discussion') }}</a>
			<ul>
				<li><a href="{{action('DiscussionController@create')}}">{{ trans('dictionary.open_discussion') }}</a></li>
				<li><a href="{{action('DiscussionController@indexLatest')}}">{{ trans('dictionary.view_discussion') }}</a></li>
			</ul>
		</li>
		<li><a href="#">{{ trans('dictionary.activity') }}</a>
			<ul>
				<li><a href="{{ action('ActivityController@myActivity') }}">{{ trans('dictionary.myself') }}</a></li>
				<li><a href="{{ action('ActivityController@topUserPage') }}">{{ trans('dictionary.top_user') }}</a></li>
			</ul>
		</li>
		<!-- <li><a href="{{ action('RegisteredController@logout') }}">Log Out</a></li> -->
		<li><a href="#">{{ str_limit(Auth::User()->username, 12,'') }}</a>
			<ul>
				<li><a href="{{ action('RegisteredController@profilePage') }}">{{ trans('dictionary.profile') }}</a></li>
				@if (Auth::User()->subscribe == false)
				<li><a href="#" onclick="showSubscribeModal()" >{{ trans('dictionary.subscribe') }}</a></li>
				@elseif (Auth::User()->subscribe == true)
				<li><a href="#" onclick="showUnsubscribeModal()" >{{ trans('dictionary.unsubscribe') }}</a></li>
				@endif
				<li><a href="{{ action('RssController@index') }}" style="right:0; color:white;"><i class="fa fa-rss-square userFontColor"><span  class="userFontColor" style="font-family: 'Lato'; font-weight: bold;"> {{ trans('dictionary.rss') }}</span></i></a></li>
				<li><a href="{{ action('RegisteredController@logout') }}">{{ trans('dictionary.log_out') }}</a></li>
			</ul>
		</li>
	</ul>
</nav>