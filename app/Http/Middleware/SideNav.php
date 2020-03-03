<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class SideNav
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;

    public function __construct()
    {
        $this->auth = Auth::user();
    }

    public function handle($request, Closure $next)
    {
       
        if(Auth::check()){
            $user = $this->auth;
            $lessonCategoryCount = \App\LessonCategory::all()->count();
            $userMostInterestedCategory = 0;
            $count=0;
            foreach (range(1, $lessonCategoryCount) as $index) {
                $userViewActivity = \App\ViewArticle::where(function($query) use ($user, $index){
                    $query->where('userId', $user->id)->orderBy('created_at', 'desc')->where('categoryId',$index)->take(100);
                });
                $sumCategoryActivity = $userViewActivity->where('categoryId', $index)->count();
                // echo $sumCategoryActivity;
                // $test[$index] = [
                // 'userId' => $user->id,
                // 'category' => $lessonCategoryCount,
                // 'index' => $index,
                // 'activity' => $userViewActivity,
                // 'count'=>$sumCategoryActivity,
                // ];
                // echo $index.'=>'.$sumCategoryActivity.'<br>';
                if ($sumCategoryActivity > $count){
                    $count = $sumCategoryActivity;
                    // echo $sumCategoryActivity.' banding '. $userMostInterestedCategory.'<br>';
                    $userMostInterestedCategory = $index;
                    // echo 'nilay yang disimpen '.$index.'<br>';
                }
            }
            $readArticle = \App\ViewArticle::where('userId', $user->id)->distinct()->lists('articleId');
            // echo 'article yang dibaca '.$readArticle.'<br>';
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
            // echo 'article yang belum diabaca tapi masuk kategory '.$article->id.'<br>';
                $check=0;
                foreach (range(0, $readArticle->count()-1) as $i) {
                    // echo $i.'<br>';
                    if ($article->id == $readArticle[$i]){
                        $check+=1;
                    }
                    
                }                    
                if ($check == 0){
                    // echo 'article beda '.$article->id.'      '.$i.'<br>';
                    $recommendArticle[$loopIndex]['title'] = $article->title;
                    $recommendArticle[$loopIndex]['destinationId'] = $article->id;
                    $loopIndex+=1;
                }
                if ($loopIndex==5){
                    break;
                }
            }
            // dd($recommendArticle);
            session()->flash('recommendArticle',$recommendArticle);
            
            // session()->flash('user', $this->auth);
        }
        return $next($request);
    }
}
