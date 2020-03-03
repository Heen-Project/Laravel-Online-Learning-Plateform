@include('include.etc.navigationAdminScript')
<nav class="adminDarkColor adminNav">
	<ul>
		<li><a href="#">{{ trans('dictionary.category') }}</a>
			<ul>
				<li><a href="{{action('LessonCategoryController@create')}}">{{ trans('dictionary.add_category') }}</a></li>
				<li><a href="{{action('LessonCategoryController@index')}}">{{ trans('dictionary.view_category') }}</a></li>
			</ul>
		</li>
		<li><a href="#">{{ trans('dictionary.lesson') }}</a>
			<ul>
				<li><a href="{{action('AdminController@approval')}}">{{ trans('dictionary.lesson_approval') }}</a></li>
				<li><a href="{{action('LessonController@create')}}">{{ trans('dictionary.create_lesson') }}</a></li>
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
		<li><a href="{{ action('ActivityController@topUserPage') }}">{{ trans('dictionary.top_user') }}</a></li>
		<!-- <li><a href="{{ action('RegisteredController@logout') }}">Log Out</a></li> -->
		<li><a href="#">{{ str_limit(Auth::User()->username, 12,'') }}</a>
			<ul>
				<li><a href="{{ action('RegisteredController@profilePage') }}">{{ trans('dictionary.profile') }}</a></li>
				<li><a href="{{ action('SubscriberController@create') }}">{{ trans('dictionary.send_newsletter') }}</a></li>
				<li><a href="{{ action('RssController@index') }}" style="right:0; color:white;"><i class="fa fa-rss-square adminFontColor"><span  class="adminFontColor" style="font-family: 'Lato'; font-weight: bold;"> {{ trans('dictionary.rss') }}</span></i></a></li>
				<li><a href="{{ action('RegisteredController@logout') }}">{{ trans('dictionary.log_out') }}</a></li>
			</ul>
		</li>
	</ul>
</nav>