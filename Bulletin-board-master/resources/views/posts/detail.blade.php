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
  <div>
    <span>コメント数</span>
    <span>{{$post->comments_count}}</span>
  </div>
  @if (!$post->isFavoritedBy(Auth::user()))
    <span class="favorites">
        <i class="fas fa-heart favorite-toggle" data-post-id="{{ $post->id }}"></i>
      <span class="favorite-counter">{{$post->post_favorites_count}}</span>
    </span>
  @else
    <span class="favorites">
        <i class="fas fa-heart favorite-toggle favorited" data-post-id="{{ $post->id }}"></i>
      <span class="favorite-counter">{{$post->post_favorites_count}}</span>
    </span>
  @endif
  <div>
    <span>閲覧数</span>
    <?php
      $view_count=\App\Models\ActionLogs\ActionLog::where('post_id',$post->id)->count();
    ?>
    <span>{{$view_count}}</span>
  </div>
  @if($post->user_id === Auth::id())
    <a href="{{$post->id}}/edit" class="btn btn-danger">編集</a>
  @endif

@foreach($comment as $comment)
<div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
<span>{{$comment->user->username}}</span><span>さん</span>
<span>{{$comment->event_at}}</span>
<span>{{$comment->comment}}</span>
  @if (!$comment->isLikedBy(Auth::user()))
    <span class="likes">
        <i class="fas fa-heart like-toggle" data-comment-id="{{ $comment->id }}"></i>
      <span class="like-counter">{{$comment->post_comment_favorites_count}}</span>
    </span>
  @else
    <span class="likes">
        <i class="fas fa-heart like-toggle liked" data-comment-id="{{ $comment->id }}"></i>
      <span class="like-counter">{{$comment->post_comment_favorites_count}}</span>
    </span>
  @endif
<form action="{{$post->id}}/comment_edit" method="get">
  <input value="{{$comment->id }}" type="hidden" name="comment_id">
  @if($comment->user_id === Auth::id())
    <input type="submit" value="編集" class="btn btn-danger">
  @endif
</form>
</div>
@endforeach

<form action="/post_detail/{{$post->id}}/comment" method="post">
  @csrf
  <textarea name="comment" placeholder="コチラからコメントできます"></textarea>
  <input value="{{ $post->id }}" type="hidden" name="post_id">
  <input type="submit" value="コメント" class="btn btn-primary">
</form>

@if(count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif

@endsection
