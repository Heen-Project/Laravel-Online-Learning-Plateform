<hr width="90%">
@foreach ($comments as $comment)
<section class="commentBar">

	<table style="float:left;text-align:left;">
		<tr>
			<td rowspan="2" width="10%"><img src="{{$comment->creator->avatar}}" alt="{{$comment->creator->avatar}}"></td>
			<td colspan="2" width="90%"  class="tooltip" title="{{ date('F d, Y', strtotime($comment->created_at))}}">@include('include.etc.creatorName.creatorNameComment')</td>
		</tr>
		<tr>
			<td colspan="2">{!! html_entity_decode($comment->content) !!}</td>
		</tr>
		<tr>
			<td><span style="float:none;">{{$comment->creator->firstName}} {{$comment->creator->lastName}}</span></td>
			<td colspan="2"></td>
		</tr>
	</table>
</section>
@endforeach