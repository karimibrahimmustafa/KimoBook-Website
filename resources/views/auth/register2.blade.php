<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <form id="myform" method="POST" enctype="multipart/form-data" >
        {{ csrf_field() }}
        <div class="box">
            <div class="image">
                <img src="{{ asset('images/user.png') }}">
            </div>
            <div class="inputnow" id="stepnow0">
                    <div class="input-group mb-3" id="">
                        <input type="text" id="name" class="form-control" name = "name" placeholder="Your name" onkeyup="input(js_array,this,0)" autocomplete="off">
                        <div class="input-group-append">
                            <button id="mail0" class="btn btn-primary" type="button" onclick="ready(0)" disabled>Next</button>
                            <button style="POSITION: relative;LEFT: -272%;" id="back0" class="btn btn-primary" type="button" onclick="back(0)" disabled>back</button>

                        </div>
                    </div>
                    <p style="padding-left: 20px; color: aliceblue">Enter your name</p>
                </div>
            <div id="stepnow1" style="visibility: hidden;">
                <div class="input-group mb-3" id="">
                    <input type="text" id="email" class="form-control" name = "email" placeholder="Your mail" onkeyup="input(js_array,this,1)" autocomplete="off">
                    <div class="input-group-append">
                        <button id="mail1" class="btn btn-primary" type="button" onclick="ready(1)" disabled>Next</button>
                        <button style="POSITION: relative;LEFT: -272%;" id="back1" class="btn btn-primary" type="button" onclick="back(1)" >back</button>
                    </div>
                </div>
                <p id="found"style="padding-left: 20px; color: red ;display:none;">Email Found!!</p>
                <p style="padding-left: 20px; color: aliceblue">You must select valid email</p>
            </div>
            <div id="stepnow2" style="visibility: hidden;">
                <div class="input-group mb-3">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Your password" onkeyup="input(js_array,this,2)" autocomplete="off">
                    <div class="input-group-append">
                        <button id="mail2" class="btn btn-primary" type="button" onclick="ready(2)" disabled>Next</button>
                        <button style="POSITION: relative;LEFT: -272%;" id="back2" class="btn btn-primary" type="button" onclick="back(2)" >back</button>
                    </div>
                </div>
                <p style="padding-left: 20px; color: aliceblue">Your password must contain an uppercase/lowercase letter and numbers </p>
            </div>
            <div id="stepnow3" style="visibility: hidden;">
                <div class="input-group mb-3">
                    <input type="password" id="password-confirm" class="form-control" placeholder="Confirm Your password" onkeyup="input(js_array,this,3)" autocomplete="off">
                    <div class="input-group-append">
                        <button id="mail3" class="btn btn-primary" type="button" onclick="ready(3)" disabled>Next</button>
                        <button style="POSITION: relative;LEFT: -272%;" id="back3" class="btn btn-primary" type="button" onclick="back(3)" >back</button>
                    </div>
                </div>
                <p style="padding-left: 20px; color: aliceblue">Repeat your password </p>
            </div>
            <div class="inputfile" id="stepnow4" style="">
                <div class="custom-file input-group">
                    <input type="file" class="custom-file-input" id="customFile" name="photo" oninput="inputimg(this)">
                    <label id="inputlabel" class="custom-file-label" for="customFile">Choose file</label>
                    <button id="mail4" class="btn btn-primary" type="button" onclick="ready(4,this)" disabled style=" margin-left: 35%; margin-top: 10px;">Next</button>
                    <button style="POSITION: relative;LEFT: -40%;top: 15%;" id="back4" class="btn btn-primary" type="button" onclick="back(4)">back</button>
                    <button style="POSITION: relative;LEFT: -19%;top: 15%;" id="skip" class="btn btn-primary" type="button" onclick="ready(4,this)">skip</button>
                </div>
                <p style="margin-top: 30px; color:aliceblue"> Select a valid image</p>
            </div>

            <div class="step-progress">
                    <div id="step0" class="step">
                        <p id="par0">1</p>
                    </div>
                <div id="step1" class="step">
                    <p id="par1">2</p>
                </div>
                <div id="step2" class="step">
                    <p id="par2">3</p>
                </div>
                <div id="step3" class="step">
                    <p id="par3">4</p>
                </div>
                <div id="step4" class="step last">
                    <p id="par4">5</p>
                </div>
                <a href="{{ route('login') }}"> Have an account already</a>
            </div>
        </div>
    </form>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script> var js_array =<?php echo json_encode($users);?>; </script>
    <script src="{{ asset('js/kimo.js') }}"></script>
</body>

</html>