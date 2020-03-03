@include('include.etc.navigationGuestScript')

<nav class="guestDarkColor guestNav">
	<ul>
	  <li><a href="#" onclick="showSignUpModal()" >{{ trans('dictionary.sign_up') }}</a></li>
	  <li><a href="#" onclick="showLoginModal()" >{{ trans('dictionary.log_in') }}</a></li>
	  <li><a href="{{ action('GuestController@lessonIndexLatest') }}">{{ trans('dictionary.lesson') }}</a></li>
	  <li><a href="{{ action('GuestController@articleIndex') }}">{{ trans('dictionary.article') }}</a></li>
	  <li><a href="{{ action('GuestController@discussionIndexLatest') }}">{{ trans('dictionary.discussion') }}</a></li>
	  <li><a href="{{ action('ActivityController@topUserPage') }}">{{ trans('dictionary.top_user') }}</a></li>
		<li><a href="{{ action('RssController@index') }}" style="right:0; color:white;"><i class="fa fa-rss-square"><span style="font-family: 'Lato'; font-weight: bold;"> {{ trans('dictionary.rss') }}</span></i></a></li>
	</ul>
</nav>