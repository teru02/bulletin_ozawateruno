@extends('layouts.login')

@section('page_name')
<a href="top" class="page-name">新規投稿画面</a>
@endsection

@section('content')
<div id="post-content">
  <form action="new_post" method="post">
  @csrf
  <h4 for="sub_category">サブカテゴリー</h4>
    <select name="sub_category_id" id="sub_category" class="new-post">
      @foreach($sub_category as $sub_category)
        <option value="{{$sub_category->id}}">{{$sub_category->sub_category}}</option>
      @endforeach
    </select>
  <h4 for="title">タイトル</h4>
    <input type="text" name="title" class="new-post">
  <h4 for="post">投稿内容</h4>
    <textarea name="post" class="new-post"></textarea>
  <input type="submit" value="投稿" class="btn btn-danger post-btn">
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
