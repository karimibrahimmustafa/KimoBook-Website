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
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
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
          <i id='send' onclick="newmessage(1,1,'{{ csrf_token() }}')" class="fa fa-paper-plane" aria-hidden="true"></i>
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
                  <div class="header">
                    <h6>Suggestions</h6>
                  </div>
                  <div class="stories">
                    <div class="slider-parent">
                      <div class="owl-carousel owl-theme slider">
                        @foreach ($users as $user)
                        @if(!(Session::get('CurrentUser')->friends->contains($user->id)) && !($user->id
                        ==Session::get('CurrentUser')->id))
                        <div class="item">
                          <div class="layer suggestion">
                            <div class="person ">
                              <div class="profile">
                                <img src="../{{$user->image}}" alt="" />
                              </div>
                            </div>
                            @if((Session::get('CurrentUser')->friendsWait->contains($user->id)))
                            <h6 class='wait'>{{$user->name}}</h6>
                            @elseif(in_array($user->id,$wait))
                            <h6 class='accept'
                              onclick="acceptFriends(this,{{$user->id}},{{Session::get('CurrentUser')->id}},'{{{ csrf_token() }}}')">
                              {{$user->name}}
                            </h6>
                            @else
                            <h6 class='request'
                              onclick="addFriend(this,{{Session::get('CurrentUser')->id}},{{$user->id}},'{{{ csrf_token() }}}')">
                              {{$user->name}}
                            </h6>
                            @endif
                          </div>
                          <div class="story-image">
                            <img src="../{{$user->image}}" alt="" />
                          </div>
                        </div>
                        @endif
                        @endforeach

                      </div>
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
                              <input type="file" name="image2" id='imgpost' onchange='Validate()' id="sortpic">
                            </i>
                          </div>
                        </form>
                        <textarea id='imgstate' style="display:none"></textarea>

                      </span>
                    </div>

                    <div class="advanced">
                      <div onclick="timelinepost('{{{ csrf_token() }}}')">
                        <i class="fal fa-smile" onclick="post('{{{ csrf_token() }}}')"></i>
                        <span>Post</span>
                      </div>
                      <div>
                        <i class="fas fa-camera"></i>
                        <span id="imgepost">No Image Selected</span>
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
                $posts=App\Http\Controllers\ProfileController::timelineposts(Session::get('CurrentUser')->id);
                $postid=0;
                    ?>
                    @foreach ($posts as $post)
                    <div id="<?php $postid++; ?>post_number{{$postid}}" @if($postid>5) {{"style=display:none"}}@endif>
                      <div class="post-info">
                        <div class="perosn">
                          <div class="profile">
                            @if($post->page == 0)
                            <a href="profile{{$post->users->id}}/0">
                              <img src="../{{$post->users->image}}" alt="" />
                            </a>
                          </div>
                          <div class="desc">
                            <a href="profile{{$post->users->id}}/0">
                              <h6>{{$post->users->name}}</h6>
                            </a>
                            <p>
                              @if($post->shared !=0)
                              <span>shared from {{$post->share()->users->name}}</span> <br />
                              @endif
                              @if($post->group !=0)
                              <a href="group{{$post->groups->id}}">Posted in group {{$post->groups->name}}</a> <br />
                              @endif
                              {{App\Http\Controllers\ProfileController::dating($post->created_at)}}
                            </p>
                            @else
                            <a href="page{{$post->pages->id}}">
                              <img src="../{{$post->pages->image}}" alt="" />
                            </a>
                          </div>
                          <div class="desc">
                            <a href="page{{$post->pages->id}}">
                              <h6>{{$post->pages->name}}</h6>
                            </a>
                            <p>
                              {{App\Http\Controllers\ProfileController::dating($post->created_at)}}
                            </p>
                            @endif
                          </div>
                        </div>
                        <!-- settings dots -->
                        @if(Session::get('CurrentUser')->id == $post->user)
                        <div class="dots" onclick="prop({{$post->id}})">
                          <p>...</p>
                          <div class="prop" id="prop{{$post->id}}"
                            onclick='deletePost({{$post->id}},"{{{ csrf_token() }}}")'>
                            <span>delete post</span>
                            <span></span>
                          </div>
                        </div>
                        @endif
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
                    </div>
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
    var number = 5;
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
    $(window).scroll(function() {
   if(($(window).scrollTop() + $(window).height() > $(document).height() - 300 ) && number!=0) {
    console.log(this.number);
    this.number = getpostsnum(this.number);   
}
});
});
  </script>
</body>

</html>