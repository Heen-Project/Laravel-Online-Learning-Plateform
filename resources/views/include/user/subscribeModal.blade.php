<dialog id="subscribeModal" style="background-color:transparent; border: none;" >
  <section class="subscriberModal content_1">
    <h1 class="userFontColor">{{ trans('dictionary.subscribe') }}</h1><hr>
    <h3>{{ trans('dictionary.__subscribe_text') }}</h3>
    <a href="{{ action('SubscriberController@subscribe') }}"><button class="userLightColor userButton font" style="width:100%">Subscribe</button></a>
  </header>
</section>
</dialog>