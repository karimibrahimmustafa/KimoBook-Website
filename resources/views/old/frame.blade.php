<html lang="en">
<?php
    $msgs=App\Http\Controllers\MessageController::getNum(Session::get('CurrentUser')->id);
    ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/frame.css') }}">
</head>

<body onload="state('{{ csrf_token() }}')">
    <div class='friend-list'>
        <iframe src="/friends" scroll name="friend" id='friends' width='100%' frameborder="0" scrolling="no" base
            target="_parent" onscroll="scrolled(this.document)"></iframe>

    </div>
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
    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/timeline" target="container">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-globe">
                        </i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="dropdown-submenu">
                            <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="dropdown-item dropdown-toggle">Pages</a>
                            <ul aria-labelledby="dropdownMenu2" class="dropdown-menu menu2 border-0 shadow">
                                <li class="dropdown-submenu">
                                    <a id="dropdownMenu3" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">Your Pages</a>
                                    <ul aria-labelledby="dropdownMenu3" class="dropdown-menu menu2 border-0 shadow">
                                        <li>@foreach ( Session::get('CurrentUser')->pages as $page )
                                            <a class="dropdown-item" href="page{{$page->id}}"
                                                target='container'>{{$page->name}}</a>
                                            @endforeach
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a id="dropdownMenu3" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">Following Pages</a>
                                    <ul aria-labelledby="dropdownMenu3" class="dropdown-menu menu2 border-0 shadow">
                                        <li>@foreach ( Session::get('CurrentUser')->follows as $page )
                                            <a class="dropdown-item" href="page{{$page->id}}"
                                                target='container'>{{$page->name}}</a>
                                            @endforeach
                                        </li>
                                    </ul>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <a class="dropdown-item" href="/discoverPages" target="container">Pages</a>
                                </li>
                        </div>
                        <div class="dropdown-submenu">
                            <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="dropdown-item dropdown-toggle">Groups</a>
                            <ul aria-labelledby="dropdownMenu2" class="dropdown-menu menu2 border-0 shadow">
                                <li>
                                    @foreach ( Session::get('CurrentUser')->groups as $group )
                                    <a class="dropdown-item" href="group{{$group->id}}"
                                        target='container'>{{$group->name}}</a>
                                    @endforeach
                                </li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <a class="dropdown-item" href="/discoverGroups" target="container">Groups</a>
                                </li>
                            </ul>
                        </div>
                        <a class="dropdown-item" href="logout">Logout</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell" onclick='hidenum()'>
                            @if(count(Session::get('CurrentUser')->Notifications)>0)
                            <span class="badge badge-danger"
                                id='#notification'>{{count(Session::get('CurrentUser')->Notifications)}}</span>
                            @endif
                        </i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach(Session::get('CurrentUser')->Notifications as $notification)
                        @if($notification->type <6) <a class="dropdown-item" id='noti{{$notification->id}}'
                            onclick='notification({{$notification->post->group_id}},{{$notification->post->page_id}},{{$notification->id}},{{$notification->post_id}},"{{ csrf_token() }}")'>
                            <b>{{$notification->from->name}}</b> React on your Post</a>
                            @elseif($notification->type ==6)
                            <a class="dropdown-item" id='noti{{$notification->id}}'
                                onclick='notification({{$notification->post->group_id}},{{$notification->post->page_id}},{{$notification->id}},{{$notification->post_id}},"{{ csrf_token() }}")'>
                                <b>{{$notification->from->name}}</b> Comment on your Post</a>
                            @elseif($notification->type == 7)
                            <div class='requestFriend' id='noti2{{$notification->id}}'>
                                <a class="dropdown-item" href="#" class='request'>
                                    <div>
                                        <h3 style='font-size: 1.5vw; padding-left: 1vw;'>{{$notification->from->name}}
                                            ask you to join {{$notification->text}}
                                        </h3>
                                    </div>
                                </a>
                                <a class='accept' href="#" style="padding-right:1vw;padding-left:1vw;"
                                    onclick="accept({{$notification->post_id}},{{$notification->id}},{{$notification->from->id}},'{{{ csrf_token() }}}')">
                                    Accept
                                </a>
                                <a class='refuse' href="#" style="padding-right:1vw;padding-left:1vw;"
                                    onclick="refuse({{$notification->post_id}},{{$notification->id}},{{$notification->from->id}},'{{{ csrf_token() }}}')">
                                    Refuse
                                </a>
                            </div>
                            @endif
                            @endforeach
                            @if(count(Session::get('CurrentUser')->Notifications)==0)
                            <a class="dropdown-item">There are no notifications</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">See all notification</a>
                    </div>
                </li>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-users">
                            @if(Session::get('CurrentUser')->friendsWait2->count() != 0)
                            <span class="badge badge-primary"
                                id='friendsCount'>{{Session::get('CurrentUser')->friendsWait2->count()}}</span>
                            @endif
                        </i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach (Session::get('CurrentUser')->friendsWait2 as $user)
                        <div class='requestFriend'>
                            <a class="dropdown-item" href="#" class='request' style="width: 186px;">
                                <div>
                                    <img src="{{$user->image}}" width='25px'
                                        style='border-radius: 50%; position: absolute;  left: 0.2vw; margin-top: 0.5;'
                                        height='25px' alt="">
                                    <h3 style='font-size: 1.5vw; padding-left: 1vw;'>{{$user->name}}</h3>
                                </div>
                            </a>
                            <a class='accept' href=""
                                onclick="acceptFriend({{Session::get('CurrentUser')->friendsWait2->count()}},this,{{$user->id}},{{Session::get('CurrentUser')->id}},'{{{ csrf_token() }}}')"
                                style="padding-right:1vw;padding-left:1vw;">Accept</a>
                            <a class='refuse' href=""
                                onclick="refuseFriend({{Session::get('CurrentUser')->friendsWait2->count()}},this,{{$user->id}},{{Session::get('CurrentUser')->id}},'{{{ csrf_token() }}}')"
                                style="padding-right:1vw;padding-left:1vw;">Reject</a>
                        </div>
                        @endforeach
                        @if(Session::get('CurrentUser')->friendsWait2->count() == 0)
                        <a class="dropdown-item">There no Friend Requests</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/discover" target="container">More Friends</a>
                    </div>
                </li>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope">
                            @if(count($msgs)>0)
                            <span class="badge badge-primary msgs">{{count($msgs)}}</span>
                            @endif
                        </i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($msgs as $msg)
                        @if($msg->user->name != "")
                        <a class="dropdown-item" href="#" onclick="openmsg(this,{{$msg->user->id}},{{Session::get('CurrentUser')->id}},'{{$msg->user->image}}'
                         ,'{{$msg->user->name}}','{{{ csrf_token() }}}')">
                            <b>{{$msg->user->name}}</b> send you messages</a>
                        @endif
                        @endforeach
                        @if(count($msgs) == 0)
                        <a class="dropdown-item" href="#">There no new messages</a>
                        @endif
                </li>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-shopping-bag" onclick="hidenum(this)">
                            @if(count(Session::get('CurrentUser')->offers())!=0)
                            <span class="badge badge-primary"
                                id='number'>{{count(Session::get('CurrentUser')->offers())}}
                            </span>
                            @endif
                        </i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="dropdown-submenu">
                            <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="dropdown-item dropdown-toggle">Your products</a>
                            <ul aria-labelledby="dropdownMenu2" class="dropdown-menu menu2 border-0 shadow">
                                <li class="dropdown-submenu">
                                <li>@foreach ( Session::get('CurrentUser')->products as $product )
                                    <a class="dropdown-item" href="product{{$product->id}}"
                                        target='container'>{{$product->name}}</a>
                                    @endforeach
                                </li>
                </li>
                <div class="dropdown-divider"></div>
        </div>
        <div class="dropdown-submenu">
            <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" class="dropdown-item dropdown-toggle">Offers
                ({{count(Session::get('CurrentUser')->productsOffer())}})</a>
            <ul aria-labelledby="dropdownMenu2" class="dropdown-menu menu2 border-0 shadow">
                <li class="dropdown-item">
                    @foreach (Session::get('CurrentUser')->products as $product)
                    @if($product->best_offer() != null)
                    <a id='offer{{$product->best_offer()->id}}' class="dropdown-item" href="#">{{$product->name}}
                        gets an offer with {{$product->best_offer()->price}} $
                        <a id='accept{{$product->best_offer()->id}}' class='accept' href="#"
                            onclick="acceptoffer({{$product->best_offer()->id}},'{{{ csrf_token() }}}')"
                            style="padding-right:1vw;padding-left:3vw;">Accept</a>
                        <a id='refuse{{$product->best_offer()->id}}' class='refuse' href="#"
                            onclick="refuseoffer({{$product->best_offer()->id}},'{{ csrf_token() }}')"
                            style="padding-right:1vw;padding-left:3vw;">Reject</a>
                    </a>
                    @endif
                    @endforeach
                    @if(count(Session::get('CurrentUser')->productsOffer()) ==0)
                    <a class="dropdown-item">There are no Offers</a>
                    @endif
                </li>
                <div class="dropdown-divider"></div>
            </ul>
        </div>
        <div class="dropdown-submenu">
            <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" class="dropdown-item dropdown-toggle">Your Cart ({{
                    Session::get('CurrentUser')->sold_products()->where('type','=',1)->count()
                }})</a>
            <ul aria-labelledby="dropdownMenu2" class="dropdown-menu menu2 border-0 shadow">
                @foreach (Session::get('CurrentUser')->sold_products() as $offer)
                @if($offer != null)
                <li class="dropdown-item">
                    <a href='product{{$offer->productid()}}' class="dropdown-item" target="container"
                        @if($offer->type==1) style='color:green'@endif>
                        {{$offer->productName()}}
                    </a>
                </li>
                @endif
                @endforeach
                @if(count(Session::get('CurrentUser')->sold_products()) == 0)
                <li>
                    <a class="dropdown-item">There are no Offers</a>
                </li>
                @endif
            </ul>
        </div>
        <a class="dropdown-item" href="store" target="container">See All Products</a>
        </div>
        </li>
        </li>
        <span>|</span>
        <li class="name-item nav-item" onclick="welcomeProfile()">
            <a class="nav-link disabled" href="#">
                <div class='name'>{{Session::get('CurrentUser')->name}}</div>
            </a>
        </li>
        </ul>
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" href="/setting" target="container">
                    <i class="fa fa-cog">
                    </i>
                </a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" style="width:35vw">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"
                style="width:25vw;">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        </div>
    </nav>
    <main role="main" class="container">

        <div class="starter-template" id="main" onload="start()">

            <iframe src="/timeline" name="container" id='test' width='100%' frameborder="0" scrolling="no" base
                target="_parent" frameborder="0" scrolling="no"></iframe>
        </div>
</body>
<script type="text/javascript" src="{{ asset('js/message.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/group.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/profile/welcome.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/swiper/app.js') }}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
</html