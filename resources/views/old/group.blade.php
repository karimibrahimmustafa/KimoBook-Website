<html lang="en">

<head>
    @include('layouts.welcome2')
    <script type="text/javascript" src="../js/group.js"></script>
</head>

<body>
    <div class='load'>
        <div class="loader-wrapper" id="loader-1">
            <div id="loader"></div>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
        </div>
    </div>
    <div id="changeCover" class="modal">
        <form action="use" id="myform" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-form">
                <h1>Choose a Cover</h1>
                <div class="inputfile" id="stepnow4" style="">
                    <div class="custom-file input-group">
                        <input type="file" class="custom-file-input" id="customFile" name="photo"
                            oninput="inputimg(this)">
                        <input type="file" class="custom-file-input" id="hiddenFile" name="type" value="cover">
                        <label id="inputlabel" class="custom-file-label" for="customFile">
                            Choose file
                        </label>
                        <button id='mail4'
                            onclick="Update('{{Session::get('CurrentGroup')->name}}','coverGroup','{{{ csrf_token() }}}')"
                            class="btn btn-primary" type="button" disabled style=" margin-left: 35%; margin-top: 10px;">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="changeImage" class="modal">
        <form action="use" id="myform2" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-form">
                <h1>Choose a Image</h1>
                <div class="inputfile" id="stepnow4" style="">
                    <div class="custom-file input-group">
                        <input type="file" class="custom-file-input" id="customFile2" name="photo"
                            oninput="inputImg(this)">
                        <input type="file" class="custom-file-input" id="hiddenFile2" name="type" value="cover">
                        <label id="imageChanger" class="custom-file-label" for="customFile">
                            Choose file
                        </label>
                        <button id='img'
                            onclick="Update('{{Session::get('CurrentGroup')->name}}','groupimage','{{{ csrf_token() }}}')"
                            class="btn btn-primary" type="button" disabled style=" margin-left: 35%; margin-top: 10px;">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="changeInfo" class="modal">
    </div>
    <div id="image" class="modal">
        <div class="modal-form" id="showImg">
            <img id='imageshowing' src='../{{$group->image}}'>
        </div>
    </div>
    <div id="container">
        <div id="c2">
            <img src="../{{Session::get('CurrentGroup')->cover}}" style="border-radius: 0% ;">
        </div>
        <div id="c3">
            <img id='imgc3' src="../{{Session::get('CurrentGroup')->image}}" style="">
        </div>
        <div id="c4">
            <a href='/group{{Session::get('CurrentGroup')->id}}'>
                <h1 class="glow"> {{Session::get('CurrentGroup')->name}}
                </h1>
            </a>
        </div>
        @if(Session::get('CurrentGroup')->admin ==Session::get('CurrentUser')->id)
        <div class="element" onclick="openOption()">
        </div>
        @endif
        <ul class="list-group" id='options' style='display:none;'>
            <li class="setting list-group-item " onclick="coverChange()">Change cover</li>
            <li class="list-group-item setting" onclick="coverImage()">Change image</li>
            <li class="list-group-item setting" onclick="changeInfo()">Change Admins</li>
        </ul>
        <div class='PageOptions'>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">
                <div class="list-group list-group-horizontal optionList" style="background-color: transparent">
                    @if(Session::get('CurrentGroup')->users->contains(Session::get('CurrentUser')->id))
                    <button type="button" class="btn btn-danger"
                        onclick="UnFollowing(this,{{$group->id}},'{{{ csrf_token() }}}')">
                        Leave
                    </button>
                    @elseif(Session::get('CurrentGroup')->waits->contains(Session::get('CurrentUser')->id))
                    <button type="button" class="btn btn-warning" disabled>
                        Wait
                    </button>
                    @else
                    <button type="button" class="btn btn-primary"
                        onclick="UnFollowing(this,{{$group->id}},'{{{ csrf_token() }}}')">
                        Join
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class='aboutGroup'>
            <img src="../globe-logo-7DED53A9AA-seeklogo.com.png">
            <h1>About</h1>
            <p>
                {{Session::get('CurrentGroup')->about}}
                <hr>
            </p>
            <h5>
                <i class="fas fa-user-tie">
                </i>
                <b>Admin: </b>{{Session::get('CurrentGroup')->Admin()->name}}
                <h5>
                    <h5>
                        <i class="fas fa-user-friends">
                        </i>
                        <b>Followed by : </b>{{count(Session::get('CurrentGroup')->users)}} Users
                    </h5>
                </h5>
        </div>
        @if(Session::get('CurrentGroup')->users->contains(Session::get('CurrentUser')->id))
        <div class='post'>
            <div class='box'>
                <section>
                    <div class="text">
                        <img class='poster_image' src="../{{Session::get('CurrentUser')->image}}" />
                        <textarea style='display:none;' id='text2' placeholder="What's in your mind" onclick="text()"
                            rows="1"></textarea>
                        <button onclick="group_post('{{{ csrf_token() }}}')">submit</button>
                        <form method="post" enctype="multipart/form-data" id='form1' class="md-form">
                            <div class="file-field">
                                <div>
                                    <div class="btn btn-primary">
                                        <span>Choose img</span>
                                        <input type="file" name="image2" id='imgpost' onchange='kiko()' id="sortpic">
                                    </div>
                                </div>
                                <h3 class='imgname'>no image</h3>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        <section class="new">
            <div class="container" id='cont'>
                <?php 
                $posts=App\Http\Controllers\GroupController::posts(Session::get('CurrentGroup')->id);
            ?>
                @foreach ($posts as $post)
                <div class="box update" id='postnum{{$post->id}}'>
                    <div class="box-header">
                        <h3>
                            <a href=""><img src="../{{$post->users->image}}" alt="" />{{$post->users->name}}</a>
                            <span>{{App\Http\Controllers\ProfileController::dating($post->created_at)}}
                                <i class="fa fa-globe">
                                </i>
                            </span>
                        </h3>
                        @if($post->user == Session::get('CurrentUser')->id)
                        <span>
                            <i class="fa fa-trash-o" aria-hidden="true"
                                onclick='deletePost({{$post->id}},"{{{ csrf_token() }}}")'>
                            </i>
                        </span>
                        @endif
                        <div class="window">
                            <span>
                            </span>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="content">
                            <p>
                                {{$post->text}}
                            </p>
                            @if($post->image != '')
                            <div class="img" onclick="Img('{{$post->image}}')">
                                <img src="../{{$post->image}}" alt="" />
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="box-likes">
                        <div class="row" id='likeList{{$post->id}}'>
                            @if(count($post->likes)>0)
                            <span>
                                <a href="#">
                                    <img src="../{{'..\\'.$post->likes[0]->users->image}}" alt="" />
                                </a>
                            </span>
                            @if(count($post->likes)>1)
                            <span>
                                <a href="#">
                                    <img src="../{{'..\\'.$post->likes[1]->users->image}}" alt="" />
                                </a>
                            </span>
                            @endif
                            @if(count($post->likes)>2)
                            <span>
                                <a href="#">
                                    <img src="../{{'..\\'.$post->likes[2]->users->image}}" alt="" />
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
                            <span style="display:block;">
                                React on this
                            </span>
                            @else
                            <span style="display:block;">
                                0 Reacts
                            </span>
                            @endif
                        </div>
                        <div class="row">
                            <span>
                                {{count($post->comments)}} comments
                            </span>
                        </div>
                    </div>
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
                            @if($post->liked(Session::get('CurrentUser')->id)==0)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class="fa fa-thumbs-up">
                                </span>
                            </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==1)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class='fa fa-thumbs-up' style='color: darkcyan;'>
                                    Like
                                </span>
                            </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==2)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover='openBubble({{$post->id}})'
                                onmouseout='closeBubble({{$post->id}})'>
                                <span class='fas fa-grin-hearts' style='color: hotpink;'>
                                    Love
                                </span>
                            </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==3)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class='fas fa-laugh-squint' style='color: gold;'>
                                    Haha
                                </span>
                            </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==4)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class='fas fa-angry' style='color: crimson;'>
                                    Angry
                                </span>
                            </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==5)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class='fas fa-sad-tear' style='color: indigo;'>
                                    Sad
                                </span>
                            </button>
                            @endif
                            <button onclick="commentsShow({{$post->id}})">
                                <span class="ion-chatbox-working">
                                </span>
                            </button>
                            <button>
                                <span class="ion-share" onclick='share(this,{{$post->id}},"{{{ csrf_token() }}}")'>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class='comment-group' id='group{{$post->id}}'>
                        {{-- <div class="box-click"><span><i class="ion-chatbox-working"></i> View 140 more comments</span></div> --}}
                        <div class="box-comments" id='post_comment{{$post->id}}'>
                            @foreach ($post->comments as $comment)
                            <div class="comment">
                                <img src="../{{$comment->users->image}}" alt="" />
                                <div class="content">
                                    <h3>
                                        <a href="">{{$comment->users->name}}
                                        </a>
                                        <span>
                                            <time>
                                                {{App\Http\Controllers\ProfileController::dating($comment->created_at)}}
                                            </time>
                                            {{-- <a href="#">Like</a>--}}
                                        </span>
                                    </h3>
                                    <p>
                                        {{$comment->text}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="box-new-comment">
                            <img src="../{{Session::get('CurrentUser')->image}}" alt="" />
                            <div class="content">
                                <div class="row">
                                    <textarea id='textarea{{$post->id}}' placeholder="write a comment..." value=''>
                                </textarea>
                                </div>
                                <div class="row">
                                    <span onclick='addComment({{$post->id}},{{$post->user}},
                                               "{{Session::get("CurrentUser")->image}}",
                                               "{{Session::get("CurrentUser")->name}}","{{{ csrf_token() }}}")'
                                        class="far fa-comment-dots">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
    </div>
</body>
<script>
    $(document).ready(function() {
    const buttons = document.querySelectorAll("img")
    for (const button of buttons) {
        button.setAttribute('onclick','Img(this.src)');
    }
    $("#text2").emojioneArea({ autoHideFilters: true });
    setTimeout(function(){ }, 5000);
    resize();
    setTimeout(function(){}, 1000);
    document.getElementsByClassName('load')[0].style.display='none';
});
    var js_array ={!! json_encode(Session::get("CurrentUser")->friendsNames()) !!};
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

</html>