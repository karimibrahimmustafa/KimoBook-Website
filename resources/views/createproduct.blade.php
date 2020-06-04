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
  <div class="content" id="create_product_container" style="display:block">
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