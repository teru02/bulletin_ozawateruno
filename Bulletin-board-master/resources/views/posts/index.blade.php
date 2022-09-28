@extends('layouts.login')
@section('page_name')
<h1>掲示板投稿一覧</h1>
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
</div>
  @endforeach
</div>

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

@endsection
