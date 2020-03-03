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
  @include('include.admin.header')
  <hr>
  @include('include.admin.navigationBar')
  <hr>
  @include('include.etc.laracastFlash')
  @yield('section_1')
  @yield('section_2')
  @yield('section_3')
  @yield('section_4')
  <hr>
  @include('include.admin.footer')
</div>
@include('include.admin.sideNav')
</body>
</html>