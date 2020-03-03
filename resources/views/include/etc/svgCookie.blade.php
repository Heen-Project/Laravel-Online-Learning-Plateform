@if (!Cookie::has('svg'))
@include('include.etc.svg')
{{--*/ \Cookie::queue('svg', true, Carbon\Carbon::tomorrow('Asia/Jakarta')->diffInMinutes()+1) /*--}}
@endif