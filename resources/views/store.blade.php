<!DOCTYPE html>
<html>

<head>
  <title>Social app</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style_new.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/post.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<meta charset="utf-8" />
</head>

<body>
  <!-- the wrapper that holds all the sections-->

  <div class="wrapper">
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="welcome2">Socialy</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto">
            <li class="nav-item ">
              <a class="nav-link active" href="welcome2">
                <i class="fas fa-home"></i>
                Home
                <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="store">
                <i class="fas fa-store"></i> Store</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fal fa-newspaper"></i> pages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fal fa-joystick"></i> games</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fal fa-calendar"></i> events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fal fa-video"></i> live</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="logout">
                <i class="fal fa-user logout">logout</i>
              </a>
            </li>
            {{Session::get('users')}}
            <li class="nav-item">
              <a class="nav-link" href="#">
                <div class="profile">
                  <img src="{{Session::get('CurrentUser')->image}}" onclick="welcomeProfile()" alt="" />
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class='message'>
      <div class='messageContainer'>
          <img id='messageUserImage' src="{{Session::get('CurrentUser')->image}}" style="">
          <h3 id='messageUserText'>{{Session::get('CurrentUser')->name}}</h3>
          <span onclick="closeMsgBox()">&times;</span>
          <iframe src="/message/0" scroll name="message" scrolling="yes" id='message' frameborder="0" base
              target="_parent"></iframe>
          <form action="">
              <input id='textMessage' type="text" value="  " onchange="waiting(1,1,'{{ csrf_token() }}')">
              <i id='send' onclick="newmessage(1,1,'{{ csrf_token() }}')" class="fa fa-paper-plane"
                  aria-hidden="true"></i>
          </form>
      </div>
  </div>
    <!--prodile and timeline section-->
    <div class="main">
      <div class="row">
        @include('layouts.side')


        <!---->
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 content-side">
          <div class="darkBakground"></div>
          <div class="content-child">
            <div class="row">
              @include('layouts.sideContent')
              <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 feed">
                <div class="child">
                    <iframe src="storeinfo"></iframe>
                  <!--details-->
                  <!--update-->
                  <!-- timrline -->
                  <div class="timeline">
                    <!-- post images -->
                    <!--analysis-->
                    <!--actions-->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--plugin-->
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/profile/setting.js') }}"></script>
--}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset('js/profile/setting.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/message.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/group.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/profile/welcome.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/swiper/app.js') }}"></script>

  <script>
      $('.dropdown-trigger').dropdown();

  </script>
</body>

</html>