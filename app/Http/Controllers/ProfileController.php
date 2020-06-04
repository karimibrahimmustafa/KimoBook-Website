<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\User;
use App\Page;
use App\Post;
use App\Like;
use App\Group;
use App\Notification;
use App\Comment;
use Carbon;
use DB;
class ProfileController extends Controller
{   
    public function CoverUpdate(Request $request, $id)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
           $this->refresh($request);
        if ($id==1) {
            $target_dir = "upload\\";
            $file = $request->file('image');
            $user = session()->get('CurrentUser');
            $target_file = $target_dir .$user->email;
            $file->move($target_file, $file->getClientOriginalName());
            $user->cover = "upload\\\\".$user->email."\\\\".$file->getClientOriginalName();
            $user->save();
            return $this->welcome($request, 0);
        }
        if ($id==2) {
            $target_dir = "upload\\pages\\";
            $file = $request->file('image');
            $user = session()->get('CurrentPage');
            $target_file = $target_dir .$user->id;
            $file->move($target_file, $file->getClientOriginalName());
            $user->cover = "upload\\\\pages\\\\".$user->id."\\\\".$file->getClientOriginalName();
            $user->save();
            $arr=$this->refreshPage($request);
            return view('page', $arr);
        }
        if ($id==3) {
            $target_dir = "upload\\groups\\";
            $file = $request->file('image');
            $user = session()->get('CurrentGroup');
            $target_file = $target_dir .$user->id;
            $file->move($target_file, $file->getClientOriginalName());
            $user->cover = "upload\\\\groups\\\\".$user->id."\\\\".$file->getClientOriginalName();
            $user->save();
            $arr=$this->refreshPage($request);
            return view('group', $arr);
        }
    }
    public function ImageUpdate(Request $request, $id)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        if ($id==1) {
            $target_dir = "upload\\";
            $file = $request->file('image');
            $user = session()->get('CurrentUser');
            $target_file = $target_dir .$user->email;
            $file->move($target_file, $file->getClientOriginalName());
            $user->image = "upload\\\\".$user->email."\\\\".$file->getClientOriginalName();
            $user->save();
            $arr=$this->refresh($request);
            return $this->welcome($request, 0);
        }
        if ($id==2) {
            $target_dir = "upload\\pages\\";
            $file = $request->file('image');
            $user = session()->get('CurrentPage');
            $target_file = $target_dir .$user->id;
            $file->move($target_file, $file->getClientOriginalName());
            $user->image = "upload\\\\pages\\\\".$user->id."\\\\".$file->getClientOriginalName();
            $user->save();
            $arr=$this->refreshPage($request);
        }
        if ($id==3) {
            $target_dir = "upload\\groups\\";
            $file = $request->file('image');
            $user = session()->get('CurrentGroup');
            $target_file = $target_dir .$user->id;
            $file->move($target_file, $file->getClientOriginalName());
            $user->image = "upload\\\\groups\\\\".$user->id."\\\\".$file->getClientOriginalName();
            $user->save();
            $arr=$this->refreshPage($request);
        }
    }
    public function UpdateInfo(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $user = session()->get('CurrentUser');
        if (isset($_POST['name'])) {
            $user->name = $_POST['name'];
        }
        if (isset($_POST['pass'])&& $_POST['pass']!='') {
            $user->password = bcrypt($_POST['pass']);
        }
        $user->save();
        $arr=$this->refresh($request);
        return $this->welcome($request, 0);
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
    public function refresh(Request $request)
    {
        $user = User::where('email', $request->session()->get('CurrentUser')->email)->get()[0];
        $user = session()->put('CurrentUser', $user);
        $users = User::where('remember_token','=',null)->get();
        $request->session()->put('Users',$users);
        $waits = $this->Wait($request);
        $arr = ['CurrentUser'=>$user,'users'=>$users,'wait'=>$waits];
        return $arr;
    }
    public function refreshPage(Request $request)
    {
        $page = Page::find($request->session()->get('CurrentPage')->id)->get()->first();
        $page = session()->put('CurrentPage', $page);
        $arr = ['page'=>$page,'postnum'=>0];
        return $arr;
    }
    public function page(Request $request, $id)
    {
        $page = Page::where('id', '=', $id)->get()->first();
        session()->put('CurrentPage', $page);
        $arr = ['page'=>$page,'postnum'=>0];
        $this->refresh($request);
        return view('page', $arr);
    }
    public function pagepost(Request $request, $id,$post)
    {
        $page = Page::where('id', '=', $id)->get()->first();
        session()->put('CurrentPage', $page);
        $arr = ['page'=>$page,'postnum'=>$post];
        $this->refresh($request);
        return view('page', $arr);
    }
    public function group(Request $request, $id)
    {  
        $page = Group::where('id', '=', $id)->get()->first();
        session()->put('CurrentGroup', $page);
        $arr = ['group'=>$page,'postnum'=>0];
        $this->refresh($request);
        return view('group', $arr);
    }
    public function grouppost(Request $request, $id,$post)
    {
        $page = Group::where('id', '=', $id)->get()->first();
        session()->put('CurrentGroup', $page);
        $arr = ['group'=>$page,'postnum'=>$post];
        $this->refresh($request);
        return view('group', $arr);
    }
    public function welcomeUpdate(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        if ($_POST['type']=='cover') {
            $this->CoverUpdate($request, 1);
            $arr=$this->refresh($request);
            return $this->welcome();
        }
        if ($_POST['type']=='image') {
            $this->ImageUpdate($request, 1);
            $arr=$this->refresh($request);
            return $this->welcome($request, 0);
        }
        if ($_POST['type']=='info') {
            $this->InfoUpdate($request, 1);
            $arr=$this->refresh($request);
            return $this->welcome($request, 0);
        }
        if ($_POST['type']=='coverPage') {
            return $this->CoverUpdate($request, 2);
        }
        if ($_POST['type']=='pageimage') {
            return $this->ImageUpdate($request, 2);
        }
        if ($_POST['type']=='coverGroup') {
            return $this->CoverUpdate($request, 3);
        }
        if ($_POST['type']=='groupimage') {
            return $this->ImageUpdate($request, 3);
        }
    }
    public function welcome(Request $request, $num)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $arr=$this->refresh($request);
        $arr['postnum']=$num;
        return view("newGUIprofile", $arr);
    }
    public function welcomeframe(Request $request, $num)
    {
        return view("refresh");
    }
    public function timeline(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $arr=$this->refresh($request);
        $arr['postnum']=0;
        return view("newGUI", $arr);
    }
    public function frame(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $arr=$this->refresh($request);
        return view("newGUI", $arr);
    }
    public function saveDetails(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
        }
        $user = session()->get('CurrentUser');
        if ($_POST['about']!=null) {
            $user->details->about = $_POST['about'];
        }
        if ($_POST['address']!=null) {
            $user->details->address = $_POST['address'];
        }
        if ($_POST['work']!=null) {
            $user->details->work = $_POST['work'];
        }
        if ($_POST['study']!=null) {
            $user->details->study = $_POST['study'];
        }
        if ($_POST['phone']!=null) {
            $user->details->phone = $_POST['phone'];
        }
        $user->details->state = $_POST['state'];
        if ($_POST['hobbies']!=null) {
            $user->details->hobbies = $_POST['hobbies'];
        }
        if (isset($_POST['mail'])) {
            $user->details->mail = true;
        } else {
            $user->details->mail = false;
        }
        $user->details->date = $_POST['date'];
        $user->details->save();
        return $this->welcomeframe($request, 0);
    }
    public function post(Request $request)
    {  
        if (!isset($_POST['page'])||$_POST['page']==0) {
                $text = "";
                $image = "";
                if ($_POST['text']!=null) {
                    $text = $_POST['text'];
                }
                if ($request->file('image') !=null) {
                    $target_dir = "upload\\\\";
                    $file = $request->file('image');
                    $target_file = $target_dir .$request->session()->get('CurrentUser')->email.'\\\\posts';
                    $file->move($target_file, $file->getClientOriginalName());
                    $image = $target_file."\\\\".$file->getClientOriginalName();
                }
                Post::create([
            'user' => $request->session()->get('CurrentUser')->id,
            'text' => $text,
            'image' => $image,
            'page_id' => 0,
            'read' => false,
            'page' =>false,
        ]);
        }
    else{
        $text = null;
        $image = "";
        if ($_POST['text']!=null) {
            $text = $_POST['text'];
        }
        if ($request->file('image') !=null) {
            $target_dir = "upload\\\\pages\\\\";
            $file = $request->file('image');
            $target_file = $target_dir .$request->session()->get('CurrentPage')->id.'\\\\posts';
            $file->move($target_file, $file->getClientOriginalName());
            $image = $target_file."\\\\".$file->getClientOriginalName();
        }
        Post::create([
            'user' => $request->session()->get('CurrentUser')->id,
            'text' => $text,
            'image' => $image,
            'page_id' => $request->session()->get('CurrentPage')->id,
            'page' =>true,
            'read' => false,
        ]);  
    }
}
    public function share(Request $request){
        Post::create([
            'user' => $request->session()->get('CurrentUser')->id,
            'text' => '',
            'image' => '',
            'page_id' => 0,
            'page' =>false,
            'read' => false,
            'shared' => $_POST['post']
        ]);  
    }
    public function like(Request $request){
        $post = Like::where('post_id', '=', $_POST['post'])->where('user', '=', $_POST['from_id'])->first();
        if ($post == null) {
            Like::create([
                'user' => $request->session()->get('CurrentUser')->id,
                'post_id' => $_POST['post'],
                'type' => $_POST['type'],
            ]);
        }
        else {
            $post->type = $_POST['type'];
            $post->save();
        }
        if ($_POST['user_id']!=$_POST['from_id']) {
            $notification = Notification::where('post_id', '=', $_POST['post'])
            ->where('from_id', '=', $_POST['from_id'])->where('user', '=', $_POST['user_id'])->first();
        
            if ($notification === null) {
                Notification::create([
                'user' => $request->session()->get('CurrentUser')->id,
                'post_id' => $_POST['post'],
                'from_id' => $_POST['from_id'],
                'user' => $_POST['user_id'],
                'type' => $_POST['type'],
                'read' => false
            ]);
            }
        }
   }
   public function comment(Request $request){
           Comment::create([
            'user' => $request->session()->get('CurrentUser')->id,
            'post_id' => $_POST['post'],
            'text' => $_POST['text'],
        ]);
    if ($request->session()->get('CurrentUser')->id != $_POST['user']) {
            Notification::create([
            'user' => $_POST['user'],
            'post_id' => $_POST['post'],
            'from_id' => $request->session()->get('CurrentUser')->id,
            'type' => 6,
            'read' => false
        ]);
    }
}
    static public function getposts($id){
        $posts = \App\Post::Where('user','=',$id)->where('page', '=', false) ->get()->reverse(); 
        return $posts;
    }
    function profile(Request $request,$id,$post){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
            $user=User::find($id);
            $current = $request->session()->get('CurrentUser');
            $arr=['user'=>$user,'current'=>$current];
            $arr['postnum']=$post;
            $this->refresh($request);
            return view('newprofile',$arr);
    }
    static public function timelineposts($id){
        $posts = \App\Post::orderBy('created_at', 'desc')->get();
        $newposts = \App\Post::where('id','=','0')->get()->reverse(); 
        $user = User::find($id);
        foreach( $posts as $post){
        if($post->user == $id ||
        ($user->friends->contains($post->user) && $post->page == 0 && $post->group == 0))
        {
        $newposts->push($post);

        }
        else if ($user->groups->contains($post->group)){
            $newposts->push($post);
        }
        else if ($user->follows->contains($post->page)){
            $newposts->push($post);
        }
    }
        return $newposts;
    }
    static public function dating($str){  
// Declare and define two dates
            $date1 = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $str);
            $date2 = Carbon\Carbon::now();
// Formulate the Difference between two dates 
            $years = $date1->diffInYears($date2);  
            $months = $date1->diffInMonths($date2);  
            $days = $date1->diffInDays($date2); 
            $hours = $date1->diffInHours($date2);
            $minutes = $date1->diffInMinutes($date2);
            $seconds = $date1->diffInSeconds($date2);
            if($years>0){
                return $years." years left";
            }
            if($months>0){
                return $months." months left";
            }
            if($days>0){
                return $days." days left";
            }
            if($hours>0){
                return $hours." hours left";
            }
            if($minutes>0){
                return $minutes." minutes left";
            }
            if($seconds>0){
                return $seconds." seconds left";
            }
    }
    public function deletePost(){
        $post = Post::find($_POST['post']);
        $myFile = $post->image;
        if($post->image!=null)
        unlink($myFile) or die("Couldn't delete file");
        $post->delete();
        Like::where('post_id','=',$post->id)->delete(); 
        Comment::where('post_id','=',$post->id)->delete(); 
        Notification::where('post_id','=',$post->id)->delete(); 
    }

}