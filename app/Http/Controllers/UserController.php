<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Http\Request;
use App\User;
use App\Detail;
use App\state;
use DB;
class UserController extends Controller
{       
    public function state(Request $request){
           $user = state::find(session()->get('CurrentUser')->id);
           if($user->status !== '0'){
            $request->session()->put('Currentstate',$user->status);
               return $user->status;
           }
           else
           return 'nochange';
    } 
    public function version2(Request $request){

        return view("newGUI");

    } 
    public function loginSuccess(Request $request){
        
        $users = User::all();
        $request->session()->put('Users',$users);
        $request->session()->put('Currentstate',0);
        $arr=['request'=>$request];
        return redirect()->action('ProfileController@frame');
    }
    public function img(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
       $users = User::where('remember_token','=',null)->get();
       if(session()->get('CurrentUser')===null)
       {return redirect()->action('UserController@login');}
       $user = User::find(session()->get('CurrentUser')->id);	
       $waits = $this->Wait($request);
       $request->session()->put('CurrentUser',$user);
        $request->session()->put('Users',$users);
        $current = $request->session()->get('CurrentUser');
        $friends = $current->friends;
        $arr=['request'=>$request,'current'=>$current,'friends'=>$friends,'wait'=>$waits];
        return view("index",$arr);
    }
    public function Wait(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $user = User::find(session()->get('CurrentUser')->id);	
        $waits = DB::table('userwait')->where('user2_id', '=', $user->id)->get();
        $arr =[];
        foreach ($waits as $wait){
          array_push($arr,$wait->user1_id);
        }
        return $arr;
    }
    public function AddFriend(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $user = User::find($_POST['id']);	
        $user2 = User::find($_POST['friend']);
        $user_favorites = DB::table('userWait')
        ->where('user1_id', '=', $user->id)
        ->where('user2_id', '=', $user2->id)
        ->first();
        if(is_null($user_favorites)){
        $user->friendsWait()->attach($user2);
    }
            $state = state::find($_POST['friend']);
            $state->status = "add,".$_POST['id'].",".$_POST['friend'];
            $state->save();
    }
    
    public function AcceptFriend(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $user = User::find($_POST['id']);	
        $user2 = User::find($_POST['friend']);
        $user_favorites = DB::table('userWait')
        ->where('user1_id', '=', $user->id)
        ->where('user2_id', '=', $user2->id)
        ->first();
        if(!is_null($user_favorites)){
        $user->friendsWait()->detach($user2);
        $user->friends()->attach($user2);
        $user2->friends()->attach($user);
    }
    }
    public function refuseFriend(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $user = User::find($_POST['id']);	
        $user2 = User::find($_POST['friend']);
        $user_favorites = DB::table('userWait')
        ->where('user1_id', '=', $user->id)
        ->where('user2_id', '=', $user2->id)
        ->first();
        if(!is_null($user_favorites)){
        $user->friendsWait()->detach($user2);
    }
    }
    public function RemoveFriend(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $user = User::find($_POST['id']);	
        $user2 = User::find($_POST['friend']);
        $user2->friends()->detach($user);
        $user->friends()->detach($user2);

    
    }
    public function register(Request $request)
    {  
         $target_dir = "upload\\\\";
        if(!is_dir($target_dir .$_POST['email']."/")){
            //Directory does not exist, so lets create it.
            mkdir($target_dir .$_POST['email']."/", 0755, true);
        }
        $file = $request->file('photo');
        if ($file != null) {
            $target_file = $target_dir .$_POST['email'];
            $file->move($target_file, $file->getClientOriginalName());
            User::create([
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => bcrypt($_POST['password']),
        'image' => $target_file."\\\\".$file->getClientOriginalName(),
    ]);
        }
        else {
            User::create([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => bcrypt($_POST['password']),
                'image' => "images\\\\friend.png",
            ]);
        }
    $user = User::where ('email',$_POST['email'])->get()[0];
    Detail::create([
        'id'=> $user->id
    ]);
    state::create([
        'id' => $user->id,
        'status' => 0
    ]);
    $arr=['request'=>$request];
    return redirect()->action('UserController@login');
}
    public function show(Request $request){

       $names = User::all();
       $emails=[];
       foreach ($names as $name ) {
           array_push($emails,$name->email);
       }
        $arr=['users'=>$emails];
         return view('auth/register2',$arr);


    }
    
    public function setting(Request $request){
        $this->refresh($request);
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
          return view('newGUIsetting');
     }
     public function about(Request $request){
        $this->refresh($request);
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $arr=['type'=>"aboutform"];
          return view('newGUIsetting',$arr);
     }
     public function page(Request $request){
        $this->refresh($request);
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $arr=['type'=>"pageform"];
          return view('newGUIsetting',$arr);
     }
     public function group(Request $request){
        $this->refresh($request);
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $arr=['type'=>"groupform"];
          return view('newGUIsetting',$arr);
     }
     public function product(Request $request){
        $this->refresh($request);
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $arr=['type'=>"productform"];
          return view('newGUIsetting',$arr);
     }
     public function aboutform(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
          return view('about');
     }
     public function productform(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
          return view('createproduct');
     }
     public function pageform(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
          return view('createpage');
     }
     public function groupform(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
          return view('creategroup');
     }
    public function loginServer(Request $request){
        $user = User::where ('email',$_POST['mail'])->get();
        $request->session()->put('mail',$_POST['mail']);
        if (Hash::check($_POST['pass'],$user[0]->password)) {
            $user = User::where ('email',$request->session()->get('mail'))->get()[0];
            $request->session()->put('CurrentUser',$user);
            return 1;
        }
        return 0;
    }
    public function loginshow(){
       $names = User::all();
       $emails=[];
       $pass=[];
       foreach ($names as $name ) {
           array_push($emails,$name->email);
           array_push($pass,$name->password);

       }
        $arr=['users'=>$emails ,'pass'=>$pass];
         return view('auth/login2',$arr);
     }
     public function login(){
       $names = User::all();
       $emails=[];
       $pass=[];
       foreach ($names as $name ) {
           array_push($emails,$name->email);
           array_push($pass,$name->password);

       }
        $arr=['users'=>$emails ,'pass'=>$pass];
         return view('auth/login2',$arr);
 
     }
     public function logout(Request $request){
        $request->session()->put('CurrentUser',null);
        return redirect()->action('UserController@login');
  
      }
      public function refresh(Request $request)
      {
          $user = User::where('email', $request->session()->get('CurrentUser')->email)->get()[0];
          $user = session()->put('CurrentUser', $user);
      }
}
