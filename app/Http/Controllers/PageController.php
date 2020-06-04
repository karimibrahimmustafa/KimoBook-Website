<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Page;
use App\Post;
use App\User;
use App\User_page;
class PageController extends Controller
{
    //
    public function makepage(Request $request)
    {
        $number = Page::max('id');
        if ($number == null) {
            $number = 0;
        } else {
            $number = $number;
        }
        {
            $target_dir = "upload\\\\pages\\\\";
            if (!is_dir($target_dir .($number+1)."/")) {
                //Directory does not exist, so lets create it.
                mkdir($target_dir .($number+1)."/", 0755, true);
            }
            $file = $request->file('image');
            $target_file = $target_dir .($number+1);
            $file->move($target_file, $file->getClientOriginalName());
            Page::create([
                'id' => $number+1,
                'admin' => $request->session()->get('CurrentUser')->id,
                'image' => $target_file."\\\\".$file->getClientOriginalName(),
                'name' => $_POST['name'],
                'about' => $_POST['about'],
                'keys' => $_POST['keys']
            ]);
        }
        $page = Page::find($number+1)->get()->first();
        session()->put('CurrentPage', $page);
        $arr = ['page'=>$page,'postnum'=>0];
        header("refresh"); 
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
            $target_file = $target_dir .$request->session()->get('CurrentPage')->id.'\\\\posts';
            $file->move($target_file, $file->getClientOriginalName());
            $image = $target_file."\\\\".$file->getClientOriginalName();
        }
        Post::create([
           'user' => $request->session()->get('CurrentUser')->id,
           'text' => $text,
           'image' => $image,
           'page_id' => $request->session()->get('CurrentPage')->id,
           'page' => true,
           'read' => false,
       ]);
    }
    static function getpages(User $user){
        $array = [];
        $arr = [];
        $pages=Page::orderByRaw("RAND()")->get();
        foreach($pages as $page){
            if(! $user->follows->contains($page->id))
            return $page;
        }
        return null;
    }
    public static function posts($id)
    {
        $posts = \App\Post::Where('page_id', '=', $id)->get()->reverse();
        return $posts;
    }
    public function img(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $pages = Page::all();
        $following = $request->session()->get('CurrentUser')->follows;
        $arr=['request'=>$request,'followings'=>$following,'pages'=>$pages];
        return view("pages", $arr);
    }
    public function follow(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $user = User::find($request->session()->get('CurrentUser')->id);
        $page = Page::find($_POST['id']);
        $user->follows()->attach($page);
    }
    public function unfollow(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        $user = User::find($request->session()->get('CurrentUser')->id);
        $page = Page::find($_POST['id']);
        $user->follows()->detach($page);
    }
    public function admin(Request $request)
    {
        if ($request->session()->get('CurrentUser')==null) {
            return redirect()->action('UserController@login');
        }
        if ($_POST['type'] == 'add') {
            $user = User::find($_POST['id']);
            $page = Page::find($request->session()->get('CurrentPage')->id);
            $page->admins()->attach($user);
        }
        elseif($_POST['type'] == 'remove'){
            $user = User::find($_POST['id']);
            $page = Page::find($request->session()->get('CurrentPage')->id);
            $page->admins()->detach($user);
        }
    }
}
