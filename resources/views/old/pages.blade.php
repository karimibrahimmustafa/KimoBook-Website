<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/swiper/swiper.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/swiper/style.css') }}">
  <title>Find Friends</title>
</head>

<body>
  <!-- <div class="prueba">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis in est similique doloremque! Voluptatibus explicabo asperiores ducimus? At nisi cupiditate, ut dolorem aperiam numquam iusto inventore illo nostrum dolore, dolorum veritatis magnam! Voluptas voluptatem inventore labore deleniti eos culpa voluptates, sint nesciunt, deserunt ducimus? Debitis cum rerum ex quis cupiditate laudantium tempo'ribus porro, quibusdam dignissimos sunt obcaecati eum vitae tempora harum optio facere maiores doloremque, reiciendis consectetur veniam? Non, iure.</p>
</div> -->
  <!-- Swiper -->
  <div id="particles-js"></div>
  <div class="swiper-container">
    <div class="swiper-wrapper">
      @foreach ($pages as $page)
      <div class="swiper-slide">
        <div class="imgBx">
          <p>
          </p>
          <img src="{{$page->image}}" style='width:400px; height:400px;' class="img-responsive">
        </div>
        <div class="details">
          @if($followings->contains($page->id))
          <button type="button" class="btn btn-danger"
            onclick="UnFollowing(this,{{$page->id}},'{{{ csrf_token() }}}')">Unfollow</button>
          @else
          <button type="button" class="btn btn-primary"
            onclick="Following(this,{{$page->id}},'{{{ csrf_token() }}}')">Follow</button>
          @endif
          <a href="page{{$page->id}}">
            <h1>
              {{$page->name}}
            </h1>
          </a>
        </div>
      </div>
      @endforeach
    </div>
    <script type="text/javascript" src="{{ asset('js/swiper/app.js') }}"></script>


    <!-- Add Pagination -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/swiper/swiper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/page.js') }}"></script>
    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 30,
       keyboard: {
      enabled: true,
      },
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 60,
        stretch: 0,
        depth: 500,
        modifier: 1,
        slideShadows : true,

      },
       pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
        navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    </script>

</body>

</html>