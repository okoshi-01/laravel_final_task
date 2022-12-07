@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<b>おすすめユーザー</b>
  <ul class="recommend_users">
    @forelse($recommend_users as $recommend_user)
      【<a href="{{ route('users.show', $recommend_user) }}">{{ $recommend_user->name }}</a>】
    @empty
      他のユーザーが存在しません。
    @endforelse
  </ul>
  
  <h1>{{ $title }}</h1>
  
  <form method="GET" action="{{ route('posts.index') }}">
    @csrf
    <label>
      検索：<input type="text" name="search" value="{{$search}}">
    </label>
    <input type="submit" value="検索">
  </form>
  
  <ul>
      @forelse($posts as $post)
          <li>
            <b>{{ $post->user->name }} </b><span class="date">({{ $post->created_at }})</span><br>
              {!! nl2br(e($post->comment)) !!}<br>
              @if(Auth::user()->id === $post->user->id)
              [<a href="{{ route('posts.edit', $post) }}">編集</a>]
              <form method="post" class="delete" action="{{ route('posts.destroy', $post) }}">
                @csrf
                @method('DELETE')
                <input type="submit" value="削除">
              </form>
              @else
              @endif
          </li>
      @empty
          <li>投稿がありません。</li>
      @endforelse
  </ul>
@endsection