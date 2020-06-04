<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link rel="stylesheet" href="{{ asset('css/swiper/swiper.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/swiper/style.css') }}">
	<title>Find Friends</title>
</head>
<body >
  <!-- <div class="prueba">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis in est similique doloremque! Voluptatibus explicabo asperiores ducimus? At nisi cupiditate, ut dolorem aperiam numquam iusto inventore illo nostrum dolore, dolorum veritatis magnam! Voluptas voluptatem inventore labore deleniti eos culpa voluptates, sint nesciunt, deserunt ducimus? Debitis cum rerum ex quis cupiditate laudantium tempo'ribus porro, quibusdam dignissimos sunt obcaecati eum vitae tempora harum optio facere maiores doloremque, reiciendis consectetur veniam? Non, iure.</p>
</div> -->
  <!-- Swiper -->
  <div id="particles-js"></div>
  <div class="swiper-container">
    <div class="swiper-wrapper">
      @if((Session::get('Users')) == null)
        <h1>
          NO AVAILABLE FRIENDS
        </h1>
      @endif
      @foreach ((Session::get('Users')) as $user)
      @if( $user->email !== $current->email)
      <div class="swiper-slide"> 
        <div class="imgBx">
          <p></p>
          <img src="{{$user->image}}"  style='width:400px; height:400px;' class="img-responsive">
        </div>
      <div class="details">
        @if($current->friends->contains($user->id))
        <button type="button" class="btn btn-danger"onclick="removeFriend(this,{{$user->id}},{{$current->id}},'{{{ csrf_token() }}}')">Remove</button>
        @elseif($current->friendsWait->contains($user->id))
        <button type="button" class="btn btn-warning">Wait</button>
        @elseif(in_array($user->id,$wait))
        <button   type="button" class="btn btn-success" onclick="acceptFriend(this,{{$user->id}},{{$current->id}},'{{{ csrf_token() }}}')">Accept</button>
        @else
      <button  type="button" class="btn btn-primary"onclick="addFriend(this,{{$current->id}},{{$user->id}},'{{{ csrf_token() }}}')">Add</button>
      
      @endif
      <h1>{{$user->name}}</h1>
      </div>
      </div>
      @endif
      @endforeach
      {{-- <div class="swiper-slide"> 
      <div class="imgBx">
        <img src="imagen2.jpg"  width="400" height="400" class="img-responsive"s>
      </div>
      <div class="details">
        <h3>Bladimir Mendoza<br><span>Web Developer</span></h3>
      </div>
      </div>
      <div class="swiper-slide"> 
      <div class="imgBx">
        <img src="imagen3.jpg"  width="400" height="400" class="img-responsive">
      </div>
      <div class="details">
        <h3>Bladimir Mendoza<br><span>Web Developer</span></h3>
      </div>
      </div>
      <div class="swiper-slide"> 
      <div class="imgBx">
        <img src="imagen4.jpg"  width="400" height="400" class="img-responsive">
      </div>
      <div class="details">
        <h3>Bladimir Mendoza<br><span>Web Developer</span></h3>
      </div>
      </div>
      <div class="swiper-slide"> 
      <div class="imgBx">
        <img src="imagen5.jpg"  width="400" height="400" class="img-responsive">
      </div>
      <div class="details">
        <h3>Bladimir Mendoza<br><span>Web Developer</span></h3>
      </div>
      </div>
      <div class="swiper-slide"> 
      <div class="imgBx">
        <img src="imagen6.jpg"  width="400" height="400" class="img-responsive">
      </div>
      <div class="details">
        <h3>Bladimir Mendoza<br><span>Web Developer</span></h3>
      </div>
      </div>
      <div class="swiper-slide"> 
      <div class="imgBx">
        <img src="imagen7.jpeg"  width="400" height="400" class="img-responsive">
      </div>
      <div class="details">
        <h3>Bladimir Mendoza<br><span>Web Developer</span></h3>
      </div>
      </div>
      <div class="swiper-slide"> 
      <div class="imgBx">
        <img src="imagen8.jpg"  width="400" height="400" class="img-responsive">
      </div>
      <div class="details">
        <h3>Bladimir Mendoza<br><span>Web Developer</span></h3>
      </div>
      </div>
       <div class="swiper-slide"> 
      <div class="imgBx">
        <img src="imagen9.jpg"  width="400" height="400" class="img-responsive">
      </div>
      <div class="details">
        <h3>Bladimir Mendoza<br><span>Web Developer</span></h3>
      </div>
      </div>
       <div class="swiper-slide"> 
      <div class="imgBx">
        <img src="imagen10.jpg"  width="400" height="400" class="img-responsive">
      </div>
      <div class="details">
        <h3>Bladimir Mendoza<br><span>Web Developer</span></h3>
      </div>
      </div> --}}
    
    </div>
<script type="text/javascript" src="{{ asset('js/swiper/app.js') }}"></script>


    <!-- Add Pagination -->
        <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>
<!-- Probando contenido(pocision absoluta y relativa) -->
<!-- <div class="prueba">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta officia quisquam aliquam numquam doloribus, cupiditate ea nemo modi. Quo animi ipsum voluptate, cupiditate delectus, eum expedita modi quas facilis iste qui saepe, quod nisi ab est quam sequi commodi labore dolore natus odio in nulla quibusdam? Quasi fugit architecto unde ipsum illo accusantium quidem ratione. Dolorum quo deserunt expedita itaque, quae rem veritatis sapiente aspernatur quas, fugiat, fugit blanditiis vel!
    <h1>HOLA BLADIMIR</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quod eum eveniet, unde asperiores, consequatur, officiis perferendis, corrupti harum nostrum earum. Facere voluptatibus veritatis porro laboriosam possimus, dicta sint eaque vel asperiores fugit. Doloremque, praesentium. Quae in aut natus accusamus tenetur adipisci, esse, consequatur, quis neque velit deserunt accusantium animi numquam facilis earum! Neque optio tempora, iusto ea magni officiis. Aperiam optio asperiores modi tempora recusandae perferendis, eligendi numquam consequatur, cumque harum, eius et ipsam ea nobis aliquid quibusdam nihil alias ipsa delectus assumenda voluptates dolorum culpa ad officia. Culpa alias dicta itaque dolorum odit recusandae quibusdam a eligendi beatae.</p>
  </p>
</div> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/swiper/swiper.min.js') }}"></script>

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