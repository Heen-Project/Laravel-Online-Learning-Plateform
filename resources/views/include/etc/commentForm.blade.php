@if (Auth::user()->role == 'user')
  @include('include.user.comment')
@elseif (Auth::user()->role == 'admin')
  @include('include.admin.comment')
@endif