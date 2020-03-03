<aside>
<section class="sidenav userLightColor">
<div style="text-align:center">
<h3>
{{ trans('dictionary.most_popular') }}
</h3>
</div>
<table>

<tr style="color:white" class="userDarkColor">
<td width="70%">{{ trans('dictionary.title') }}</td>
<td width="10%">{{ trans('dictionary.viewer') }}</td>
</tr>
@foreach ($articlePopular as $popular)
<tr>
<td><a href="{{action('ArticleController@show', $popular->id) }}">{{str_limit($popular->title, 12, '...')}}</a></td>
<td><a href="{{action('ArticleController@show', $popular->id) }}">{{ $popular->viewCount }}</a></td>
</tr>
@endforeach
</table>
<hr>

{{--*/
  $user = Auth::User();
  $lessonCategoryCount = \App\LessonCategory::all()->count();
  $userMostInterestedCategory = 0;
  $count=0;
  foreach (range(1, $lessonCategoryCount) as $index) {
    $userViewActivity = \App\ViewArticle::where(function($query) use ($user, $index){
      $query->where('userId', $user->id)->orderBy('created_at', 'desc')->where('categoryId',$index)->take(100);
    });
    $sumCategoryActivity = $userViewActivity->where('categoryId', $index)->count();
    if ($sumCategoryActivity > $count){
      $count = $sumCategoryActivity;
      $userMostInterestedCategory = $index;
    }
  }
  $readArticle = \App\ViewArticle::where('userId', $user->id)->distinct()->lists('articleId');
  $unreadArticle = \App\Article::join('lessons', 'lessons.id', '=', 'articles.lessonId')->select('articles.*')->distinct()
  ->where('lessons.categoryId','=', $userMostInterestedCategory)->orderBy('articles.viewCount', 'desc')->get();
  $loopIndex = 0;
  $recommendArticle = [
  ['id'=> 1, 'destinationId'=>0, 'title' => ''], 
  ['id'=> 2, 'destinationId'=>0, 'title' => ''], 
  ['id'=> 3, 'destinationId'=>0, 'title' => ''], 
  ['id'=> 4, 'destinationId'=>0, 'title' => ''], 
  ['id'=> 5, 'destinationId'=>0, 'title' => ''], 
  ];

  foreach ($unreadArticle as $article) {
    $check=0;
    foreach (range(0, $readArticle->count()-1) as $i) {
      if ($article->id == $readArticle[$i]){
        $check+=1;
      }
    }                    
    if ($check == 0){
      $recommendArticle[$loopIndex]['title'] = $article->title;
      $recommendArticle[$loopIndex]['destinationId'] = $article->id;
      $loopIndex+=1;
    }
    if ($loopIndex==5){
      break;
    }
  }
/*--}}
@if (count($readArticle)!=0)
<div style="text-align:center">
  <h3>
   {{ trans('dictionary.recommend_article') }}
 </h3>
</div>
<table>
  <tr style="color:white" class="userDarkColor">
   <td width="80%" style="width:80%">{{ trans('dictionary.title') }}</td>

   @foreach ($recommendArticle as $recommend )
   <tr>
    <td><a href="{{action('ArticleController@show', $recommend['destinationId']) }}">{{str_limit($recommend['title'], 20, '...')}}</a></td>
  </tr>
  @endforeach
</table>
<hr>
@endif
</section>
</aside>