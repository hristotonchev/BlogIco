<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Comments;

class LoginController extends Controller
{


    public function login(Request $request)
    {

        return view('admin.login');
    }

    public function loginCheck(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:25',
            'password' => 'required|max:25',
        ]);
        if (\Auth::guard()->attempt($request->except(['_token']))) {
            $value = $request->session()->flash('login_success', 'Welcome to the Admin');
            //Add this to admin.blogposts.blade.tpl
            //<a>{{session()->get('key')}}</a>
            return redirect()->action('AdminController@displayAllBlogPostsInAdmin');
        } else {
            $value = $request->session()->flash('login_fail', 'Your username or password are wrong');
            return redirect()->action('LoginController@login');
        }
        /**
         * ASK PARIS WHY login function doesnt work
        $data = [
            'username' => $request->all('username'),
            'passwprd' => $request->all('password'),
        ];
        \Auth::login($data);
        */
    }
}
