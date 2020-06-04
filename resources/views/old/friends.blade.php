<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/friendsStyle.css') }}">
</head>

<body>
<img src="images/friend.png" style='border-radius:50%; MARGIN-LEFT: 2VW; margin-top=0;width: 25vw;'height='50px' alt="">
<h2>Friends</h2>
<hr>
@foreach ((Session::get('CurrentUser')->friends) as $user)
<hr>
<div class='friend' onclick="messageBox('{{$user->image}}','{{$user->name}}',{{$user->id}},{{Session::get('CurrentUser')->id}},'{{ csrf_token() }}')">
    <img src="{{$user->image}}"  width='50px' style='border-radius:50%; MARGIN-LEFT: 2VW; 'height='50px' alt="">
    <h3>{{$user->name}}</h3>
</div>
@endforeach
<hr>
</body>
<script type="text/javascript" src="{{ asset('js/message.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/profile/welcome.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</html