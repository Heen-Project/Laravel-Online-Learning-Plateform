@extends('master.masterUser')

@section('section_1')
<main class="display_5">
    <h1>Discussion</h1>
  <br>
  @foreach($categories as $category)
    <ul>
      <h2 class="userDarkColor" >{{ $category->category }}</h2>
       @foreach($category->discussions()->orderBy('created_at','desc')->take(2)->get()->all() as $discussion)
        <li>
          <h3><span><a href="{{action('DiscussionController@show', $discussion->id)}}"  class="tooltip" title="{{ date('F d, Y', strtotime($discussion->created_at))}}">{{ str_limit($discussion->title, 100, '...') }}</a></span>@include('include.etc.creatorName.creatorNameDiscussion')</h3>
       </li>
      @endforeach
    </ul>
    @endforeach  
</main>
{!! $categories->render() !!}
@stop