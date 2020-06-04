<html lang="en">

<head>
    @include('layouts.welcome')
    <link rel="stylesheet" href="css/timeline.css">
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

    <div id="image" class="modal">
        <div class="modal-form" id="showImg">
            <img id='imageshowing' src='{{Session::get('CurrentUser')->image}}'>
        </div>
    </div>
    <div id="container">
        <div class='post'>
            <div class='box'>
                <section>
                    <div class="text">
                        <img class='poster_image' src="{{Session::get('CurrentUser')->image}}" />
                        <textarea style='display:none;' id='text2' placeholder="What's in your mind" onclick="text()"
                            rows="1"></textarea>
                        <button onclick="timelinepost('{{{ csrf_token() }}}')">submit</button>
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
                $posts=App\Http\Controllers\ProfileController::timelineposts(Session::get('CurrentUser')->id);
            ?>
                @if (count($posts)==0)
                <h1 style='position: relative;top: 5vw;left: 2vw;transform: translateY(60%);color: gray;'>
                    No Current Posts Add Friends To Get New Posts
                </h1>
                @endif
                @foreach ($posts as $post)
                <div class="box update" id='postnum{{$post->id}}'>
                    <div class="box-header">
                        <h3>
                            @if($post->page != 0 )
                            <a href=""><img src="{{$post->pages->image}}" alt="" />{{$post->pages->name}}</a>
                            @elseif($post->group != 0 )
                            <a href=""><img src="{{$post->users->image}}" alt="" />{{$post->users->name}}</a>
                            at group <a href="group{{$post->group_id}}"> {{$post->groups->name}}</a>
                            @else
                            <a href=""><img src="{{$post->users->image}}" alt="" />{{$post->users->name}}</a>
                            @endif
                            <span>{{App\Http\Controllers\ProfileController::dating($post->created_at)}}
                                <i class="fa fa-globe">
                                </i>
                            </span>
                        </h3>
                        <span>
                            <i class="fa fa-trash-o" aria-hidden="true"
                                onclick='deletePost({{$post->id}},"{{{ csrf_token() }}}")'>
                            </i>
                        </span>
                        <div class="window">
                            <span>
                            </span>
                        </div>
                        @if($post->shared !=0)
                        <h3 style="height:100;">
                            @if($post->share()->page != 0 )
                            <a href=href="" style="float: right; height:100;">
                                <img src="{{$post->share()->pages->image}}" alt=""
                                    style="float: right;top:8;position: relative;" />{{$post->share()->pages->name}}</a>
                            @elseif($post->share()->group != 0 )
                            <a href=href="" style="float: right; height:100;">
                                <img src="{{$post->share()->users->image}}" alt=""
                                    style="float: right;top:8;position: relative;" />{{$post->share()->users->name}}</a>
                            at group <a href="group{{$post->share()->group_id}}"
                                style="float: right;">{{$post->share()->groups->name.' < '}}</a>
                            <span style='float: right;position: relative;right: -135px;top: 27px;'>
                                {{App\Http\Controllers\ProfileController::dating($post->share()->created_at)}}
                                <i class="fa fa-globe">
                                </i>
                            </span>
                            @else
                            <a href=href="" style="float: right; height:100;">
                                <img src="{{$post->share()->users->image}}" alt=""
                                    style="float: right;top:8;position: relative;" />{{$post->share()->users->name}}</a>
                            @endif
                            @if($post->share()->group == 0 )
                            <span style="float: right;position: relative;right: -40px;top: 13px;">
                                {{App\Http\Controllers\ProfileController::dating($post->share()->created_at)}}
                                <i class="fa fa-globe">
                                </i>
                            </span>
                            @endif
                        </h3>
                        @endif
                    </div>
                    @if($post->shared !=0)
                    <div class="box-content">
                        <div class="content">
                            <p>
                                {{$post->share()->text}}
                            </p>
                            @if($post->share()->image != '')
                            <div class="img" onclick="Img('{{$post->share()->image}}')">
                                <img src="{{$post->share()->image}}" alt="" />
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="box-content">
                        <div class="content">
                            <p>
                                {{$post->text}}
                            </p>
                            @if($post->image != '')
                            <div class="img" onclick="Img('{{$post->image}}')">
                                <img src="{{$post->image}}" alt="" />
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
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
                            @if($post->shared ==0)
                            <button><span class="ion-share"
                                    onclick='share(this,{{$post->id}},"{{{ csrf_token() }}}")'></span></button>
                            @else
                            <button disabled><span class="ion-share" onclick=''></span></button>
                            @endif
                        </div>
                    </div>
                    <div class='comment-group' id='group{{$post->id}}'>
                        {{-- <div class="box-click"><span><i class="ion-chatbox-working"></i> View 140 more comments</span></div> --}}
                        <div class="box-comments" id='post_comment{{$post->id}}'>
                            @foreach ($post->comments as $comment)
                            <div class="comment">
                                <img src="{{$comment->users->image}}" alt="" />
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
                            <img src="{{Session::get('CurrentUser')->image}}" alt="" />
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