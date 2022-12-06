@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <ul>
      @forelse($posts as $post)
          <li>
              {{ $post->user->name }}<br>
              {!! nl2br(e($post->comment)) !!}<br>
              ({{ $post->created_at }})<br>
              [<a href="{{ route('posts.edit', $post) }}">編集</a>]
              <form method="post" class="delete" action="{{ route('posts.destroy', $post) }}">
                @csrf
                @method('DELETE')
                <input type="submit" value="削除">
              </form>
          </li>
      @empty
          <li>投稿がありません。</li>
      @endforelse
  </ul>
@endsection