<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  @include('include.etc.script')
  @yield('head')  
  <title>@yield('title')</title>
</head>
<body>
@include('include.etc.svgCookie')
<div class="content_2">
  @include('include.user.header')
  @include('include.user.subscribeModal')
  @include('include.user.unsubscribeModal')
  <hr>
  @include('include.user.navigationBar')
  <hr>
  @include('include.etc.laracastFlash')
  @yield('section_1')
  @yield('section_2')
  @yield('section_3')
  @yield('section_4')
  <hr>
  @include('include.user.footer')
</div>
@include('include.user.sideNav')
</body>
</html>