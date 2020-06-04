<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" />
  <link rel="stylesheet" href="{{ asset('css/settingStyle.css') }}">
</head>

<body>
  <!-- The sidebar -->
  <!-- Page content -->
  <div class="content" id="create_group_container" style="display:block">
    <form action="makegroup" enctype="multipart/form-data" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="inputAddress">Group Name</label>
        <input type="text" class="form-control" id="inputAddress1" name='name' required>
      </div>
      <div class="form-group">
        <label for="inputAddress">Group Rules</label>
        <input type="text" class="form-control" id="inputAddress1" name='about' required>
      </div>
      <div class="form-group">
        <label for="inputAddress">Group about</label>
        <input type="text" class="form-control" id="inputAddress1" name='keys' required>
      </div>
      <div class="row">
        <label for="inputAddress">Image</label>
        <div class="file-field input-field">
          <div class="btn">
            <span>Browse</span>
            <input type="file" id='inputImage1' name='image' oninput="inputimg2(this)" required />
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" id='validate1' type="text" placeholder="Upload file" />
          </div>
        </div>
      </div>
      <button type="submit" id='submit1' class="btn btn-primary" disabled>Save</button>
    </form>
  </div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset('js/profile/setting.js') }}"></script>

</html