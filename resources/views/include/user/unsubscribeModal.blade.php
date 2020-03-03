<dialog id="unsubscribeModal" style="background-color:transparent; border: none;" >
  <section class="subscriberModal content_1">
    <h1 class="userFontColor">>{{ trans('dictionary.unsubscribe') }}</h1><hr>
    <h3>{{ trans('dictionary.__unsubscribe_text') }}</h3>
    <a href="{{ action('SubscriberController@unsubscribe') }}"><button class="userLightColor userButton font" style="width:100%">{{ trans('dictionary.unsubscribe') }}</button></a>
  </header>
</section>
</dialog>