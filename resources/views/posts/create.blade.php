@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <form method="POST" action="{{ route('posts.store') }}">
      @csrf
      <div>
          <label>
              <textarea type="text" name="comment" rows="7" cols="30" placeholder="投稿内容"></textarea>
          </label>
      </div>
 
      <input type="submit" value="投稿">
  </form>
@endsection