<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    //投稿一覧ページ
    public function index()
    {
        $posts = \Auth::user()->posts()->latest()->get();
        return view('posts.index', [
          'title' => '投稿一覧',
          'posts' => $posts,
        ]);
    }
    
    //新規投稿ページ
    public function create()
    {
        return view('posts.create', [
          'title' => '新規投稿',
        ]);
    }
    
    //新規投稿処理
    public function store(PostRequest $request)
    {
        Post::create([
          'user_id' => \Auth::user()->id,
          'comment' => $request->comment,
        ]);
        session()->flash('success', '投稿を追加しました');
        return redirect()->route('posts.index');
    }
    
    //投稿編集ページ
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', [
          'title' => '投稿編集',
          'post'  => $post,
        ]);
    }
    
    //投稿編集処理
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->only(['comment']));
        session()->flash('success', '投稿を編集しました');
        return redirect()->route('posts.index');
    }
    
    //投稿削除処理
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        \Session::flash('success', '投稿を削除しました');
        return redirect()->route('posts.index');
    }
    
    //ログイン時しか開けない(アクセス制限)
    public function __construct()
    {
        $this->middleware('auth');
    }
}
