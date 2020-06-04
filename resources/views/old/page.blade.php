<html lang="en">

<head>
    @include('layouts.welcome2')
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
                            onclick="Update('{{Session::get('CurrentPage')->name}}','coverPage','{{{ csrf_token() }}}')"
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
                        onclick="Update('{{Session::get('CurrentUser')->name}}','image','{{{ csrf_token() }}}')"
                        class="btn btn-primary" type="button" disabled style=" margin-left: 35%; margin-top: 10px;">
                        Next
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="changeInfo" class="modal">
        <form action="use" id="myform3" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-form" style="width: 64%;">
                <h1>
                    Page Editors
                </h1>
                <div style="position: relative;top: -40px;">
                    @foreach (Session::get('CurrentPage')->admins as $admin)
                    <div id='admin{{$admin->id}}' style="width: 100%; height: 75;">
                        <img src="../{{$admin->image}}"
                            style='height: 75; width: 75;position: relative;top: -25px;border-radius: 50%;float: left;'>
                        <h4 style="float: left;position: relative; color:white; cursor:pointer"
                            onclick='profile({{$admin->id}})'>
                            {{$admin->name}}
                        </h4>
                        <button type="button" class="btn btn-danger" style="position: relative; top: -0.5vw;"
                            onclick="Admin({{$admin->id}},'remove','{{{ csrf_token() }}}')">
                            Unfollow
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
                        type="button" style="position: absolute;left: 17vw;width: 8vw;">
                        Next
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div id="image" class="modal">
        <div class="modal-form" id="showImg">
            <img id='imageshowing' src='../{{$page->image}}'>
        </div>
    </div>
    <div id="container">
        <div id="c2">
            <img src="../{{Session::get('CurrentPage')->cover}}" style="border-radius: 0% ;">
        </div>
        <div id="c3">
            <img id='imgc3' src="../{{Session::get('CurrentPage')->image}}" style="">
        </div>
        <div id="c4">
            <a href='/page{{Session::get('CurrentPage')->id}}'>
                <h1 class="glow"> {{Session::get('CurrentPage')->name}}
                </h1>
            </a>
        </div>
        @if(Session::get('CurrentPage')->admin ==Session::get('CurrentUser')->id)
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
                    @if(Session::get('CurrentPage')->followers->contains(Session::get('CurrentUser')->id))
                    <button type="button" class="btn btn-danger"
                        onclick="UnFollowing(this,{{$page->id}},'{{{ csrf_token() }}}')">
                        UnFollow
                    </button>
                    @else
                    <button type="button" class="btn btn-primary"
                        onclick="UnFollowing(this,{{$page->id}},'{{{ csrf_token() }}}')">
                        Follow
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class='aboutGroup'>
            <img src="../globe-logo-7DED53A9AA-seeklogo.com.png">
            <h1>About</h1>
            <p>
                {{Session::get('CurrentPage')->about}}
                <hr>
            </p>
            <h5>
                <i class="fas fa-user-tie">
                </i>
                <b>Admin: </b>{{Session::get('CurrentPage')->Admin()->name}}
                <h5>
                    <h5>
                        @foreach ( Session::get('CurrentPage')->admins as $admin)
                        <i class="fas fa-users-cog">
                        </i>
                        <b>Editor: </b>{{$admin->name}}
                        <h5>
                            <h5>
                                @endforeach
                                <i class="fas fa-user-friends">
                                </i>
                                <b>Followed by : </b>{{count(Session::get('CurrentPage')->followers)}} Users
                                <h5>
                                    <h5>
        </div>
        @if(Session::get('CurrentPage')->admins->contains(Session::get('CurrentUser')->id) || Session::get('CurrentPage')->admin == Session::get('CurrentUser')->id)
        <div class='post'>
            <div class='box'>
                <section>
                    <div class="text">
                        <img class='poster_image' src="../{{Session::get('CurrentPage')->image}}" />
                        <textarea style='display:none;' id='text2' placeholder="What's in your mind" onclick="text()"
                            rows="1"></textarea>
                        <button onclick="page_post('{{{ csrf_token() }}}')">submit</button>
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
        @else
        <div class='post'>
            <h3 style="font-size: 2vw;margin-left: 2vw; margin-top:2vw"> Friends that follow this page</h3>
            @foreach (Session::get('CurrentUser')->friendsPage(Session::get('CurrentPage')->id) as $friend)
            <img src='../{{$friend->image}}' style="width:8vw;height:8vw;border-radius:50%; margin-left:2vw">
            @endforeach
            @endif
            <section class="new">
                <div class="container" id='cont'>
                    <?php 
                $posts=App\Http\Controllers\PageController::posts(Session::get('CurrentPage')->id);
            ?>
                    @foreach ($posts as $post)
                    <div class="box update" id='postnum{{$post->id}}'>
                        <div class="box-header">
                            <h3>
                                <a href=""><img src="../{{$post->pages->image}}" alt="" />{{$post->pages->name}}</a>
                                <span>{{App\Http\Controllers\ProfileController::dating($post->created_at)}}
                                    <i class="fa fa-globe">
                                    </i>
                                </span>
                            </h3>
                            @if(Session::get('CurrentPage')->admins->contains(Session::get('CurrentUser')->id))
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
                                    <span class="ion-share"  onclick='share(this,{{$post->id}},"{{{ csrf_token() }}}")'>
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
                                        <textarea id='textarea{{$post->id}}' placeholder="write a comment...">
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