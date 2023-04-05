@extends('layouts.login')

@section('page_name')
<a href="/top" class="page-name">掲示板詳細画面</a>
@endsection

@section('content')
  <div class="post-detail">
    <div class="post-block">
      <div class="user">
        <span>{{$post->user->username}}</span><span>さん</span>
      </div>
      <span>{{$post->created_at->format('Y年n月j日')}}</span>
      <?php
      $view_count=\App\Models\ActionLogs\ActionLog::where('post_id',$post->id)->count();
      ?>
      <span class="child">{{$view_count}} View</span>
    </div>
    <div class="post-block title">
      <span>{{$post->title}}</span>
      @if($post->user_id === Auth::id())
      <a href="{{$post->id}}/edit" class="btn btn-danger child">編集</a>
      @endif
    </div>
    <div class="post-block">
      <span>{{$post->post}}</span>
    </div>
    <div class="post-block">
      <span class="post-sub">{{$post->subCategory->sub_category}}</span>
      <span class="child">
        <span class="comment-count">コメント数 {{$post->comments_count}}</span>
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
      </span>
    </div>
  </div>

<div id="comment">
  @foreach($comment as $comment)
  <div class="comment">
    <div class="comment-right">
      <div class="user">
        <span>{{$comment->user->username}}</span><span>さん</span>
      </div>
        <span>{{$comment->created_at->format('Y年n月j日')}}</span>
      <div><span>{{$comment->comment}}</span></div>
    </div>

    <div class="comment-left">
      @if($comment->user_id === Auth::id())
        <form action="{{$post->id}}/comment_edit" method="get">
        <input value="{{$comment->id }}" type="hidden" name="comment_id">
        <input type="submit" value="編集" class="btn btn-danger">
        </form>

      @endif
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
    </div>
  </div>
  @endforeach

<form action="/post_detail/{{$post->id}}/comment" method="post" class="comment-post">
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
</div>


@endsection
