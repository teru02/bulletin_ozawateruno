@extends('layouts.login')

@section('page_name')
<h1><a href="/top">掲示板詳細画面</a></h1>
@endsection

@section('content')
<span>{{$post->user->username}}</span>
<span>{{$post->event_at}}</span>
<span>{{$post->title}}</span>
<span>{{$post->post}}</span>
<span>{{$post->subCategory->sub_category}}</span>
<a href="{{$post->id}}/edit" class="btn btn-danger">編集</a>

@foreach($comment as $comment)
<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
<span>{{$comment->user->username}}</span><span>さん</span>
<span>{{$comment->event_at}}</span>
<span>{{$comment->comment}}</span>
<a href="{{$comment->id}}/comment_edit" class="btn btn-danger">編集</a>
</div>
@endforeach

<form action="/post_detail/{{$post->id}}/comment" method="post">
  @csrf
  <textarea name="comment" placeholder="コチラからコメントできます"></textarea>
  <input value="{{ $post->id }}" type="hidden" name="post_id">
  <input type="submit" value="コメント" class="btn btn-primary">
</form>

@endsection
