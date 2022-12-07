@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')

  <h1>{{ $title }}</h1>
  
  ユーザー名：{{$user->name}}
  @if(Auth::user()->id != $user->id)
    @if(Auth::user()->isFollowing($user))
      <form method="post" action="{{route('users.destroy',$user)}}">
        @csrf
        @method('delete')
        <input type="submit" value="フォロー解除">
      </form>
    @else
    <form method="post" action="{{route('users.store',$user)}}">
      @csrf
      <input type="hidden" name="follow_id" value="{{ $user->id }}">
      <input type="submit" value="フォロー">
    </form>
    @endif
  @endif
  
  <ul>
      @forelse($posts as $post)
          <li>
              {{ $post->user->name }}<br>
              {!! nl2br(e($post->comment)) !!}<br>
              ({{ $post->created_at }})<br>
          </li>
      @empty
          <li>投稿がありません。</li>
      @endforelse
  </ul>
  
@endsection