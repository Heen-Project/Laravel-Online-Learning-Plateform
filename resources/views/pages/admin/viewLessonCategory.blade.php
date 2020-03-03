@extends('master.masterAdmin')

@section('section_1')
<main class="display_1">
  <!-- <header class="adminLightColor"> -->
    <h1>{{ trans('dictionary.view_lesson_categories') }}</h1>
  <!-- </header> -->
  
  <ul>
    @foreach($lessonCategories as $category)
    <li><h3><a href="{{action('LessonCategoryController@show', $category->id)}}">{{ $category->category }}</a></h3></li>
    @endforeach
  </ul>
</main>
{!! $lessonCategories->render() !!}
@stop