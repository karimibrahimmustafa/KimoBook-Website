<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
class FrameController extends Controller
{
    public function friends(Request $request)
    {if($request->session()->get('CurrentUser')==null){
        return redirect()->action('UserController@login');
        }
        return view('friends');
    }
    public function message(Request $request)
    {if($request->session()->get('CurrentUser')==null){
        return redirect()->action('UserController@login');
        }
        return view('message');
    }
    public function RemoveNotification(){
        $notification = Notification::where('id', '=', $_POST['id'])->first();
        $notification->read = true;
        $notification->save(); 
    }
}
