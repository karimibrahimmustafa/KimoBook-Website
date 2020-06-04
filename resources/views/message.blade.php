<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
    <link rel="stylesheet" href="../css/loading.css">
    <link rel="stylesheet" href="../css/loader-1.css">
    <script type="text/javascript" src="{{ asset('js/message.js') }}"></script>
  </head>
  <body onload="pageScroll()">

            <section class="discussion">
                @foreach ($messages as $message)
                  @if($message->to_id == Session::get('CurrentUser')->id)
                    <div class="bubble sender first">{{App\Http\Controllers\MessageController::encrypt_decrypt('decrypt',$message->text)}}</div>
                  @else
                    <div class="bubble recipient first">{{App\Http\Controllers\MessageController::encrypt_decrypt('decrypt',$message->text)}}</div>
                  @endif
                @endforeach
                {{-- <div class="waiting" id = "waiting">
                <img  src="../images/tenor.gif" style="display: block">
                <div> --}}
            </section>
</body>
<script type="text/javascript" src="{{ asset('js/profile/welcome.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/swiper/app.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
 $(document).ready(function() {
        setTimeout(function(){ }, 10000);
    });
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html