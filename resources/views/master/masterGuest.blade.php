<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  @include('include.etc.script')
  @include('include.etc.facebookScript')
  @yield('head')
	<title>@yield('title')</title>
</head>
<body>
@include('include.etc.svgCookie')
<div class="content_2">
	@include('include.guest.header')
	<hr>
	@include('include.guest.navigationBar')
	<hr>
  @include('include.etc.laracastFlash')
	@include('include.guest.loginModal')
	@include('include.guest.signupModal')
 	@yield('section_1')
	@yield('section_2')
	@yield('section_3')
	@yield('section_4')
	<hr>
	@include('include.guest.footer')
</div>
@include('include.guest.sideNav')
</body>
</html>