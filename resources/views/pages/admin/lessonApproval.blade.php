@extends('master.masterAdmin')

@section('section_1')
<main class="display_4">
  <!-- <header class="adminLightColor"> -->
    <h1>{{trans('dictionary.lesson_approval_waiting_list')}}</h1>
  <!-- </header> -->
    {!! Form::open(['action'=>'AdminController@approval']) !!}
    <table style="width:100%">
    <tr>
      <td style="width:80%"><h3>Lesson Title</h3></td>
      <td style="width:10%"  align="center"><h3>Approve</h3></td>
      <td style="width:10%"  align="center"><h3>Decline</h3></td>
    </tr>
    @foreach($lessons as $lesson)
    <tr>
      <td style="width:80%"><a href="{{action('AdminController@pendingLesson', $lesson->id)}}">{!! Form::label(trans('dictionary.title'), $lesson->title, ['class'=>'label', 'style'=>'cursor:pointer']) !!}</a></td>
      <td style="width:10%" align="center">{!! Form::radio('approvalStatus', 'approve'.$lesson->id, false, ['class'=>'radioButton']) !!}</td>
      <td style="width:10%" align="center">{!! Form::radio('approvalStatus', 'decline'.$lesson->id, false, ['class'=>'radioButton']) !!}</td>
    </tr>

      @endforeach
      @if ($errors->any())
      <ul class="errForm">
        @foreach ($errors->all() as $error)
        <li colspan="3">
          {{ $error }}
        </li>
        @endforeach
      </ul>
      @endif

      <tr>
        <td colspan="3">{!! Form::submit(trans('dictionary.submit'), ['class'=>'adminLightColor adminButton font', 'style'=>'width:100%']) !!}</td>
      </tr>
      {!! Form::close() !!}
    </table>
</main>
@stop