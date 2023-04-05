@extends('layouts.login')

@section('page_name')
<h1><a href="/top" class="page-name">投稿編集画面</a></h1>
@endsection

@section('content')
<div id="post-content">
<form action="update" method="post">
  @csrf
  <h4 for="sub_category">サブカテゴリー</h4>
    <select name="sub_category_id" id="sub_category" class="new-post">
      @foreach($sub_category as $sub_category)
        @if($sub_category->sub_category === $post_subcategory)
          <option value="{{$sub_category->id}}" selected>{{$sub_category->sub_category}}</option>
        @else
          <option value="{{$sub_category->id}}">{{$sub_category->sub_category}}</option>
        @endif
      @endforeach
    </select>
  <h4 for="title">タイトル</h4>
    <input type="text" id="title" value="{{old('title',$post->title)}}" name="title" class="new-post">
  <h4 for="post">投稿内容</h4>
    <textarea id="post" value="{{old('post')}}" name="post" class="new-post">{{$post->post}}</textarea>

  <input type="submit" value="更新" class="btn btn-danger post-btn">
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

  <a href="delete" type="submit" value="削除" class="btn btn-danger post-btn">削除</a>
</div>

@endsection
