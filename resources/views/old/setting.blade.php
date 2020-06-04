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
  <div class="sidebar">
    <a class="active" id='home' onclick='open_details(this)' href="#news">Home</a>
    <a href="#news" id='new_page' onclick='open_page(this)'>New Page</a>
    <a href="#contact" id='new_group' onclick='open_group(this)'>New Group</a>
    <a href="#about" id='new_product' onclick='open_product(this)'>New Product</a>
  </div>
  <!-- Page content -->
  <div class="content" id='details_container'>
    <form action="saveDetails" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="inputAddress">about</label>
        <input type="text" class="form-control" id="inputAddress" name='about'
          value="{{Session::get('CurrentUser')->details->about}}">
      </div>
      <div class="form-group">
        <label for="inputAddress">Address</label>
        <input type="text" class="form-control" id="inputAddress" name='address'
          value="{{Session::get('CurrentUser')->details->address}}">
      </div>
      <div class="form-group">
        <label for="inputAddress2">Study</label>
        <input type="text" class="form-control" id="inputAddress2" name='study'
          value="{{Session::get('CurrentUser')->details->study}}">
      </div>
      <div class="form-group">
        <label for="inputAddress">Work</label>
        <input type="text" class="form-control" id="inputAddress" name='work'
          value="{{Session::get('CurrentUser')->details->work}}">
      </div>
      <div class="form-group">
        <label for="inputAddress">Hobbies</label>
        <input type="text" class="form-control" id="inputAddress" name='hobbies'
          value="{{Session::get('CurrentUser')->details->hobbies}}">
      </div>
      <div class="form-group">
        <label for="inputAddress">Phone Number</label>
        <input type="text" class="form-control" id="inputAddress" name='phone'
          value="{{Session::get('CurrentUser')->details->phone}}">
      </div>
      <div class='form-group'>
        <label for="inputSelect" style="padding-right: 3vw;">Marital status</label>
        <select id="inputSelect" style="width: 59vw;" name='state'
          value="{{Session::get('CurrentUser')->details->state}}">
          <option value="0">Single</option>
          <option value="1">Engaged</option>
          <option value="2">Married</option>
          <option value="3">Divorced</option>
        </select>
      </div>
      <div class="form-row">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <div class="md-form">
            <!--The "from" Date Picker -->
            <label for="startingDate">Date of birth</label>
            <input placeholder="Selected starting date" type="text" id="startingDate" name='date'
              class="form-control datepicker" value="{{Session::get('CurrentUser')->details->date}}">
          </div>

        </div>
      </div>
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input is-invalid" type="checkbox" name='mail' id="invalidCheck3"
            @if(Session::get('CurrentUser')->details->mail)
          checked
          @endif
          >
          <label style='color:gray;' class="form-check-label" for="invalidCheck3">
            Show your e-mail for your friends
          </label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
  <div class="content" id="create_group_container">
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
  <div class="content" id="create_page_container">
    <form action="makepage" enctype="multipart/form-data" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="inputAddress">Page Name</label>
        <input type="text" class="form-control" id="inputAddress" name='name' required>
      </div>
      <div class="form-group">
        <label for="inputAddress">Page About</label>
        <input type="text" class="form-control" id="inputAddress" name='about' required>
      </div>
      <div class="form-group">
        <label for="inputAddress">Page keys</label>
        <input type="text" class="form-control" id="inputAddress" name='keys' required>
      </div>
      <div class="row">
        <label for="inputAddress">Image</label>
        <div class="file-field input-field">
          <div class="btn">
            <span>Browse</span>
            <input type="file" id='inputImage' name='image' oninput="inputimg(this)" required />
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" id='validate' type="text" placeholder="Upload file" />
          </div>
        </div>
      </div>
      <button type="submit" id='submit' class="btn btn-primary" disabled>Save</button>
    </form>
  </div>
  <div class="content" id="create_product_container">
    <form enctype="multipart/form-data" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="inputAddress4">Product Name</label>
        <input type="text" class="form-control" id="Productname" name='name' required>
      </div>
      <div class="form-group">
        <label for="inputAddress4">Information</label>
        <input type="text" class="form-control" id="Productabout" name='about' required>
      </div>
      <div class="form-group">
        <label for="inputAddress4">Product keys</label>
        <input type="text" class="form-control" id="Productkeys" name='keys' required>
      </div>
      <div class="form-group">
        <label for="inputAddress4">Product Discriptions</label>
        <textarea type="text" class="materialize-textarea" id="Productdiscription" value="" name='keys' required>
            </textarea>
      </div>
      <div class="form-group">
        <label for="inputAddress4">Contacts</label>
        <input type="text" class="form-control" id="Productcontacts" value="" name='keys' required>
              </textarea>
      </div>
      <label for="inputAddress">Determine your price range</label>
      <div class='range' data-role="rangeslider">
        <iframe id='Productframe' src='range.html' height='127' width='100%' frameBorder="0">
        </iframe>
      </div>
      <div class="row">
        <label for="inputAddress">Product Image</label>
        <div class="file-field input-field" id='range'>
          <div class="btn">
            <span>Browse</span>
            <input type="file" id='ProductImage' name='image' oninput="inputimg3(this)" required />
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" id='validate4' type="text" placeholder="Upload file" />
          </div>
        </div>
      </div>
      <button onclick="newproduct('{{csrf_token() }}')" id='submit4' class="btn btn-primary" disabled>Save</button>
    </form>
  </div>
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset('js/profile/setting.js') }}"></script>

</html