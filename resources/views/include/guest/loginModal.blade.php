
<dialog id="LoginModal" style="background-color:transparent; border: none;" >
  <section class="modalDialog content_1">
    <header class="guestLightColor">
    <h1>{{ trans('dictionary.log_in') }}</h1>
    </header>
    {!! Form::open(['url'=>'guest/login', 'id'=>'Login']) !!}
    <div >
      {!! Form::label('username', trans('dictionary.username').' : ', ['class'=>'label']) !!}
      {!! Form::text('username', null, ['class'=>'textBox']) !!}
      {!! Form::label('password', trans('dictionary.password').' : ', ['class'=>'label']) !!}
      {!! Form::password('password', ['class'=>'textBox']) !!}
     
      <ul class="errLogin"> 
      <li class="errLogin">
      <script>
      $(document).ready(function(){
        $('#Login').submit(function(e){
          e.preventDefault();
          $.ajax({
            data : $(this).serialize(),
            url: '/guest/login',
            method:'POST',
            success: function(msg){
              //alert(msg+'succ');
              if (msg=='' || msg==null){
                window.location.replace("http://localhost:8000/home");
              }
              else {
                $('li.errLogin').css('padding','1% 3%');
                $('li.errLogin').css('width','94%');
                $('li.errLogin').text(msg);
              }
            },
            error:function(msg){
              //alert(msg+'err');
              window.location.replace("http://localhost:8000/home");
            }
          });
        });
      });
      </script>       
      </li>
      </ul>

      {!! Form::submit(trans('dictionary.enter'), ['class'=>'guestLightColor guestButton font', 'style'=>'margin:3% auto;width:99%']) !!}
    </div>
    {!! Form::close() !!}
    <!--<hr style="border:5px solid #808080">-->
    <!--<span class="label" style="text-align:center">Or</span>-->
    <a href="{{ action('GuestController@resetPasswordPage') }}" class="guestFontColor"><i class="fa fa-lock"></i> {{ trans('dictionary.forgot_password') }}</a>
    <hr class="guestFontColor guestLightColor">
    <a href="{{ action('GuestController@facebookLogin') }}"><button class="guestLightColor guestButton font" style="width:99%;  height:30%;  padding : 4% 4%; "><i class="fa fa-facebook-square" style="font-size:24px; vertical-align:middle;"></i> {{ trans('dictionary.log_in_using_facebook') }} </button></a>
  </section>
  
</dialog>