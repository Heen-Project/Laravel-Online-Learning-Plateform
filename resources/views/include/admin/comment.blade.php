    <!-- {!! Form::open(['action'=>'DiscussionController@store']) !!} -->
    <div class="comment">
      {!! Form::label('content', trans('dictionary.comment').' : ', ['class'=>'label']) !!}
      {!! Form::textarea('content', null, ['class'=>'textArea']) !!}
      <div id='tagShow'>
      </div>

      @if ($errors->any())
			<ul class="errForm">
				@foreach ($errors->all() as $error)
	      <li>
	      	{{ $error }}
	      </li>
	      @endforeach
      </ul>
			@endif
      {!! Form::submit(trans('dictionary.comment'), ['class'=>'adminLightColor adminButton font', 'style'=>'width:99%']) !!}
    </div>
    {!! Form::close() !!}
  @include('include.etc.scriptJQueryTextEditor')