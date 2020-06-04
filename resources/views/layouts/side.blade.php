<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 profile-side">
  <!--profile informations-->
  <div class="info">
    <div class="hold">
      <div class="profile">
        <img src="{{Session::get('CurrentUser')->image}}" onclick="welcomeProfile()" alt="" />
      </div>
    </div>
    <h6>{{Session::get('CurrentUser')->name}}</h6>
    <p>{{Session::get('CurrentUser')->details->about}}</p>
    <div class="friends">
      <div>
        <i class="fal fa-user-check"></i>
        <p>
          2,354 <br />
          <span>followers</span>
        </p>
      </div>

      <div>
        <i class="fal fa-user-plus"></i>
        <p>
          2,354 <br />
          <span>followers</span>
        </p>
      </div>
    </div>
  </div>

  <!---->
  <div class="navigator">
    <div class="icons-parent">

      <div class="icon">
        <div onclick="changenoti()">
          <i class="fal fa-bell"></i>
          <h6>notifications</h6>
          <?php
                  $count=count(Session::get('CurrentUser')->Notifications);
                  ?>
          @if($count!=0)
          <div class="notification_bubble" id="notification_bubble">{{$count}}</div>
          @endif
        </div>
      </div>

      <div class="icon">
        <div onclick="changegroups()">
          <i class="fal fa-users-crown"></i>
          <h6>Groups</h6>
          <?php
                  $count=count(Session::get('CurrentUser')->Requests);
                  ?>
          @if($count!=0)
          <div class="group_bubble" id="notification_bubble">{{$count}}</div>
          @endif
        </div>
      </div>

      <div class="icon" id="msgs_icon">
        <div onclick="changemsgs()">
          <i class="fal fa-comment"></i>
          <h6>messages</h6>
          <?php
                  $count=count(App\Http\Controllers\MessageController::getNum(Session::get('CurrentUser')->id));
                  ?>
          @if($count!=0)
          <div class="message_bubble" id="message_bubble">{{$count}}</div>
          @endif
        </div>
      </div>

      <div class="icon">
        <div onclick="changeFriends()">
          <i class="fal fa-user-friends"></i>
          <h6>Friends</h6>
          <?php
                  $count=count(Session::get('CurrentUser')->friendsWait2);
                  ?>
          @if($count!=0)
          <div class="request_bubble" id="request_bubble">{{$count}}</div>
          @endif
        </div>
      </div>

      <div class="icon">
        <div onclick="changepages()">
          <i class="fal fa-newspaper"></i>
          <h6>pages</h6>
        </div>
      </div>

      <div class="icon">
        <div onclick="changemarket()">
          <i class="fal fa-shopping-bag" aria-hidden="true"></i>
          <h6>Market</h6>
          <?php
                    $count= count(Session::get('CurrentUser')->offers());
          ?>
          @if($count!=0)
          <div class="notification_bubble" id="notification_bubble">{{$count}}</div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@yield('content')