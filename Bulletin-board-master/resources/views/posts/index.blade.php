@extends('layouts.login')
@section('page_name')
<a href="top" class="page-name">掲示板投稿一覧</a>
@endsection

@section('content')

<div id="main-content">
  @foreach($posts as $posts)
  <div class="timeline">
    <div class="user">
      <span>{{$posts->user->username}}さん</span>
    </div>
    <span>{{$posts->created_at->format('Y年n月j日')}}</span>
    <?php
       $view_count=\App\Models\ActionLogs\ActionLog::where('post_id',$posts->id)->count();
    ?>
    <span>{{$view_count}}View</span>
    <span class="block"><a href="/post_detail/{{$posts->id}}">{{$posts->title}}</a></span>
    <span class="post-sub">{{$posts->subCategory->sub_category}}</span>
    <span>コメント数</span>
    <span>{{$posts->comments_count}}</span>
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
</div>
  @endforeach
</div>

<div id="sub-content">
  @can('system-only')
  <div class="sub-btn">
    <a href='/add_category' class="btn btn-danger big-btn">カテゴリーを追加</a>
  </div>
  @endcan
  <div class="sub-btn">
    <a href="/create_post" class="btn btn-primary post-btn">投稿</a>
  </div>

  <div class="sub-btn search">
    <form action="/top" method="get">
      <input type="text" name="keyword" value="{{$keyword}}" class="text">
      <input type="submit" value="検索" class="btn btn-primary">
    </form>
  </div>

  <div class="sub-btn">
    <form action="/top" method="get">
      <input type="submit" value="いいねした投稿" name="good_posts" class="btn btn-primary big-btn">
    </form>
  </div>
  <div class="sub-btn">
    <form action="/top" method="get">
      <input type="submit" value="自分の投稿" name="my_posts" class="btn btn-primary big-btn">
    </form>
  </div>
  <div class="category">
    <h4>カテゴリー</h4>
  @foreach($main_category as $main_category)
    <div class="main-category">{{$main_category->main_category}}</div>
    @foreach($main_category->postSubCategories as $sub_category)
      <a href="{{route('top',['sub_category_id'=>$sub_category->id])}}" method="get" name="sub_category" class="sub-category">{{$sub_category->sub_category}}</a>
      @endforeach
    @endforeach
  </div>
</div>
@endsection
