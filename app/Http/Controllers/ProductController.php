<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Offer;
use App\Http\Controllers\ProfileController;
class ProductController extends Controller
{
    public function newProduct(Request $request)
    {
        $number = Product::max('id');
        if ($number == null) {
            $number = 0;
        } else {
            $number = $number;
        }
        {
            $target_dir = "upload\\\\products\\\\";
            if (!is_dir($target_dir .($number+1)."/")) {
                //Directory does not exist, so lets create it.
                mkdir($target_dir .($number+1)."/", 0755, true);
            }
            $file = $request->file('image');
            $target_file = $target_dir .($number+1);
            $file->move($target_file, $file->getClientOriginalName());
            Product::create([
                'id' => $number+1,
                'admin' => $request->session()->get('CurrentUser')->id,
                'image' => $target_file."\\\\".$file->getClientOriginalName(),
                'name' => $_POST['name'],
                'about' => $_POST['about'],
                'discription' => $_POST['discription'],
                'contacts' => $_POST['contacts'],
                'keys' => $_POST['keys'],
                'to' => $_POST['value2'],
                'from' => $_POST['value1'],
                'type' => 0,
            ]);
        }
        return $number+1;
    }
    public function offer(Request $request)
    {
            Offer::create([
                'user_id' => $request->session()->get('CurrentUser')->id,
                'product_id' => $_POST['id'],
                'price' => $_POST['price'],
                'text' => "",
                'type' => "0",
            ]);
            Product::find($_POST['id'])->update(['type'=>1]);
    }
    public function product(Request $request, $id)
    {
        $arr = ['product'=>$id,'postnum'=>0];
        $this->refresh($request);
        return view('product', $arr);
    }
    public function productinfo(Request $request, $id)
    {
        $page = Product::where('id', '=', $id)->get()->first();
        Offer::where('product_id','=',$id)->where('type','=',1)->where('user_id','=',$request->session()->get('CurrentUser')->id)
        ->update(['type'=>4]);
        session()->put('CurrentProduct', $page);
        $arr = ['product'=>$page,'postnum'=>0];
        $this->refresh($request);
        return view('productinfo', $arr);
    }
    public function accept(Request $request){
        $offer = Offer::find($_POST['offer']);
        Offer::where('product_id','=',$offer->product_id)->where('id','<>',$_POST['offer'])->update(['type'=>2]);
        Offer::where('id','=',$_POST['offer'])->update(['type'=>1]);
        Product::find($offer->product_id)->update(['type'=>3]);
    }
    public function refuse(Request $request){
        $offer = Offer::find($_POST['offer']);
        $offer->type = 3;
        $offer->save();
    }
    public function store(Request $request){
        $this->refresh($request);
        return view('store');
    }
    public function storeinfo(Request $request){
        $product2 = Product::all()->take(5);
        $product = Product::all();
        $arr = ['products'=>$product,'maxproducts'=>$product2];
        $this->refresh($request);
        return view('storeinfo',$arr);
    }
    public function refresh(Request $request)
    {
        $user = User::where('email', $request->session()->get('CurrentUser')->email)->get()[0];
        $user = session()->put('CurrentUser', $user);
        $users = User::where('remember_token','=',null)->get();
    }
}
