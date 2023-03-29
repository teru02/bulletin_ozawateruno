@extends('layouts.login')
@section('page_name')
<h1><a href="top">掲示板投稿一覧</a></h1>
@endsection

@section('content')

<div>
  @foreach($posts as $posts)
  <div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
  <span>{{$posts->user->username}}</span>
  <span><a href="/post_detail/{{$posts->id}}">{{$posts->title}}</a></span>
  <span>{{$posts->post}}</span>
  <span>{{$posts->event_at}}</span>
  <span>{{$posts->subCategory->sub_category}}</span>
  <div>
    <span>コメント数</span>
    <span>{{$posts->comments_count}}</span>
  </div>
  @if (!$posts->isFavoritedBy(Auth::user()))
    <span class="favorites">
        <i class="fas fa-heart favorite-toggle" data-post-id="{{ $posts->id }}"></i>
      <span class="favorite-counter">{{$posts->post_favorites_count}}</span>
    </span>
  @else
    <span class="favorites">
        <i class="fas fa-heart favorite-toggle favorited" data-post-id="{{ $posts->id }}"></i>
      <span class="favorite-counter">{{$posts->post_favorites_count}}</span>
    </span>
  @endif
  <div>
    <span>閲覧数</span>
    <?php
       $view_count=\App\Models\ActionLogs\ActionLog::where('post_id',$posts->id)->count();
    ?>
    <span>{{$view_count}}</span>
  </div>

</div>
  @endforeach


@can('system-only')
<a href='/add_category' class="btn btn-danger">カテゴリーを追加</a>
@endcan
<a href="/create_post" class="btn btn-primary">投稿</a>

<div>
  <form action="/top" method="get">
    <input type="text" name="keyword" value="{{$keyword}}">
    <input type="submit" value="検索" class="btn btn-primary">
  </form>
</div>
<div>
  <form action="/top" method="get">
    <input type="submit" value="いいねした投稿" name="good_posts" class="btn btn-primary">
  </form>
</div>
<div>
  <form action="/top" method="get">
    <input type="submit" value="自分の投稿" name="my_posts" class="btn btn-primary">
  </form>
</div>
<div>
  <h4>カテゴリー</h4>
  @foreach($main_category as $main_category)
  <div>{{$main_category->main_category}}</div>
    @foreach($main_category->postSubCategories as $sub_category)
    <h6>サブ</h6>
    <a href="{{route('top',['sub_category_id'=>$sub_category->id])}}" method="get" name="sub_category">{{$sub_category->sub_category}}</a>
    @endforeach
  @endforeach
</div>

@endsection
