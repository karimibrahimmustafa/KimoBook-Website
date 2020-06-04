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
</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset('js/profile/setting.js') }}"></script>

</html