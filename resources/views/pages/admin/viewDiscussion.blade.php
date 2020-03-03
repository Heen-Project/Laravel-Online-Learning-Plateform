@extends('master.masterAdmin')

@section('section_1')
<main class="display_5">
  <!-- <header class="adminLightColor"> -->
    <h1>Discussion</h1>
  <!-- </header> -->
  <br>
  @foreach($categories as $category)
    <ul>
      <h2 class="adminDarkColor" >{{ $category->category }}</h2>
       @foreach($category->discussions()->orderBy('created_at','desc')->take(2)->get()->all() as $discussion)
        <li>
          <h3><span><a href="{{action('DiscussionController@show', $discussion->id)}}" class="tooltip" title="{{ date('F d, Y', strtotime($discussion->created_at))}}">{{ str_limit($discussion->title, 100, '...') }}</a></span>@include('include.etc.creatorName.creatorNameDiscussion')</h3>
         <ul>
          @if($discussion->status == true)
           <li>
             <a href="{{action('AdminController@closeDiscussion', $discussion->id)}}"><button class=" adminButton font" style="width:99%"> Closed Discussion </button></a>
           </li>
           <li>
             <a href="{{action('AdminController@deleteDiscussion', $discussion->id)}}"><button class=" adminButton font" style="width:99%"> Delete Discussion </button></a>
           </li>
          @endif
         </ul> 
       </li>
      @endforeach
    </ul>
    @endforeach  
</main>
{!! $categories->render() !!}
@stop