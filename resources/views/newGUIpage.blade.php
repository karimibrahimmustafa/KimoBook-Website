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

  <meta charset="utf-8" />
</head>

<body>
  <!-- the wrapper that holds all the sections-->

  <div class="wrapper">
    <!--change cover -->
    <div id="changeCover" class="modal">
      <form action="use" id="myform" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-form">
          <h1>Choose a Cover</h1>
          <h1 class="closing" onclick="hidecover()">
            x
          </h1>
          <div class="inputfile" id="stepnow4" style="">
            <div class="custom-file input-group">
              <input type="file" class="custom-file-input" id="customFile" name="photo" oninput="inputimg(this)">
              <input type="file" class="custom-file-input" id="hiddenFile" name="type" value="cover">
              <label id="inputlabel" class="custom-file-label" for="customFile">
                Choose file
              </label>
              <button id='mail4'
                onclick="Update('{{Session::get('CurrentUser')->name}}','cover','{{{ csrf_token() }}}')"
                class="btn btn-primary" type="button" disabled style=" margin-left: 35%; margin-top: 10px;">
                Next
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- change image -->
    <div id="changeImage" class="modal">
      <form action="use" id="myform2" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-form">
          <h1>Choose a Image</h1>
          <h1 class="closing" onclick="hideimage()">
            x
          </h1>
          <div class="inputfile" id="stepnow4" style="">
            <div class="custom-file input-group">
              <input type="file" class="custom-file-input" id="customFile2" name="photo" oninput="inputImg(this)">
              <input type="file" class="custom-file-input" id="hiddenFile2" name="type" value="cover">
              <label id="imageChanger" class="custom-file-label" for="customFile">
                Choose file
              </label>
              <button id='img' onclick="Update('{{Session::get('CurrentUser')->name}}','image','{{{ csrf_token() }}}')"
                class="btn btn-primary" type="button" disabled style=" margin-left: 35%; margin-top: 10px;">
                Next
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!--change info -->
    <div id="changeInfo" class="modal">
      <form action="use" id="myform3" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-form" style="width: 64%;">
          <h1>
            Update your Info
          </h1>
          <h1 class="closing" onclick="hideinfo()">
            x
          </h1>
          <div style="position: relative;">
            <h3 onclick="show_name()">
              Name
            </h3>
            <input type="text" id="name" class="form-control" value="{{Session::get('CurrentUser')->name}}"
              autocomplete="off">
            <div style="height: 5;"></div>
            <h3 onclick="show_pass()">
              Password
            </h3>
            <input type="password" id="password-old" class="form-control" placeholder=" Your old password"
              onkeyup="pass(1,'{{Session::get('CurrentUser')->email}}',this,'{{{ csrf_token() }}}')" autocomplete="off">
            <div style="height: 5;"></div>
            <input type="password" id="password-new" class="form-control" placeholder="Your new password"
              onkeyup="pass(2,'','','')" autocomplete="off" style="display:none">
            <div style="height: 5;"></div>
            <input type="password" id="password-confirm" class="form-control" placeholder="Confirm Your password"
              onkeyup="pass(2,'','','')" autocomplete="off" style="display:none">
            <button id='info' onclick="Update('{{Session::get('CurrentUser')->id}}','info','{{{ csrf_token() }}}')"
              class="btn btn-primary" type="button" style="margin-top: 15px;width: 8vw;">
              Next
            </button>
          </div>
        </div>
      </form>
    </div>
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
                  <div class="stories prof">
                    <div class="profile_choises">
                      <ul class="navbar-nav m-auto">
                        <li class="nav-item ">
                          <div class="speech-bubble" id="bubble1" onmouseover="showbubble(1)" onmouseout="hidebubble(1)"
                            onclick="changeInfo()">
                            change
                          </div>
                          <a class="nav-link active remove_friend" id="change_name" href="#" onmouseover="showbubble(1)"
                            onmouseout="hidebubble(1)">
                            {{Session::get('CurrentUser')->name}}
                            <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            friends</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            pages</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#"> games</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#"> events</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#"> live</a>
                        </li>
                      </ul>
                    </div>
                    <img class="cover" src="{{Session::get('CurrentUser')->cover}}" alt="" />
                    <h2 class="class_option" onmouseover="showbubble(2)" onmouseout="hidebubble(2)">...</h2>
                    <div class="speech-bubble" id="bubble2" onmouseover="showbubble(2)" onmouseout="hidebubble(2)"
                      onclick="coverChange()">
                      change
                    </div>
                    <div class="hold photo">
                      <div class="profile">
                        <img src="{{Session::get('CurrentUser')->image}}" onclick="welcomeProfile()"
                          onmouseover="showbubble(3)" onmouseout="hidebubble(3)" alt="" />
                      </div>
                      <div class="speech-bubble" id="bubble3" onmouseover="showbubble(3)" onmouseout="hidebubble(3)"
                        onclick="coverImage()">
                        change
                      </div>
                    </div>
                  </div>
                  <!--details-->
                  <div class = "about" onmouseover="showbubble(4)" onmouseout="hidebubble(4)">
                    <div class="speech-bubble" id="bubble4" onmouseover="showbubble(4)" onmouseout="hidebubble(4)"
                    onclick="aboutChange()">
                    change
                  </div>
                    <div style="padding-top: 15px;padding-bottom: 15px;">
                    <div style="text-align: center;">About : {{Session::get('CurrentUser')->details->about}}</div>
                    <div class="right_section">Studied at : {{Session::get('CurrentUser')->details->study}}</div>
                    <div class="left_section"> Adress : {{Session::get('CurrentUser')->details->address}} </div>
                    <div class="right_section">Worked at : {{Session::get('CurrentUser')->details->work}}</div>
                    <div class="left_section">Born in : {{Session::get('CurrentUser')->details->date}}</div>
                    <div class="right_section"> 
                      @if(Session::get('CurrentUser')->details->mail)
                      Mail : {{Session::get('CurrentUser')->email}}
                      @else
                      Mail : Unavailable
                      @endif </div>
                    <div class="left_section"> Phone : {{Session::get('CurrentUser')->details->phone}} </div>
                    <div class="right_section"> 
                      <i class="fa fa-heart ">
                      </i>
                      @if(Session::get('CurrentUser')->details->state == 0)
                      Single
                      @elseif(Session::get('CurrentUser')->details->state == 1)
                      Engaged
                      @elseif(Session::get('CurrentUser')->details->state == 2)
                      Married
                      @else
                      Divorced
                      @endif
                    </div>
                    <div class="left_section"> Hobbies : {{Session::get('CurrentUser')->details->hobbies}} </div>
                  </div>
                  </div>
                  <!--update-->
                  <div class="update">
                    <div class="reg">
                      <div class="status-update">
                        <div class="profile">
                          <img src="{{Session::get('CurrentUser')->image}}" alt="" />
                        </div>
                        <textarea id='text2' placeholder="What's in your mind" onkeypress="textAreaAdjust(this)"
                          placeholder="what's on your mind ?"></textarea>
                      </div>
                      <span style="width: 25px;">
                        <form method="post" enctype="multipart/form-data" id='form1' class="md-form">
                          <div class="file-field">
                            <i>
                              <input type="file" name="image2" id='imgpost' onchange='kiko()' id="sortpic">
                            </i>
                          </div>
                        </form>
                        {{-- <i class="fal fa-camera"></i>
                        <i class="fal fa-video"></i>
                        <i class="fal fa-link"></i>
                        --}}
                      </span>
                    </div>

                    <div class="advanced">
                      <div onclick="post('{{{ csrf_token() }}}')">
                        <i class="fal fa-smile" onclick="post('{{{ csrf_token() }}}')"></i>
                        <span>Post</span>
                      </div>
                      <div>
                        <i class="fal fa-calendar"></i>
                        <span>event</span>
                      </div>
                      <div>
                        <i class="fal fa-map-marker"></i>
                        <span>cevent</span>
                      </div>
                      <div>
                        <i class="fal fa-tag"></i>
                        <span>tag people</span>
                      </div>
                    </div>
                  </div>
                  <!-- timrline -->
                  <div class="timeline">
                    <?php 
                $posts=App\Http\Controllers\ProfileController::getposts(Session::get('CurrentUser')->id);
                    ?>
                    @foreach ($posts as $post)
                    <div class="post-info" id="postnum{{$post->id}}">
                      <div class="perosn">
                        <div class="profile">
                          <img src="../{{$post->users->image}}" alt="" />
                        </div>
                        <div class="desc">
                          <h6>{{$post->users->name}}</h6>
                          <p>
                            @if($post->shared !=0)
                            <span>shared from {{$post->share()->users->name}}</span> <br />
                            @endif
                            {{App\Http\Controllers\ProfileController::dating($post->created_at)}}
                          </p>
                        </div>
                      </div>
                      <!-- settings dots -->
                      <div class="dots" onclick="prop({{$post->id}})">
                        <p>...</p>
                        <div class="prop" id="prop{{$post->id}}"
                          onclick='deletePost({{$post->id}},"{{{ csrf_token() }}}")'>
                          <span>delete post</span>
                          <span></span>
                        </div>
                      </div>
                    </div>
                    <!-- post images -->
                    <div class="post-content">
                      @if($post->shared !=0)
                      <p>
                        {{$post->share()->text}}
                      </p>
                      @if($post->image != '')
                      <div class="imgs">
                        {{--
                          <div class="left">
                          <img src="img/post/1.jpg" alt="" />
                        </div>
                        --}}
                        <div class="right">
                          {{--  
                          <div class="sm up-img">
                            <img src="img/post/2.jpg" alt="" />
                          </div>
                        --}}
                          <div class="sm down-img">
                            <img src="../{{$post->share()->image}}" alt="" />
                          </div>
                        </div>
                      </div>
                      @endif
                      @else
                      <p>
                        {{$post->text}}
                      </p>
                      @if($post->image != '')
                      <div class="imgs">
                        {{--
                          <div class="left">
                          <img src="img/post/1.jpg" alt="" />
                        </div>
                        --}}
                        <div class="right">
                          {{--  
                          <div class="sm up-img">
                            <img src="img/post/2.jpg" alt="" />
                          </div>
                        --}}
                          <div class="sm down-img">
                            <img src="../{{$post->image}}" alt="" />
                          </div>
                        </div>
                      </div>
                      @endif
                      @endif
                    </div>
                    <!--analysis-->
                    <span></span>
                    <div class="box-likes">
                      <div class="row" id='likeList{{$post->id}}'>
                        @if(count($post->likes)>0)
                        <span>
                          <a href="#">
                            <img src="{{'..\\'.$post->likes[0]->users->image}}" alt="" />
                          </a>
                        </span>
                        @if(count($post->likes)>1)
                        <span>
                          <a href="#">
                            <img src="{{'..\\'.$post->likes[1]->users->image}}" alt="" />
                          </a>
                        </span>
                        @endif
                        @if(count($post->likes)>2)
                        <span>
                          <a href="#">
                            <img src="{{'..\\'.$post->likes[2]->users->image}}" alt="" />
                          </a>
                        </span>
                        @endif
                        @if(count($post->likes)>3)
                        <span id='count{{$post->id}}'>
                          <a href="#">
                            +{{count($post->likes)-3}}others
                          </a>
                        </span>
                        @endif
                        <span id="reaction{{$post->id}}" class="reaction" style="display:block;">
                          React on this
                        </span>
                        @else
                        <span id="reaction{{$post->id}}" style="display:block;">
                          0 Reacts
                        </span>
                        @endif
                      </div>
                      <div class="row comment-row">
                        <span>
                          {{count($post->comments)}} comments
                        </span>
                      </div>
                    </div>
                    <span style="visibility: hidden;">___________________________________</span>
                    <!--actions-->
                    <div class="box-buttons">
                      <div class="row">
                        <div class="bubble" id="bubble{{$post->id}}" onmouseover="openBubble({{$post->id}})"
                          onmouseout="closeBubble({{$post->id}})">
                          <i onclick="like({{$post->id}},{{Session::get('CurrentUser')->id}},1,
                                       '{{{ csrf_token() }}}',{{count($post->likes)}},
                                       '{{Session::get('CurrentUser')->image}}',
                                       {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                            class="fas fa-thumbs-up">
                          </i>
                          <i onclick="like({{$post->id}},{{Session::get('CurrentUser')->id}},2,
                                       '{{{ csrf_token() }}}',{{count($post->likes)}},
                                       '{{Session::get('CurrentUser')->image}}',
                                       {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                            class="fas fa-grin-hearts">
                          </i>
                          <i onclick="like({{$post->id}},{{Session::get('CurrentUser')->id}},3,
                                       '{{{ csrf_token() }}}',{{count($post->likes)}},
                                       '{{Session::get('CurrentUser')->image}}',
                                       {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                            class="fas fa-laugh-squint"></i>
                          <i onclick="like({{$post->id}},{{Session::get('CurrentUser')->id}},4,
                                       '{{{ csrf_token() }}}',{{count($post->likes)}},
                                       '{{Session::get('CurrentUser')->image}}',
                                       {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                            class="fas fa-angry"></i>
                          <i onclick="like({{$post->id}},{{Session::get('CurrentUser')->id}},5,
                                       '{{{ csrf_token() }}}',{{count($post->likes)}},
                                       '{{Session::get('CurrentUser')->image}}',
                                       {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                            class="fas fa-sad-tear">
                          </i>
                        </div>
                      </div>
                    </div>
                    <div class="actions">
                      <div class="action react" id="like{{$post->id}}" onmouseover="openBubble({{$post->id}})"
                        onmouseout="closeBubble({{$post->id}})">
                        @if($post->liked(Session::get('CurrentUser')->id)==0)
                        <i class='fa fa-thumbs-up' style='color: darkcyan;'></i>
                        <span>
                        </span>
                        @elseif($post->liked(Session::get('CurrentUser')->id)==1)
                        <i class='fa fa-thumbs-up'></i>
                        <span style='color: darkcyan;'>
                          Like
                        </span>
                        @elseif($post->liked(Session::get('CurrentUser')->id)==2)
                        <i class='fas fa-grin-hearts' style='color: hotpink;'></i>
                        <span style='color: hotpink;'>
                          Love
                        </span>
                        @elseif($post->liked(Session::get('CurrentUser')->id)==3)
                        <i class='fas fa-laugh-squint' style='color: gold;'></i>
                        <span style='color: gold;'>
                          Haha
                        </span>
                        @elseif($post->liked(Session::get('CurrentUser')->id)==4)
                        <i class='fas fa-angry' style='color: crimson;'></i>
                        <span style='color: crimson;'>
                          Angry
                        </span>
                        @elseif($post->liked(Session::get('CurrentUser')->id)==5)
                        <i class='fas fa-sad-tear' style='color: indigo;'></i>
                        <span style='color: indigo;'>
                          Sad
                        </span>
                        @endif
                      </div>

                      <div class="action" id="comment-btn" onclick="commentsShow({{$post->id}})">
                        <i class="fal fa-comments"></i>
                        <span>comments</span>
                      </div>
                      @if($post->shared ==0)
                      <div class="action" id="share-btn" onclick='share(this,{{$post->id}},"{{{ csrf_token() }}}")'>
                        <i class="fas fa-share"></i>
                        <span>share</span>
                        {{--<i class="fal fa-share"></i>--}}
                      </div>
                      @else
                      <div class="action" id="share-btn">
                        <i class="fas fa-share"></i>
                        <span>shared</span>
                        {{--<i class="fal fa-share"></i>--}}
                      </div>
                      @endif
                    </div>
                    <!--add comment-->
                    <div class="comment">
                      <div class="add">
                        <div class="profile">
                          <img src="{{Session::get('CurrentUser')->image}}" alt="" />
                        </div>
                        <input type="text" id='textarea{{$post->id}}' placeholder="write a comment..." />
                      </div>
                      <div class="other comment_add" onclick='addComment({{$post->id}},{{$post->user}},
                        "{{Session::get("CurrentUser")->image}}",
                        "{{Session::get("CurrentUser")->name}}","{{{ csrf_token() }}}")'>
                        <i class="fas fa-comment-dots">
                        </i>
                      </div>
                      <div class="other">
                        <i class="fa fa-camera"></i>
                        <i class="fa fa-smile"></i>
                      </div>
                    </div>
                    <div id="group{{$post->id}}" class='comment-group'>
                      <div id="post_comment{{$post->id}}">
                        @foreach ($post->comments as $comment)
                        <div class="comment comment_div">
                          <div class="add">
                            <div class="profile">
                              <img src="{{$comment->users->image}}" alt="" />
                            </div>
                            <h3>{{$comment->users->name}}</h3>
                            <p>
                              {{$comment->text}}
                            </p>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div style="height: 52px;"></div>
                    @endforeach
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
  @include('layouts.welcome3')
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/message.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/group.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/profile/welcome.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/swiper/app.js') }}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
  </script>
  <script>
    function textAreaAdjust(o) {
      o.style.height = "1px";
      o.style.height = (50+o.scrollHeight)+"px";
    }
    //story slider
      $(".slider").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 1000,
        autoplayHoverPause: true,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 3.2
          }
        }
      });
      $(document).ready(function() {
    $("#text2").emojioneArea({ autoHideFilters: true });
});
  </script>
  @if($postnum!=0)
  <script>
      $(document).ready(function() {
          parent.$('html, body').animate({
          scrollTop: $('#postnum'+{{$postnum}}).offset().top
          }, 1000)
      });
  </script>
@endif
</body>

</html>