@extends('master.masterGuest')
@section('section_1')
  <section style="width:30%;margin:3% auto;" class="form">
    <header class="guestLightColor">
    <h3>{{trans('dictionary.register')}}</h3>
    </header>
    {!! Form::open(['url' =>$newUrl = Request::path().'?code='.Request::get('code').'&state='.Request::get('state').'#_=_', 'id'=>'createUser']) !!}
    <div>
      {!! Form::label('username', trans('dictionary.username').' : ', ['class'=>'label']) !!}
      {!! Form::text('username', null, ['class'=>'textBox']) !!}
      {!! Form::label('password', trans('dictionary.password').' : ', ['class'=>'label']) !!}
      {!! Form::password('password', ['class'=>'textBox']) !!}
      {!! Form::label('password_confirmation', trans('dictionary.password_confirmation').' : ', ['class'=>'label']) !!}
      {!! Form::password('password_confirmation', ['class'=>'textBox']) !!}
			<ul class="errCreateUser"> 
      <li class="errCreateUser">
      <script>
      //alert("a");
      $(document).ready(function(){
        $('#createUser').submit(function(e){
          e.preventDefault();
          $.ajax({
            data : $(this).serialize(),
            // url: encodeURIComponent({{$url1}}&{{$url2}}),
            // url: 'guest/register/facebook/',
            url: '?code={{Request::get('code')}}&state={{Request::get('state')}}#_=_',
            // url: '{{$url1}}&{{$url2}}',
            // url : {{ Request::path().'?code='.Request::get('code').'&state='.Request::get('state').'#_=_' }},
            method:'POST',
            success: function(msg){
              // alert(msg+' succ');  
              if (msg=='' || msg==null){
                // window.location.replace('{{{$urlRedirectPart1}}}&{{{$urlRedirectPart2}}}');
                window.location.replace('http://localhost:8000/home');
              }
              else {
                $('li.errCreateUser').css('padding','1% 3%');
                $('li.errCreateUser').css('width','94%');
                $('li.errCreateUser').text(msg);
              }
            },
            error:function(msg){
              // alert(msg.json+' err');
              // window.location.replace('{{{$urlRedirectPart1}}}&{{{$urlRedirectPart2}}}');
              // window.location.replace('http://localhost:8000/home');
            }
          });
        });
      });
      </script>       
      </li>
      </ul>
			{!! Form::submit(trans('dictionary.register'), ['class'=>'guestLightColor guestButton', 'style'=>'margin:3% auto;font-size:18px;width:99%']) !!}
    </div>
    {!! Form::close() !!}
  </section>
@stop