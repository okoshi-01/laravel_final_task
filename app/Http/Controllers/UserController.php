<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;

class UserController extends Controller
{
    public function show($id)
    {
      $login_user = \Auth::user();
      $nologin_user = User::find($id);
      $posts = $nologin_user->posts()->latest()->get();
        return view('users.show', [
          'title' => 'ユーザー詳細',
          'user' => $nologin_user,
          'posts' => $posts,
        ]);
    }
    
    public function store(Request $request, $id)
    {
        $login_user = \Auth::user();
        $nologin_user = User::find($id);
        $follow_user = Follow::create([
           'user_id' => $login_user->id,
           'follow_id' => $request->follow_id,
        ]);
        \Session::flash('success', 'フォローしました');
        return redirect()->route('users.show', $nologin_user->id);
    }
    
    public function destroy($id)
    {
        $nologin_user = User::find($id);
        $follow = \Auth::user()->follows->where('follow_id', $id)->first()->delete();
        \Session::flash('success', 'フォロー解除しました');
        return redirect()->route('users.show', $nologin_user->id);
    }
}
