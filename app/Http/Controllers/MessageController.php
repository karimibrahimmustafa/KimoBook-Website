<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\runnig_message;
use DB;
use Illuminate\Support\Facades\Input;
class MessageController extends Controller
{
    public function saveMessage(){
        Message::create([
            'from_id' => $_POST['id'],
            'to_id' => $_POST['friend'],
            'text' => $this->encrypt_decrypt('encrypt',$_POST['message']),
            'read' => false,
            'image' => 0,


        ]);
    }
    public function waiting(){
        runnig_message::create([
            'from_id' => $_POST['id'],
            'to_id' => $_POST['friend'],
            'status' => 1,
        ]);
    }
    static function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
    function message(Request $request,$id2){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
            $id =$request->session()->get('CurrentUser')->id;
            $messages = \App\Message::Where(function($query) use ($id,$id2)
                          {
                              $query->where("from_id",$id)
                                    ->where("to_id",$id2);
                          })
                          ->orWhere(function($query) use ($id, $id2)
                          {
                              $query->Where("to_id",$id)
                                    ->Where("from_id",$id2);
                          })
                          ->get();
            Message::where(array(
               'to_id' => $id,
               'from_id' => $id2))->update(['read'=>true]);
        // $messages = DB::table('messages')->where(array(
        //     'from-id' => $request->session()->get('CurrentUser')->id,
        //     'to-id' => 2))
        // ->orWhere(array(
        //     'to-id' => $request->session()->get('CurrentUser')->id,
        //     'from_id' => 2))->get();
            $arr = ['messages'=>$messages];
            return view('message',$arr);

    }
    static function getmessage($id){
        $messages = \App\Message::Where(function ($query) use ($id) {
            $query->where("from_id", $id);
        })
                          ->orWhere(function ($query) use ($id) {
                              $query->Where("to_id", $id);
                          })
                          ->get()->reverse();
        // $messages = DB::table('messages')->where(array(
        //     'from-id' => $request->session()->get('CurrentUser')->id,
        //     'to-id' => 2))
        // ->orWhere(array(
        //     'to-id' => $request->session()->get('CurrentUser')->id,
        //     'from_id' => 2))->get();
        $arr=[];
        $arr2=[];
        foreach ($messages as $message) {
            if ($message->user->id != $id) {
                if (in_array($message->user->id, $arr)) {
                } else {
                    $name=$message->user->name;
                    array_push($arr, $message->user->id);
                    array_push($arr2, $message);
                }
            }
        }
            return $arr2;

    }
    static function getNum($id){
        $arr=[];
        $arr2=[];
            $messages = \App\Message::Where(function($query) use ($id)
                          {
                              $query->where("to_id",$id)
                                    ->where("read",false);
                          })
                          ->get();
            foreach ($messages as $message) {
                if(in_array($message->user->name,$arr)){
                $message->user->name="";
                }
                else 
                {
                    $name=$message->user->name;
                    array_push($arr,$name);
                }
            }
            return $messages;
    }
}
