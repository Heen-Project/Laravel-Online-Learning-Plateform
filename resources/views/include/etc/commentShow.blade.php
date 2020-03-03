<hr width="90%">
@foreach ($comments as $comment)
@if($comment->inappropriate == true || $comment->deleted_at == null)
<section class="commentBar">
	@if (Auth::user()->id == $comment->creator->id)
	<table style="float:right;text-align:right;">
		<tr>
			<td colspan="2" width="90%"  class="tooltip" title="{{ date('F d, Y', strtotime($comment->created_at))}}">@include('include.etc.creatorName.creatorNameComment')</td>
			<td rowspan="2" width="10%"><img src="{{$comment->creator->avatar}}" alt="{{-- $comment->creator->avatar --}}"></td>
		</tr>
		@else <!-- //if (Auth::user()->id == $comment->creator->id) -->
		<table style="float:left;text-align:left;">
			<tr>
				<td rowspan="2" width="10%"><img src="{{$comment->creator->avatar}}" alt="{{-- $comment->creator->avatar --}}"></td>
				<td colspan="2" width="90%"  class="tooltip" title="{{ date('F d, Y', strtotime($comment->created_at))}}">@include('include.etc.creatorName.creatorNameComment')</td>
			</tr>
			@endif <!-- //if (Auth::user()->id == $comment->creator->id) -->
			<tr>
				@if($comment->trashed())
				<td colspan="2"> {{ trans('dictionary.__deleted_comment_text') }} </td>
				@else <!-- //if($comment->inappropriate == true) -->
				@if (Auth::user()->id == $comment->creator->id)
				<td class="commentEditable" id="content{{$comment->id}}" colspan="2" style="float:left;">{!! html_entity_decode($comment->content) !!}</td>
				@else <!-- //if (Auth::user()->id == $comment->creator->id) -->
				<td colspan="2">{!! html_entity_decode($comment->content) !!}</td>
				@endif <!-- //if (Auth::user()->id == $comment->creator->id) -->
				@endif <!-- //if($comment->inappropriate == true) -->
			</tr>
			<tr>
				@if($comment->trashed())
				@if (Auth::user()->id == $comment->creator->id)
				<td></td>
				<td></td>
				@else
				<td></td>
				<td colspan="2"></td>
				@endif
				@else

				@if ($comment->discussionId !=null)
				@if ($comment->discussion->status == true)

				@if (Auth::user()->id == $comment->creator->id)
				<td>
					<div class="change">
						<button class="editBtn blankButton" id="edit__{{$comment->id}}" style="display:inline-block"><i class="fa fa-pencil-square-o"> Edit</i></button>
						{!! Form::open(['action'=> ['CommentController@deleteComment'], 'method'=>'DELETE']) !!}
						{!! Form::hidden('id', $comment->id, ['style'=>'display:none']) !!}
						{!! Form::submit( trans('dictionary.delete') , ['class'=>'deleteBtn blankButton', 'id' => 'dele__'.$comment->id, 'style'=>'display:inline-block']) !!}
						{!! Form::close() !!}
						<button class="cancelBtn blankButton" id="canc__{{$comment->id}}" style="display:none"><i class="fa fa-times"> Cancel</i></button>
						{!! Form::open(['action'=> ['CommentController@updateComment'], 'method'=>'PUT']) !!}
						{!! Form::hidden('content',null , ['id'=>'id__'.$comment->id, 'name'=>'content', 'style'=>'display:none']) !!}
						{!! Form::hidden('id', $comment->id, ['style'=>'display:none']) !!}
						{!! Form::submit( trans('dictionary.save') , ['class'=>'saveBtn blankButton', 'id' => 'save__'.$comment->id, 'style'=>'display:none']) !!}
						{!! Form::close() !!}
					</div>
				</td>
				<td><span style="float:none;">{{$comment->creator->firstName}} {{$comment->creator->lastName}}</span></td>
				@else <!-- //if (Auth::user()->id == $comment->creator->id) -->
				<td><span style="float:none;">{{$comment->creator->firstName}} {{$comment->creator->lastName}}</span></td>
				<td colspan="2">
					@if (Auth::user()->role == 'admin')
					<span class="inappropriate" style="display:none;width:80%">{!! Form::open(['action'=> ['AdminController@inappropriateComment'], 'method'=>'DELETE']) !!}
						{!! Form::hidden('id', $comment->id, ['style'=>'display:none']) !!}
						{!! Form::submit( trans('dictionary.inappropriate_comment') , ['class'=>'blankButton', 'style'=>'display:inline-block']) !!}
						{!! Form::close() !!}
					</span>
					@endif <!-- //if (Auth::user()->role == 'admin') -->
				</td>
				@endif <!-- //if (Auth::user()->id == $comment->creator->id) -->
				@else
				@if (Auth::user()->id == $comment->creator->id)
				<td></td>
				<td></td>
				@else
				<td></td>
				<td colspan="2"></td>
				@endif
				@endif
				@else <!-- //if ($comment->discussion->active!=false) -->
				@if (Auth::user()->id == $comment->creator->id)
				<td>
					<div class="change">
						<button class="editBtn blankButton" id="edit__{{$comment->id}}" style="display:inline-block"><i class="fa fa-pencil-square-o"> Edit</i></button>
						{!! Form::open(['action'=> ['CommentController@deleteComment'], 'method'=>'DELETE']) !!}
						{!! Form::hidden('id', $comment->id, ['style'=>'display:none']) !!}
						{!! Form::submit( trans('dictionary.delete') , ['class'=>'deleteBtn blankButton', 'id' => 'dele__'.$comment->id, 'style'=>'display:inline-block']) !!}
						{!! Form::close() !!}
						<button class="cancelBtn blankButton" id="canc__{{$comment->id}}" style="display:none"><i class="fa fa-times"> Cancel</i></button>
						{!! Form::open(['action'=> ['CommentController@updateComment'], 'method'=>'PUT']) !!}
						{!! Form::hidden('content',null , ['id'=>'id__'.$comment->id, 'name'=>'content', 'style'=>'display:none']) !!}
						{!! Form::hidden('id', $comment->id, ['style'=>'display:none']) !!}
						{!! Form::submit( trans('dictionary.save') , ['class'=>'saveBtn blankButton', 'id' => 'save__'.$comment->id, 'style'=>'display:none']) !!}
						{!! Form::close() !!}
					</div>
				</td>
				<td><span style="float:none;">{{$comment->creator->firstName}} {{$comment->creator->lastName}}</span></td>
				@else <!-- //if (Auth::user()->id == $comment->creator->id) -->
				<td><span style="float:none;">{{$comment->creator->firstName}} {{$comment->creator->lastName}}</span></td>
				<td colspan="2">
					@if (Auth::user()->role == 'admin')
					<span class="inappropriate" style="display:none;width:80%">{!! Form::open(['action'=> ['AdminController@inappropriateComment'], 'method'=>'DELETE']) !!}
						{!! Form::hidden('id', $comment->id, ['style'=>'display:none']) !!}
						{!! Form::submit( trans('dictionary.inappropriate_comment') , ['class'=>'blankButton', 'style'=>'display:inline-block']) !!}
						{!! Form::close() !!}
					</span>
					@endif <!-- //if (Auth::user()->role == 'admin') -->
				</td>
				@endif <!-- //if (Auth::user()->id == $comment->creator->id) -->
				@endif <!-- //if ($comment->discussion->active!=false) -->
				@endif <!-- //if ($comment->discussionId !=null) -->
			</tr>
		</table>
	</section>
@endif
@endforeach