<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Page;
use App\Post;
use App\Group;
use App\Notification;
use App\User;
use App\User_page;

class GroupController extends Controller
{
    
    public function makegroup(Request $request)
    {
        $number = Group::max('id');
        if ($number == null) {
            $number = 0;
        } else {
            $number = $number;
        }
        {
            $target_dir = "upload\\\\groups\\\\";
            if (!is_dir($target_dir .($number+1)."/")) {
                //Directory does not exist, so lets create it.
                mkdir($target_dir .($number+1)."/", 0755, true);
            }
            $file = $request->file('image');
            $target_file = $target_dir .($number+1);
            $file->move($target_file, $file->getClientOriginalName());
            Group::create([
                'id' => $number+1,
                'admin' => $request->session()->get('CurrentUser')->id,
                'image' => $target_file."\\\\".$file->getClientOriginalName(),
                'name' => $_POST['name'],
                'about' => $_POST['about'],
                'keys' => $_POST['keys']
            ]);
        }
        $newid=$number+1;
        $page = Group::Where('id', '=', $newid)->get()->last();
        $user = $request->session()->get('CurrentUser')->id;
        $page->users()->attach($user);
        session()->put('CurrentGroup', $page);
        $arr = ['group'=>$page,'postnum'=>0];
        header("refresh"); 
    }
    static function getgroups(User $user){
        $groups=Group::where('id', '!=', 0)->orderByRaw("RAND()")->get();
            // if(! $group->users()->contains(Session::get('CurrentUser')->id))
            return $groups;
        return null;
    }
    public function post(Request $request)
    {
        $text = null;
        $image = "";
        if ($_POST['text']!=null) {
            $text = $_POST['text'];
        }
        if ($request->file('image') !=null) {
            $target_dir = "upload\\\\pages\\\\";
            $file = $request->file('image');
            $target_file = $target_dir .$request->session()->get('CurrentGroup')->id.'\\\\posts';
            $file->move($target_file, $file->getClientOriginalName());
            $image = $target_file."\\\\".$file->getClientOriginalName();
        }
        Post::create([
           'user' => $request->session()->get('CurrentUser')->id,
           'text' => $text,
           'image' => $image,
           'group_id' => $request->session()->get('CurrentGroup')->id,
           'group' => true,
           'read' => false,
       ]);
    }
    public static function posts($id)
    {
        $posts = \App\Post::Where('group_id', '=', $id)->get()->reverse();
        return $posts;
    }
    public function img(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $pages = Group::where('hidden', '=', false)->get();
        $following = $request->session()->get('CurrentUser')->groups;
        $arr=['request'=>$request,'followings'=>$following,'groups'=>$pages];
        return view("groups", $arr);
    }
    public function follow(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $user = User::find($request->session()->get('CurrentUser')->id);
        $page = Group::find($_POST['id']);
        $user->groupswait()->attach($page);
        Notification::create([
            'user' => $page->admin,
            'post_id' => $page->id,
            'from_id' => $request->session()->get('CurrentUser')->id,
            'text'   => $page->name,
            'type' => 7,
            'read' => false
        ]);
    }
    public function unfollow(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $user = User::find($request->session()->get('CurrentUser')->id);
        $page = Group::find($_POST['id']);
        $user->groups()->detach($page);
    }
    public function add(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $user = User::find($_POST['id']);	
        $group = Group::find($_POST['group']);
        $group->waits()->detach($user);
        $group->users()->attach($user);
        $notification = Notification::find($_POST['notification']);
        $notification->read = true;
        $notification->save();
    }
    public function refuse(Request $request){
        if($request->session()->get('CurrentUser')==null){
            return redirect()->action('UserController@login');
            }
        $user = User::find($_POST['id']);	
        $group = Group::find($_POST['group']);
        $group->waits()->detach($user);
        $user->groupswait()->detach($group);
        $notification = Notification::find($_POST['notification']);
        $notification->read = true;
        $notification->save();
    }
}
