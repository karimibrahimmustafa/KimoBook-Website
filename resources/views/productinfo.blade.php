<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">
<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css"
    media="all">
<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
<link rel="stylesheet" href="../css/product.css" media="all">
<div class="container-fluid">
    <div class="content-wrapper">
        <div class="item-container">
            <div class="container">
                <div class="col-md-12">
                    <div class="product col-md-3 service-image-left">
                        <center>
                            <img id="item-display" hieght="321" src="{{$product->image}}" alt="">
                        </center>
                    </div>
                </div>

                <div class="col-md-7">
                <a href="storeinfo">Back</a>
                <div class="product-title">{{$product->name}}</div>
                    <div class="product-desc">{{$product->about}}</div>
                    <hr>
                    <div class="product-price">{{$product->to}}$</div>
                    @if($product->type==0)
                    <div class="product-stock">Availabla</div>
                    @elseif($product->type==1)
                    <div class="product-stock">Availabla <div><p style="color:yellow">with offers</p>
                    @elseif($product->type==3)
                    <div class="product-stock" style="color:red">Not Availabla</div>
                    @endif
                    <hr>
                    @if($product->state(Session::get('CurrentUser')->id)=='none' && $product->type<3)
                    <div class="form-group">
                        <label for="inputAddress4">Your offer</label>
                        <input type="text" class="form-control" id="offer" onkeyup="offerInput(this,{{$product->from}})" name='keys' required width="100">
                        <label id='error' style="color:red; display:none">Your offer is very low</label>
                    </div>
                    @elseif($product->state(Session::get('CurrentUser')->id)=='accepted')
                    <div class="form-group">
                        <label id='error' style="color:Green;">Your offer is accepted</label>
                        <br>
                        <label id='error' style="">Contacts: </label>
                        <label id='error' style="color:Green;">{{$product->contacts}}</label>
                    </div>
                    @elseif($product->state(Session::get('CurrentUser')->id)=='refused')
                    <div class="form-group">
                        <label id='error' style="color:Red;">Your offer is Refused</label>
                    </div>
                    @elseif($product->type<3)
                    <div class="form-group">
                    <label for="inputAddress4">Your offer</label>
                        <input type="text" class="form-control" id="offer" onkeyup="offerInput(this,{{$product->from}})" name='keys' required width="100">
                        <label id='error' style="color:red; display:none">Your offer is very low</label>
                    </div>
                    @endif
                    <div class="btn-group cart">
                        @if($product->type < 3)
                        <button type="button" id = 'submit' onclick = 'offer({{$product->admin}},{{$product->id}},"{{csrf_token() }}")' disabled class="btn btn-success">
                            Offer
                        </button>
                        <div class="btn-group wishlist">
                            <button type="button" class="btn btn-danger">
                                Add to wishlist
                            </button>
                        </div>
                        @else
                        <button type="button" id = 'submit' style="display:none">
                                Offer
                            </button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid">
            <div class="col-md-12 product-info">
                <ul id="myTab" class="nav nav-tabs nav_tabs">

                    <li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="service-one">

                        <section class="container product-info">
                            {{$product->discription}}
                        </section>

                    </div>
                    <div class="tab-pane fade" id="service-two">

                        <section class="container">

                        </section>

                    </div>
                    <div class="tab-pane fade" id="service-three">

                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
<script>
function offerInput(e,m){
var text = e.value;
if(isNumeric(text)){
    if(text < m){
    document.getElementById('error').style.display = 'block';
    }
    else{
    document.getElementById('error').style.display = 'none';
    }
document.getElementById('submit').disabled = false;
}
else
document.getElementById('submit').disabled = true;

}
function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
function offer(admin,product,token){
    var text = document.getElementById('offer').value;
    $.ajax({
        method: 'POST',
        url: '/offer',
        type: "POST",
        dataType: 'json',
        data: {
            'id': product,
            'price': text,
            '_token': token
        }
    });
    window.location.href = 'storeinfo';
    alert('your offer is done');
}
</script>