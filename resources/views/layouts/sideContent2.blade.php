<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 conversations">

  <div class="upper" id="friendsearch">
    <div class="search">
      <i class="fal fa-search"></i>
      <input type="search" name="" placeholder="search in friends" onkeyup="checkfriend(this.value)"/>
    </div>
  </div>
  <?php 
  $msgs=App\Http\Controllers\MessageController::getmessage(Session::get('CurrentUser')->id);
  $ids=[];
      ?>
  <div class="upper" id="messagesearch" style="display:none">
    <div class="search">
      <i class="fal fa-search"></i>
      <input type="search" name="" placeholder="search in messages" />
    </div>
  </div>
  <div class="inbox" id="messagelist" style="display:none">
    <!-- messages -->
    @foreach ($msgs as $message)
    <div class="msg friend">
      <div class="perosn">
        @if(!$message->read)
        <div class="warn" id="warn{{$message->user->id}}"></div>
        @endif
        <div class="profile">
          <a href="#">
            <img src="../{{$message->user->image}}" alt="" />
          </a>
        </div>
      </div>
      <div class="details"
        onclick="messageBox(2,'{{$message->user->image}}','{{$message->user->name}}',{{$message->user->id}},{{Session::get('CurrentUser')->id}},'{{ csrf_token() }}')">
        <div class="par">
          <h6>{{$message->user->name}}</h6>
          <p>
            {{App\Http\Controllers\MessageController::encrypt_decrypt('decrypt',$message->text)}}
          </p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="inbox" id="friendslist">
    <!-- messages -->
    @foreach (Session::get('CurrentUser')->friendsWait2 as $user)
    <div class="msg friend user_search" id="{{strtolower($user->name)}}" onmouseover="clicks(1,'friend',{{$user->id}})"
      onmouseout="clicks(2,'friend',{{$user->id}})">
       <div class="perosn">
        <div class="state"></div>
        <div class="profile">
          <a href="#">
            <img src="../{{$user->image}}" alt="" />
          </a> </div>
      </div>
      <div class="details">
        <div class="par">
          <h6 id="h6friend{{$user->id}}">
            {{$user->name}}
          </h6>
          <p id="pfriend{{$user->id}}">
          </p>
        </div>
        <a class='accept_friend' href=""
          onclick="acceptFriend({{Session::get('CurrentUser')->friendsWait2->count()}},this,{{$user->id}},{{Session::get('CurrentUser')->id}},'{{{ csrf_token() }}}')"
          style="padding-right:1vw;padding-left:1vw;">Accept</a>
        <a class='refuse_friend' href=""
          onclick="refuseFriend({{Session::get('CurrentUser')->friendsWait2->count()}},this,{{$user->id}},{{Session::get('CurrentUser')->id}},'{{{ csrf_token() }}}')"
          style="padding-right:1vw;padding-left:1vw;">Reject</a>
      </div>
    </div>
    @endforeach
    @foreach ((Session::get('CurrentUser')->friends) as $use)
    <div class="msg friend user_search" id="{{strtolower($use->name)}}" onmouseover="clicks(1,'friend',{{$use->id}})"
      onmouseout="clicks(2,'friend',{{$use->id}})">      
      <div class="perosn">
        <div class="state"></div>
        <div class="profile">
          <a href="../profile{{$use->id}}/0">
            <img src="../{{$use->image}}" alt="" />
          </a> </div>
      </div>
      <div class="details"
        onclick="messageBox(2,'{{$use->image}}','{{$use->name}}',{{$use->id}},{{Session::get('CurrentUser')->id}},'{{ csrf_token() }}')">
        <div class="par">
          <h6 id="h6friend{{$use->id}}">{{$use->name}}</h6>
          <p id="pfriend{{$use->id}}">
            {{$use->details->about}}
          </p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="inbox" id="notilist" style="display:none">
    <!-- messages -->
    @foreach(Session::get('CurrentUser')->Notifications as $notification)
    <div class="msg friend">
      <div class="perosn">
        <div class="profile">
          <a href="../profile{{$notification->from->id}}/0">
            <img src="../{{$notification->from->image}}" alt="" />
          </a>
        </div>
      </div>
      <div class="details"
        onclick='notification({{$notification->post->group_id}},{{$notification->post->page_id}},{{$notification->id}},{{$notification->post_id}},"{{ csrf_token() }}")'>
        <div class="par">
          <h6>{{$notification->from->name}}</h6>
          @if($notification->type <6) <p>
            React on your Post
            </p>
            @elseif($notification->type ==6)
            <p>
              Comment on your Post
            </p>
            @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="inbox" id="pagelist" style="display:none">
    <!-- messages -->
    <a href="../createpage" style="margin-left: 25px;"> Create new page </a>
    <?php
    $array = [];
    $arr = [];
    foreach(Session::get('CurrentUser')->pages as $page){
      array_push($array,$page->id);
      array_push($arr,$page);
    }
    foreach (Session::get('CurrentUser')->follows as $page) {
      if(!in_array($page->id,$array)){
      array_push($array,$page->id);
      array_push($arr,$page);
    }
  }
  $random_page = App\Http\Controllers\PageController::getpages(Session::get('CurrentUser'));
    ?>
    <!--Suggestion-->
    <p style="color:black; padding-left: 25px;">Suggestion for Following</p>
    <div class="msg friend">
      <div class="perosn">
        <div class="profile">
          <a href="../page{{$random_page->id}}">
            <img src="../{{$random_page->image}}" alt="" />
          </a>
        </div>
      </div>
      <a href="../page{{$random_page->id}}">
      <div class="details" >
        <div class="par">
          <h6>{{$random_page->name}}</h6>
            <p>
              {{$random_page->about}}
            </p>
        </div>
      </div>
      </a>
    </div>
    <!--following-->
    <p style="color:black; padding-left: 25px;">Following</p>
    @foreach ($arr as $page)
      <div class="msg friend">
      <div class="perosn">
        <div class="profile">
          <a href="../page{{$page->id}}">
            <img src="../{{$page->image}}" alt="" />
          </a>
        </div>
      </div>
      <a href="../page{{$page->id}}">
      <div class="details" >
        <div class="par">
          <h6>{{$page->name}}</h6>
            <p>
              {{$page->about}}
            </p>
        </div>
      </div>
      </a>
    </div>
    @endforeach
  </div>
  <div class="inbox" id="groupslist" style="display:none">
    <!-- messages -->
    <a href="../creategroup" style="margin-left: 25px;"> Create new group </a>
    <?php
        $random = null;
        $groups=App\Http\Controllers\GroupController::getgroups(Session::get('CurrentUser'));
        foreach ($groups as $group) {
        if(! $group->users->contains(Session::get('CurrentUser')->id)){
        $random = $group;
        break;
        }
      }
    ?>
    <!--Suggestion-->
    @if($random !=null)
    <p style="color:black; padding-left: 25px;">Suggestion for Following</p>
    <div class="msg friend">
      <div class="perosn">
        <div class="profile">
          <a href="../group{{$random->id}}">
            <img src="../{{$random->image}}" alt="" />
          </a>
        </div>
      </div>
      <a href="../group{{$random->id}}">
        <div class="details">
          <div class="par">
            <h6>{{$random->name}}</h6>
            <p>
              {{$random->about}}
            </p>
          </div>
        </div>
      </a>
    </div>
    @endif
    <!--following-->
    <p style="color:black; padding-left: 25px;">Requests</p>
    @foreach (Session::get('CurrentUser')->Requests as $group )
    <div class="msg friend">
      <div class="perosn">
        <div class="profile">
          <img src="../{{$group->from->image}}" alt="" />
        </div>
      </div>
      <div class="details">
        <div class="par">
          <h6>{{$group->from->name}}</h6>
          <p>
            Asked to join {{$group->text}}
          </p>
          <a class='accept_friend' href=""
            onclick="accept({{$group->post_id}},{{$group->id}},{{$group->from->id}},'{{{ csrf_token() }}}')"
            style="padding-right:1vw;padding-left:1vw;">Accept</a>
          <a class='refuse_friend' href=""
            onclick="refuse({{$group->post_id}},{{$group->id}},{{$group->from->id}},'{{{ csrf_token() }}}')"
            style="padding-right:1vw;padding-left:1vw;">Reject</a>
        </div>
      </div>
    </div>
    @endforeach

    <p style="color:black; padding-left: 25px;">Following</p>
    @foreach (Session::get('CurrentUser')->groups as $group )
    <div class="msg friend">
      <div class="perosn">
        <div class="profile">
          <a href="../group{{$group->id}}">
            <img src="../{{$group->image}}" alt="" />
          </a>
        </div>
      </div>
      <a href="../group{{$group->id}}">
        <div class="details">
          <div class="par">
            <h6>{{$group->name}}</h6>
            <p>
              {{$group->about}}
            </p>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
  <div class="inbox" id="marketlist" style="display:none">
    <!-- messages -->
    <a href="../createproduct" style="margin-left: 25px;"> Create new Product </a>
    <!--following-->
    <p style="color:black; padding-left: 25px;">Offers</p>
    @foreach ( Session::get('CurrentUser')->products as $product )
    <div class="msg friend" id='product{{$product->id}}'>
      <div class="perosn">
        <div class="profile">
          <a href="../product{{$product->id}}">
            <img src="../{{$product->image}}" alt="" />
          </a>
        </div>
      </div>
      <a href="../product{{$product->id}}">
        <div class="details">
          <div class="par">
            <h6>{{$product->name}}</h6>
            @if($product->type == 1)
            @if($product->best_offer() != null)
            <h5 class="offer_price">offer = {{$product->best_offer()->price}}$</h5>
            @endif
            <p>
              {{$product->about}}
            </p>
            @if($product->best_offer() != null)
            <a class='accept_friend' id='offeraccept{{$product->best_offer()}}'
              onclick="acceptoffer({{$product->best_offer()->id}},'{{{ csrf_token() }}}')"
              style="padding-right:1vw;padding-left:1vw;">Accept</a>
            <a class='refuse_friend'  id='offerrefuse{{$product->best_offer()}}'
            onclick="refuseoffer({{$product->best_offer()->id}},'{{ csrf_token() }}')"
              style="padding-right:1vw;padding-left:1vw;">Reject</a>
            @endif
            @endif
          </div>
        </div>
      </a>
    </div>
    @endforeach
    <p style="color:black; padding-left: 25px;">Sold</p>
    @foreach (Session::get('CurrentUser')->sold_products() as $offer)
    <div class="msg friend" id='product{{$offer->productid()}}'>
      <div class="perosn">
        <div class="profile">
          <a href="../product{{$offer->productid()}}">
          <img src="../{{$offer->productImage()}}" alt="" />
          </a>
        </div>
      </div>
      <a href="../product{{$offer->productid()}}">
        <div class="details">
          <div class="par">
            <h6>{{$offer->productname()}}</h6>
            <h5 class="offer_price">offer = {{$offer->price}}$</h5>
            {{-- @if($product->best_offer() != null)
            <h5 class="offer_price">offer = {{$product->best_offer()->price}}$</h5>
            @endif --}}
            <p>

            </p>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>

@yield('content')