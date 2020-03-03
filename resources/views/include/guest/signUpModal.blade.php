<dialog id="signUpModal" style="background-color:transparent; border: none;" >
  <section class="modalDialog content_1">
    <header class="guestLightColor">
    <h1> {{trans('dictionary.sign_up')}}</h1>
    </header>
    {!! Form::open(['url'=>'guest/register', 'id'=>'Register']) !!}
    <div>
      {!! Form::label('username', trans('dictionary.username').' : ', ['class'=>'label']) !!}
      {!! Form::text('username', null, ['class'=>'textBox']) !!}
      {!! Form::label('name', trans('dictionary.name').' : ', ['class'=>'label']) !!}
      {!! Form::text('firstName', null, ['class'=>'textBox', 'style'=>'width:45%; display:inline-block;']) !!}
      {!! Form::text('lastName', null, ['class'=>'textBox', 'style'=>'width:45%; display:inline-block;']) !!}
      {!! Form::label('email', trans('dictionary.email').' : ', ['class'=>'label']) !!}
      {!! Form::email('email', null, ['class'=>'textBox']) !!}
      {!! Form::label('password', trans('dictionary.password').' : ', ['class'=>'label']) !!}
      {!! Form::password('password', ['class'=>'textBox']) !!}
      
      <ul class="errRegister"> 
      <li class="errRegister">
      <script>
      $(document).ready(function(){
        $('#Register').submit(function(e){
          e.preventDefault();
          $.ajax({
            data : $(this).serialize(),
            url: '/guest/register',
            method:'POST',
            success: function(msg){
               // alert(msg+'succ');
   
              //   alert(msg+'succ');
              //   $("li.errRegister").reset();
              //   $('li.errRegister').text(msg);
              //   $jq(window).attr("location","http://localhost:8000"); 
              //   window.location.assign("http://localhost:8000");
              //   window.location.replace("http://localhost:8000");
              //   location.reload();
                
            
                if (msg=='' || msg==null){
                location.reload();
              }
              else {
                $('li.errRegister').css('padding','1% 3%');
                $('li.errRegister').css('width','94%');
                $('li.errRegister').text(msg);
              }
            },
            error : function(msg){
              // alert(msg+'err');
              location.reload();
              // $('.li.errorList').text(msg);
              // $("signUpModal").slideDown("slow");
              // document.getElementById("").showModal();     
            }
          });
        });
      });
      </script>       
      </li>
      </ul>

      {!! Form::submit(trans('dictionary.register'), ['class'=>'guestLightColor guestButton font', 'style'=>'width:99%']) !!}
    </div>
    {!! Form::close() !!}
  </section>
  
</dialog>