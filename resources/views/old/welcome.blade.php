<html lang="en">
<head>
        @include('layouts.welcome')
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
        <form  action="use" id="myform" method="POST" enctype="multipart/form-data" >
            {{ csrf_field() }}        
            <div class="modal-form">
                <h1>Choose a Cover</h1>
                <div class="inputfile" id="stepnow4" style="">
                    <div class="custom-file input-group">
                        <input type="file" class="custom-file-input" id="customFile"
                               name="photo" oninput="inputimg(this)">
                        <input type="file" class="custom-file-input" id="hiddenFile" 
                               name="type" value="cover">
                        <label id="inputlabel" class="custom-file-label" for="customFile">
                            Choose file
                        </label>
                        <button id='mail4' onclick="Update('{{Session::get('CurrentUser')->name}}','cover','{{{ csrf_token() }}}')"class="btn btn-primary"
                         type="button" disabled style=" margin-left: 35%; margin-top: 10px;">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="changeImage" class="modal">
            <form  action="use" id="myform2" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}        
                <div class="modal-form">
                    <h1>Choose a Image</h1>
                    <div class="inputfile" id="stepnow4" style="">
                        <div class="custom-file input-group">
                            <input type="file" class="custom-file-input" id="customFile2"
                                   name="photo" oninput="inputImg(this)">
                            <input type="file" class="custom-file-input" id="hiddenFile2" 
                                   name="type" value="cover">
                            <label id="imageChanger" class="custom-file-label" for="customFile">
                                Choose file
                            </label>
                            <button id='img' onclick="Update('{{Session::get('CurrentUser')->name}}','image','{{{ csrf_token() }}}')"class="btn btn-primary"
                             type="button" disabled style=" margin-left: 35%; margin-top: 10px;">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="changeInfo" class="modal">
                <form  action="use" id="myform3" method="POST" enctype="multipart/form-data" >
                    {{ csrf_field() }}        
                    <div class="modal-form" style="width: 64%;">
                        <h1 >
                            Update your Info
                        </h1>
                        <div style="position: relative;top: -40px;">
                            <h3 onclick="show_name()">                                    
                                Name
                            </h3>
                            <input type="text" id="name" class="form-control" 
                                   value="{{Session::get('CurrentUser')->name}}"autocomplete="off">
                            <div style="height: 5;"></div>
                            <h3 onclick="show_pass()">                                    
                                Password
                            </h3>
                            <input type="password" id="password-old" class="form-control" placeholder=" Your old password" 
                                   onkeyup="pass(1,'{{Session::get('CurrentUser')->email}}',this,'{{{ csrf_token() }}}')" autocomplete="off">
                            <div style="height: 5;"></div>
                            <input type="password" id="password-new" class="form-control" placeholder="Your new password" 
                                   onkeyup="pass(2,'','','')" autocomplete="off">
                            <div style="height: 5;"></div>
                            <input type="password" id="password-confirm" class="form-control" placeholder="Confirm Your password"
                                   onkeyup="pass(2,'','','')" autocomplete="off">
                            <button id='info' onclick="Update('{{Session::get('CurrentUser')->id}}','info','{{{ csrf_token() }}}')"class="btn btn-primary"
                                    type="button" disabled style="position: absolute;left: 17vw;width: 8vw;">
                                Next
                            </button>
                        </div>
                    </div>
                </form>
            </div>
    <div id="image" class="modal"> 
        <div class="modal-form" id="showImg">
            <img id='imageshowing' src='{{Session::get('CurrentUser')->image}}'>
        </div>
    </div>
    <div id="container">
        <div id="c2">
            <img  src="{{Session::get('CurrentUser')->cover}}" style="border-radius: 0% ;">
        </div>
        <div id="c3">
            <img  id='imgc3' src="{{Session::get('CurrentUser')->image}}" style="">
        </div>
        <div id="c4">
            <h1 class="glow"> {{Session::get('CurrentUser')->name}}</h1>
        </div>
        <div class="element" onclick="openOption()">
        </div>
        <ul class="list-group" id='options' style='display:none;'>
            <li class="setting list-group-item " onclick="coverChange()">Change cover</li>
            <li class="list-group-item setting" onclick="coverImage()">Change image</li>
            <li class="list-group-item setting" onclick="changeInfo()">Change Information</li>
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
            <img src="globe-logo-7DED53A9AA-seeklogo.com.png">
            <h1>About</h1>
            <p>
                {{Session::get('CurrentUser')->details->about}}
                <hr>
            </p>
                <h5>
                <i class="fa fa-address-book">
                </i>
                <b>Adress:  </b>{{Session::get('CurrentUser')->details->address}}
                <h5><h5>
                <i class="fa fa-graduation-cap">
                </i>
                <b>Studied at:  </b>{{Session::get('CurrentUser')->details->study}}
                <h5><h5>
                <i class="fa fa-suitcase">
                </i>
                <b>Worked at:  </b>{{Session::get('CurrentUser')->details->work}}
                <h5>
                <h5><i class="fa fa-birthday-cake">
                </i>
                <b>Born in: </b>{{Session::get('CurrentUser')->details->date}}
                <h5><h5>
                <i class="fa fa-envelope-o">
                </i>
                @if(Session::get('CurrentUser')->details->mail)
                    <b>Mail: </b>{{Session::get('CurrentUser')->email}}
                @else
                    <b>Mail: </b>Unavailable
                @endif
                <h5>
                <h5><i class="fa fa-phone ">
                </i>
                <b>Phone: </b>{{Session::get('CurrentUser')->details->phone}}
                <h5>
                <h5>
                <h5><i class="fa fa-heart ">
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
                <h5><h5>
                <i class="fa fa-futbol-o ">
                </i>
                <b>Hobbies: </b>{{Session::get('CurrentUser')->details->hobbies}}
                <h5>      
        </div>
        <div class='post'>
            <div class='box' >
                <section>
                    <div class="text">
                        <img class = 'poster_image' src="{{Session::get('CurrentUser')->image}}"/>
                        <textarea style = 'display:none;'id='text2' placeholder="What's in your mind" 
                                  onclick="text()" rows="1"></textarea>
                        <button onclick="post('{{{ csrf_token() }}}')">submit</button>            
                        <form  method="post" enctype="multipart/form-data" id='form1' class="md-form">
                            <div class="file-field">
                                <div>
                                    <div class="btn btn-primary">
                                        <span >Choose img</span>
                                        <input type="file" name="image2" id='imgpost' 
                                               onchange='kiko()' id="sortpic">
                                        <input type="text" value="welcome" style="display:none;">
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
                $posts=App\Http\Controllers\ProfileController::getposts(Session::get('CurrentUser')->id);
            ?>
            @foreach ($posts as $post)                
                <div class="box update" id= 'postnum{{$post->id}}'>
                    <div class="box-header">
                        <h3>
                        <a href=""><img src="{{$post->users->image}}" alt="" />{{$post->users->name}}</a>
                        <span>{{App\Http\Controllers\ProfileController::dating($post->created_at)}}
                            <i class="fa fa-globe">
                            </i>
                        </span>
                        </h3>
                        <span>
                            <i class="fa fa-trash-o" aria-hidden="true" onclick='deletePost({{$post->id}},"{{{ csrf_token() }}}")'>
                            </i>
                        </span>
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
                            <img src="{{$post->image}}" alt="" />
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
                            <span  style="display:block;">
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
                            <i onclick = "like({{$post->id}},{{Session::get('CurrentUser')->id}},1,
                                         '{{{ csrf_token() }}}',{{count($post->likes)}},
                                         '{{Session::get('CurrentUser')->image}}',
                                         {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                                class="fas fa-thumbs-up">
                            </i>
                            <i onclick = "like({{$post->id}},{{Session::get('CurrentUser')->id}},2,
                                         '{{{ csrf_token() }}}',{{count($post->likes)}},
                                         '{{Session::get('CurrentUser')->image}}',
                                         {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                               class="fas fa-grin-hearts">
                            </i>
                            <i onclick = "like({{$post->id}},{{Session::get('CurrentUser')->id}},3,
                                         '{{{ csrf_token() }}}',{{count($post->likes)}},
                                         '{{Session::get('CurrentUser')->image}}',
                                         {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                               class="fas fa-laugh-squint"></i>
                            <i onclick = "like({{$post->id}},{{Session::get('CurrentUser')->id}},4,
                                         '{{{ csrf_token() }}}',{{count($post->likes)}},
                                         '{{Session::get('CurrentUser')->image}}',
                                         {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                               class="fas fa-angry"></i>
                            <i onclick = "like({{$post->id}},{{Session::get('CurrentUser')->id}},5,
                                         '{{{ csrf_token() }}}',{{count($post->likes)}},
                                         '{{Session::get('CurrentUser')->image}}',
                                         {{$post->liked(Session::get('CurrentUser')->id)}},{{$post->user}})"
                               class="fas fa-sad-tear">
                            </i>
                        </div>
                            @if($post->liked(Session::get('CurrentUser')->id)==0)
                                <button id = 'like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                        onmouseout="closeBubble({{$post->id}})">
                                    <span  class="fa fa-thumbs-up">
                                    </span>
                                </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==1)
                                <button id = 'like{{$post->id}}' class='like_btn' onmouseover="openBubble({{$post->id}})"
                                        onmouseout="closeBubble({{$post->id}})">
                                    <span  class='fa fa-thumbs-up'style='color: darkcyan;'>
                                        Like
                                    </span>
                                </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==2)
                                <button id = 'like{{$post->id}}' class='like_btn' onmouseover='openBubble({{$post->id}})'
                                        onmouseout='closeBubble({{$post->id}})'>
                                    <span  class='fas fa-grin-hearts'style='color: hotpink;'>
                                        Love
                                    </span>
                                </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==3)
                                <button id = 'like{{$post->id}}' class='like_btn'onmouseover="openBubble({{$post->id}})"
                                        onmouseout="closeBubble({{$post->id}})">
                                    <span  class='fas fa-laugh-squint'style='color: gold;'>
                                        Haha
                                    </span>
                                </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==4)
                                <button id = 'like{{$post->id}}' class='like_btn'onmouseover="openBubble({{$post->id}})"
                                        onmouseout="closeBubble({{$post->id}})">
                                    <span  class='fas fa-angry'style='color: crimson;'>
                                        Angry
                                    </span>
                                </button>
                            @elseif($post->liked(Session::get('CurrentUser')->id)==5)
                                <button id = 'like{{$post->id}}' class='like_btn'onmouseover="openBubble({{$post->id}})"
                                        onmouseout="closeBubble({{$post->id}})">
                                    <span  class='fas fa-sad-tear' style='color: indigo;'>
                                        Sad
                                    </span>
                                </button>
                            @endif
                            <button  onclick="commentsShow({{$post->id}})">
                                <span class="ion-chatbox-working">
                                </span>
                            </button>
                            <button>
                                <span class="ion-share">
                                </span>
                            </button>
                    </div>
                </div>
                <div  class = 'comment-group' id='group{{$post->id}}'>
                 {{-- <div class="box-click"><span><i class="ion-chatbox-working"></i> View 140 more comments</span></div> --}}
                    <div class="box-comments" id = 'post_comment{{$post->id}}'>
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
                                <textarea id='textarea{{$post->id}}'placeholder="write a comment...">
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