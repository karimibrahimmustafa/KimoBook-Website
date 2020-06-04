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
                            <input type="file" class="custom-file-input" id="customFile" name="photo"
                                oninput="inputimg(this)">
                            <input type="file" class="custom-file-input" id="hiddenFile" name="type" value="cover">
                            <label id="inputlabel" class="custom-file-label" for="customFile">
                                Choose file
                            </label>
                            <button id='mail4'
                                onclick="Update('{{Session::get('CurrentPage')->name}}','coverPage','{{{ csrf_token() }}}')"
                                class="btn btn-primary" type="button" disabled
                                style=" margin-left: 35%; margin-top: 10px;">
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
                            <input type="file" class="custom-file-input" id="customFile2" name="photo"
                                oninput="inputImg(this)">
                            <input type="file" class="custom-file-input" id="hiddenFile2" name="type" value="cover">
                            <label id="imageChanger" class="custom-file-label" for="customFile">
                                Choose file
                            </label>
                            <button id='img'
                                onclick="Update('{{Session::get('CurrentPage')->name}}','pageimage','{{{ csrf_token() }}}')"
                                class="btn btn-primary" type="button" disabled
                                style=" margin-left: 35%; margin-top: 10px;">
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
                        Page Editors
                    </h1>
                    <div style="position: relative;">
                        @foreach (Session::get('CurrentPage')->admins as $admin)
                        <div id='admin{{$admin->id}}' style="width: 100%; height: 75px;">
                            <img src="../{{$admin->image}}"
                                style='height: 75px; width: 75px;position: relative;top: -25px;border-radius: 50%;float: left;'>
                            <h4 style="float: left;position: relative; color:white; cursor:pointer"
                                onclick='profile({{$admin->id}})'>
                                {{$admin->name}}
                            </h4>
                            <button type="button" class="btn btn-danger" style="position: relative; top: -0.5vw;"
                                onclick="Admin({{$admin->id}},'remove','{{{ csrf_token() }}}')">
                                Remove
                            </button>
                        </div>
                        @endforeach
                        <h3 onclick="show_name()">
                            Add
                        </h3>
                        <select id="name" name="id" class="form-control" style="display:none" required>
                            @foreach (Session::get('CurrentUser')->friends as $friend)
                            @if(!Session::get('CurrentPage')->admins->contains($friend->id))
                            <option value="{{$friend->id}}">{{$friend->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        <div style="height: 5;"></div>
                        <button id='submit' onclick="Admin(0,'add','{{{ csrf_token() }}}')" class="btn btn-primary"
                            type="button" style="position: absolute;width: 8vw;">
                            Next
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- navigation bar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="@if($postnum!=0){{'../'}}@endif welcome2">Socialy</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item ">
                            <a class="nav-link active" href="@if($postnum!=0){{'../'}}@endif welcome2">
                                <i class="fas fa-home"></i>
                                Home
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="@if($postnum!=0){{'../'}}@endif store">
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
                            <a class="nav-link" href=" @if($postnum!=0){{'../'}}@endif logout">
                                <i class="fal fa-user logout">logout</i>
                            </a>
                        </li>
                        {{Session::get('users')}}
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <div class="profile">
                                    <img src="@if($postnum!=0){{'../'}}@endif{{Session::get('CurrentUser')->image}}" onclick="welcomeProfile()"
                                        alt="" />
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class='message'>
            <div class='messageContainer'>
                <img id='messageUserImage' src="@if($postnum!=0){{'../'}}@endif{{Session::get('CurrentUser')->image}}" style="">
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
                @if($postnum!=0)
                @include('layouts.side2')
                @else
                @include('layouts.side')
                @endif                <!---->
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 content-side">
                    <div class="darkBakground"></div>
                    <div class="content-child">
                        <div class="row">
                            @if($postnum!=0)
                            @include('layouts.sideContent2')
                            @else
                            @include('layouts.sideContent')
                            @endif                            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 feed">
                                <div class="child">
                                    <div class="stories prof">
                                        <div class="profile_choises">
                                            <ul class="navbar-nav m-auto">
                                                <li class="nav-item ">
                                                    <a class="nav-link active remove_friend" id="change_name" href="#">
                                                        {{Session::get('CurrentPage')->name}}
                                                        <span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item" style="padding-left: 25px;">
                                                    @if(Session::get('CurrentPage')->followers->contains(Session::get('CurrentUser')->id))
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="UnFollowing(this,{{$page->id}},'{{{ csrf_token() }}}')">
                                                        UnFollow
                                                    </button>
                                                    @else
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="Following(this,{{$page->id}},'{{{ csrf_token() }}}')">
                                                        Follow
                                                    </button>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <img class="cover" src="@if($postnum!=0){{'../'}}@endif{{Session::get('CurrentPage')->cover}}" alt="" />
                                        @if(Session::get('CurrentPage')->admin ==Session::get('CurrentUser')->id)
                                        <h2 class="class_option" onmouseover="showbubble(2)" onmouseout="hidebubble(2)">
                                            ...</h2>
                                        @endif
                                        @if(Session::get('CurrentPage')->admin ==Session::get('CurrentUser')->id)
                                        <div class="speech-bubble" id="bubble2" onmouseover="showbubble(2)"
                                            onmouseout="hidebubble(2)" onclick="coverChange()">
                                            change
                                        </div>
                                        @endif
                                        <div class="hold photo">
                                            <div class="profile">
                                                <img src="@if($postnum!=0){{'../'}}@endif{{Session::get('CurrentPage')->image}}"
                                                    onclick="welcomeProfile()" onmouseover="showbubble(3)"
                                                    onmouseout="hidebubble(3)" alt="" />
                                            </div>
                                            @if(Session::get('CurrentPage')->admin ==Session::get('CurrentUser')->id)
                                            <div class="speech-bubble" id="bubble3" onmouseover="showbubble(3)"
                                                onmouseout="hidebubble(3)" onclick="coverImage()">
                                                change
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!--details-->
                                    <div class="about" onmouseover="showbubble(4)" onmouseout="hidebubble(4)">
                                        @if(Session::get('CurrentPage')->admin ==Session::get('CurrentUser')->id)
                                        <div class="speech-bubble" id="bubble4" onmouseover="showbubble(4)"
                                            onmouseout="hidebubble(4)" onclick="changeInfo()">
                                            change
                                        </div>
                                        @endif
                                        <div style="padding-top: 15px;padding-bottom: 15px;">
                                            <div style="text-align: center;">About :
                                                {{Session::get('CurrentPage')->about}}</div>
                                            <div style="text-align: center;">
                                                <i class="fas fa-user-tie">
                                                </i>
                                                <b>Admin: </b>{{Session::get('CurrentPage')->Admin()->name}} <br>
                                                @foreach ( Session::get('CurrentPage')->admins as $admin)
                                                <i class="fas fa-users-cog">
                                                </i>
                                                <b>Editor: </b>{{$admin->name}}
                                                <br>
                                                @endforeach
                                                <i class="fas fa-user-friends">
                                                </i>
                                                <b>Followed by : </b>{{count(Session::get('CurrentPage')->followers)}}
                                                Users
                                            </div>
                                        </div>
                                    </div>
                                    <!--update-->
                                    @if(Session::get('CurrentPage')->admins->contains(Session::get('CurrentUser')->id)
                                    || Session::get('CurrentPage')->admin == Session::get('CurrentUser')->id)
                                    <div class="update">
                                        <div class="reg">
                                            <div class="status-update">
                                                <div class="profile">
                                                    <img src="@if($postnum!=0){{'../'}}@endif{{Session::get('CurrentPage')->image}}" alt="" />
                                                </div>
                                                <textarea id='text2' placeholder="What's in your mind"
                                                    onkeypress="textAreaAdjust(this)"
                                                    placeholder="what's on your mind ?"></textarea>
                                            </div>
                                            <span style="width: 25px;">
                                                <form method="post" enctype="multipart/form-data" id='form1'
                                                    class="md-form">
                                                    <div class="file-field">
                                                        <i>
                                                            <input type="file" name="image2" id='imgpost'
                                                                onchange='Validate()' id="sortpic">
                                                        </i>
                                                    </div>
                                                </form>
                                                <textarea id='imgstate' style="display:none"></textarea>
                                                {{-- <i class="fal fa-camera"></i>
                        <i class="fal fa-video"></i>
                        <i class="fal fa-link"></i>
                        --}}
                                            </span>
                                        </div>

                                        <div class="advanced">
                                            <div onclick="page_post('{{{ csrf_token() }}}')">
                                                <i class="fal fa-smile" onclick="page_post('{{{ csrf_token() }}}')"></i>
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
                                    @endif
                                    <!-- timrline -->
                                    <div class="timeline">
                                        <?php 
                                            $posts=App\Http\Controllers\PageController::posts(Session::get('CurrentPage')->id);
                                        ?>
                                        @foreach ($posts as $post)
                                        <div class="post-info" id="postnum{{$post->id}}">
                                            <div class="perosn">
                                                <div class="profile">
                                                    <img src="../{{Session::get('CurrentPage')->image}}" alt="" />
                                                </div>
                                                <div class="desc">
                                                    <h6>{{Session::get('CurrentPage')->name}}</h6>
                                                    <p>
                                                        @if($post->shared !=0)
                                                        <span>shared from {{$post->share()->users->name}}</span> <br />
                                                        @endif
                                                        {{App\Http\Controllers\ProfileController::dating($post->created_at)}}
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- settings dots -->
                                            @if(Session::get('CurrentPage')->admins->contains(Session::get('CurrentUser')->id)
                                            || Session::get('CurrentPage')->admin == Session::get('CurrentUser')->id)
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
                                                <span id="reaction{{$post->id}}" class="reaction"
                                                    style="display:block;">
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
                                                <div class="bubble" id="bubble{{$post->id}}"
                                                    onmouseover="openBubble({{$post->id}})"
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
                                            <div class="action react" id="like{{$post->id}}"
                                                onmouseover="openBubble({{$post->id}})"
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
                                            <div class="action" id="share-btn"
                                                onclick='share(this,{{$post->id}},"{{{ csrf_token() }}}")'>
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
                                                    <img src="@if($postnum!=0){{'../'}}@endif{{Session::get('CurrentUser')->image}}" alt="" />
                                                </div>
                                                <input type="text" id='textarea{{$post->id}}'
                                                    placeholder="write a comment..." />
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
                                                            <img src="@if($postnum!=0){{'../'}}@endif{{$comment->users->image}}" alt="" />
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
    <script type="text/javascript" src="{{ asset('js/page.js') }}"></script>
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