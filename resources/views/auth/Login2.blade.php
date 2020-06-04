<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <form id="myform" method="POST" enctype="multipart/form-data" action="{{ route('ServerLoginUser') }}">
        {{ csrf_field() }}
        <div class="box">
            <div class="image">
                <img src="{{ asset('images/user.png') }}">
            </div>
            <div class="inputnow" id="stepnow0">
                    <div class="input-group2 mb-3" id="">
                            <p style=" color: aliceblue; display:'block'">Enter your mail</p>
                        <input type="text" id="name" class="form-control" name = "name" placeholder="Your mail" onkeyup="input_login(js_array,js_array2,this,1)" autocomplete="off">
                    </div>
                    <div class="input-group3 mb-3" id="">
                            <p style="color: aliceblue">Enter your password</p>
                        <input type="password" id="pass" class="form-control" name = "pass" disabled placeholder="Your password" onkeyup="input_login(js_array,js_array2,this,2)" autocomplete="off">
                    </div>
                </div>
                <div id='register' style='padding-top: 60%;'>
                    <a href="{{ route('register') }}"> Don't have an account yet</a>
                    </div>
                <button id="login" type="submit" class="btn btn-primary" style="top: 75%;position: absolute;left: 45%;" onclick="{{ route('ServerLoginUser') }}" disabled>Login</button>
            </div>
            
    </form>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script> var js_array =<?php echo json_encode($users);?>; 
             var js_array2 =<?php echo json_encode($pass);?>; 
    </script>
    <script src="{{ asset('js/kimo.js') }}"></script>
</body>

</html>