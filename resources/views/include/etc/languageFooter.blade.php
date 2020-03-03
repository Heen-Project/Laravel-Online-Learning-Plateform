<div align="right">
	<span>
	{{ trans('dictionary.language') }} :
	{{--*/ $language = \Session::get('locale') /*--}}
	<a href="/language/id"><img src="{{asset('asset/blank.png')}}" width="1px" height="1px" class="flag flag-id" /></a>
	<a href="/language/en"><img src="{{asset('asset/blank.png')}}" width="1px" height="1px" class="flag flag-gb" /></a>
</span>
<span>
	{{ trans('dictionary.location') }} : <span id="country"></span>
</span>
</div>

@include('include.etc.geolocationScript')
<?php echo '<script type="text/javascript">getLocation()</script>'; ?>

@if (Cookie::has('svg'))
	@if (!\Cookie::has('countryCheck'))
		@if (\Cookie::has('country'))
			{{--*/ \Cookie::queue('countryCheck', \Cookie::get('country'), Carbon\Carbon::tomorrow('Asia/Jakarta')->diffInMinutes()+1) /*--}}
			@if (\Cookie::get('country')=='Indonesia')
			<script type="text/javascript">
            function Redirect() {
               window.location="http://localhost:8000/language/id";
            }
            document.write("Your Language will be change to Indonesia in 3 sec.");
            setTimeout('Redirect()', 3000);
      </script>
			@else
			 <script type="text/javascript">
            function Redirect() {
               window.location="http://localhost:8000/language/en";
            }
            document.write("Your Language will be change to English in 3 sec.");
            setTimeout('Redirect()', 3000);
      </script>
			@endif
		@endif
	@endif
@endif