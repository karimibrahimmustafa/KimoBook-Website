<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/welcomeStyle.css') }}">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://kit.fontawesome.com/187a36c70a.js"></script>
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css"
        media="all">
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css"
        media="all">
    <link href="../css/post.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/loading.css">
    <link rel="stylesheet" href="../css/loader-1.css">
</head>

<body>
    <div class='load'>
        <div class="loader-wrapper" id="loader-1">
            <div id="loader"></div>
        </div>

        <script>
            loaders = document.getElementsByClassName('loader-wrapper');
                    loaders[0].style.display = "inherit";
            
                    function change(self) {
                        for (var i = loaders.length - 1; i >= 0; i--) {
                            loaders[i].style.display = "none";
                        }
                        id = self.id;
                        loaders[id - 1].style.display = "inherit";
                    };
        </script>
    </div>
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
        </div>
    </div>
    <div id="image" class="modal">
        <div class="modal-form" id="showImg">
            <img id='imageshowing' src='{{'..\\'.$user->image}}'>
        </div>
        </form>
    </div>
    <div id="container">
        <div id="c2">
            <img src="{{'..\\'.$user->cover}}" style="border-radius: 0% ;">
        </div>
        <div id="c3">
            <img id='imgc3' src="{{'..\\'.$user->image}}" style="">
        </div>
        <div id="c4">
            <h1 class="glow"> {{$user->name}}</h1>
        </div>
        <div class="element" onclick="openOption()"></div>
        <ul class="list-group" id='options' style='display:none;'>
            <li class="setting list-group-item " onclick='removeFriend(1,this,{{$user->id}},
            {{$current->id}}, "{{ csrf_token() }}")'>Remove Friend</li>
            <li class="list-group-item setting">Stop Following</li>
        </ul>
        <div class='Options'>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">
                <div class="list-group list-group-horizontal optionList">
                    <a href="#" class="list-group-item about">About</a>
                    <a href="#" class="list-group-item about">Friends</a>
                    <a href="#" class="list-group-item about">Photos</a>
                    <a href="#" class="list-group-item about">Groups</a>
                    <a href="#" class="list-group-item about">Pages</a>
                </div>
            </div>
        </div>
        <div class='aboutGroup'>
            <img src="../globe-logo-7DED53A9AA-seeklogo.com.png">
            <h1>About</h1>
            <p>
                {{$user->details->about}}
                <hr>
            </p>
            <h5><i class="fa fa-address-book">
                </i>
                <b>Adress: </b>{{$user->details->address}}
                <h5>
                    <h5><i class="fa fa-graduation-cap">
                        </i>
                        <b>Studied at: </b>{{$user->details->study}}
                        <h5>
                            <h5><i class="fa fa-suitcase">
                                </i>
                                <b>Worked at: </b>{{$user->details->work}}
                                <h5>
                                    <h5><i class="fa fa-birthday-cake">
                                        </i>
                                        <b>Born in: </b>{{$user->details->date}}
                                        <h5>
                                            <h5><i class="fa fa-envelope-o">
                                                </i>
                                                @if($user->details->mail)
                                                <b>Mail: </b>{{$user->email}}
                                                @else
                                                <b>Mail: </b>Unavailable
                                                @endif
                                                <h5>
                                                    <h5><i class="fa fa-phone ">
                                                        </i>
                                                        <b>Phone: </b>{{$user->details->phone}}
                                                        <h5>
                                                            <h5>
                                                                <h5><i class="fa fa-heart ">
                                                                    </i>
                                                                    @if($user->details->state == 0)
                                                                    Single
                                                                    @elseif($user->details->state == 1)
                                                                    Engaged
                                                                    @elseif($user->details->state == 2)
                                                                    Married
                                                                    @else
                                                                    Divorced
                                                                    @endif
                                                                    <h5>
                                                                        <h5><i class="fa fa-futbol-o ">
                                                                            </i>
                                                                            <b>Hobbies: </b>{{$user->details->hobbies}}
                                                                            <h5>
        </div>
        <section class="new">
            <div class="container" id='cont' style="top:-160;">
                <?php
                      $posts=App\Http\Controllers\ProfileController::getposts($user->id);
                ?>
                @foreach ($posts as $post)
                <div class="box update" id='postnum{{$post->id}}'>
                    <div class="box-header">
                        <h3>
                            <a href=""><img src="{{'..\\'.$post->users->image}}" alt="" />{{$post->users->name}}</a>
                            <span>{{App\Http\Controllers\ProfileController::dating($post->created_at)}} <i
                                    class="fa fa-globe"></i></span>
                        </h3>
                        <div class="window"><span></span></div>
                        @if($post->shared !=0)
                        <h3 style="height:100;">
                                @if($post->share()->page != 0 )
                                <a href="" style="float: right; height:100;">
                                    <img src="{{'..\\'.$post->share()->pages->image}}" alt="" style="float: right;top:8;position: relative;" />{{$post->share()->pages->name}}</a>
                                @elseif($post->share()->group != 0 )
                                <a href="" style="float: right; height:100;">
                                    <img src="{{'..\\'.$post->share()->users->image}}" alt=""style="float: right;top:8;position: relative;" />{{$post->share()->users->name}}</a>
                                at group <a href="group{{$post->share()->group_id}}"> {{$post->share()->groups->name}}</a>
                                @else
                                <a href="" style="float: right; height:100;">
                                    <img src="{{'..\\'.$post->share()->users->image}}" alt="" style="float: right;top:8;position: relative;"/>{{$post->share()->users->name}}</a>
                                @endif
                            <span style="float: right;position: relative;right: -40px;top: 13px;">
                                {{App\Http\Controllers\ProfileController::dating($post->share()->created_at)}}
                                <i class="fa fa-globe">
                                </i>
                            </span>
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
                            <div class="img" onclick="Img('..\\{{$post->share()->image}}')">
                                <img src="{{'..\\'.$post->share()->image}}" alt="" />
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="box-content">
                        <div class="content">
                            <p>{{$post->text}}</p>
                            @if($post->image != '')
                            <div class="img" onclick="Img('{{'..\\'.$post->image}}')"><img src="{{'..\\'.$post->image}}"
                                    alt="" /></div>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="box-likes">
                        <div class="row" id='likeList{{$post->id}}'>
                            @if(count($post->likes)>0)
                            <span><a href="#"><img src="{{'..\\'.$post->likes[0]->users->image}}" alt="" /></a></span>
                            @if(count($post->likes)>1)
                            <span><a href="#"><img src="{{'..\\'.$post->likes[1]->users->image}}" alt="" /></a></span>
                            @endif
                            @if(count($post->likes)>2)
                            <span><a href="#"><img src="{{'..\\'.$post->likes[2]->users->image}}" alt="" /></a></span>
                            @endif
                            @if(count($post->likes)>3)
                            <span id='count{{$post->id}}'><a href="#">+{{count($post->likes)-3}} others</a></span>
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
                            <span>{{count($post->comments)}} comments</span>
                        </div>
                    </div>
                    <div class="box-buttons">
                        <div class="row">
                            <div class="bubble" id="bubble{{$post->id}}" onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <i onclick="like({{$post->id}},{{$current->id}},1,'{{{ csrf_token() }}}',{{count($post->likes)}},'{{$current->image}}','{{$post->liked($current->id)}}',{{$post->user}})"
                                    class="fas fa-thumbs-up"></i>
                                <i onclick="like({{$post->id}},{{$current->id}},2,'{{{ csrf_token() }}}',{{count($post->likes)}},'{{$current->image}}','{{$post->liked($current->id)}}',{{$post->user}})"
                                    class="fas fa-grin-hearts"></i>
                                <i onclick="like({{$post->id}},{{$current->id}},3,'{{{ csrf_token() }}}',{{count($post->likes)}},'{{$current->image}}','{{$post->liked($current->id)}}',{{$post->user}})"
                                    class="fas fa-laugh-squint"></i>
                                <i onclick="like({{$post->id}},{{$current->id}},4,'{{{ csrf_token() }}}',{{count($post->likes)}},'{{$current->image}}','{{$post->liked($current->id)}}'.{{$post->user}})"
                                    class="fas fa-angry"></i>
                                <i onclick="like({{$post->id}},{{$current->id}},5,'{{{ csrf_token() }}}',{{count($post->likes)}},'{{$current->image}}','{{$post->liked($current->id)}}',{{$post->user}})"
                                    class="fas fa-sad-tear"></i>
                            </div>
                            @if($post->liked($current->id)==0)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class="fa fa-thumbs-up"></span></button>
                            @elseif($post->liked($current->id)==1)
                            <button id='like{{$current->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class='fa fa-thumbs-up' style='color: darkcyan;'>Like</span></button>
                            @elseif($post->liked($current->id)==2)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover='openBubble({{$post->id}})'
                                onmouseout='closeBubble({{$post->id}})'>
                                <span class='fas fa-grin-hearts' style='color: hotpink;'>Love</span></button>
                            @elseif($post->liked($current->id)==3)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class='fas fa-laugh-squint' style='color: gold;'>Haha</span></button>
                            @elseif($post->liked($current->id)==4)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class='fas fa-angry' style='color: crimson;'>Angry</span></button>
                            @elseif($post->liked($current->id)==5)
                            <button id='like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                onmouseout="closeBubble({{$post->id}})">
                                <span class='fas fa-sad-tear' style='color: indigo;'>Sad</span></button>
                            @endif
                            <button onclick="commentsShow({{$post->id}})"><span
                                    class="ion-chatbox-working"></span></button>
                            @if($post->shared ==0)
                            <button><span class="ion-share"  onclick='share(this,{{$post->id}},"{{{ csrf_token() }}}")'></span></button>
                            @else 
                            <button disabled><span class="ion-share"  onclick=''></span></button>
                            @endif
                        </div>
                    </div>
                    <div class='comment-group' id='group{{$post->id}}'>
                        {{-- <div class="box-click"><span><i class="ion-chatbox-working"></i> View 140 more comments</span></div> --}}
                        <div class="box-comments" id='post_comment{{$post->id}}'>
                            @foreach ($post->comments as $comment)
                            <div class="comment"><img src="..\{{$comment->users->image}}" alt="" />
                                <div class="content">
                                    <h3><a href="">{{$comment->users->name}}</a><span><time> 1 hr - </time><a
                                                href="#">Like</a></span></h3>
                                    <p>{{$comment->text}} </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="box-new-comment">
                            <img src="../{{Session::get('CurrentUser')->image}}" alt="" />
                            <div class="content">
                                <div class="row">
                                    <textarea id='textarea{{$post->id}}' placeholder="write a comment..."></textarea>
                                </div>
                                <div class="row">
                                    <span
                                        onclick='addComment({{$post->id}},{{$post->user}},"../{{Session::get("CurrentUser")->image}}","{{Session::get("CurrentUser")->name}}","{{{ csrf_token() }}}")'
                                        class="far fa-comment-dots"></span>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/profile/welcome.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/swiper/app.js') }}"></script>
<script>
    $(document).ready(function() {
    const buttons = document.querySelectorAll("img")
    for (const button of buttons) {
        button.setAttribute('onclick','Img(this.src)');
    }
    setTimeout(function(){ }, 5000);
        resize();
        setTimeout(function(){}, 1000);
        document.getElementsByClassName('load')[0].style.display='none';
});
</script>
@if($postnum!=0)
<script>
    $(document).ready(function() {
    console.log('yes');
  parent.$('html, body').animate({
    scrollTop: $('#postnum'+{{$postnum}}).offset().top
  }, 1000)
});
</script>
@endif

</html