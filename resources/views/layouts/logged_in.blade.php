@extends('layouts.default')
 
@section('header')
<header>
    <ul class="logged_in_header_nav">
        <li class="site_name">
            マイクロブログ
        </li>
        <li class="posts_index">
          <a href="{{ route('posts.index') }}">
            投稿一覧
          </a>
        </li>
        <li class="posts_create">
          <form action="{{ route('posts.create') }}" method="GET">
            @csrf
            <input type="submit" value="新規投稿">
          </form>
        </li>
        <li class="logout">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="ログアウト">
          </form>
        </li>
    </ul>
    <p>{{ Auth::user()->name }}さん、こんにちは！</p>
</header>
@endsection