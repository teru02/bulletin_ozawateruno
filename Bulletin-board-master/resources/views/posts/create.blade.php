@extends('layouts.login')

@section('page_name')
<h1><a href="top">新規投稿画面</a></h1>
@endsection

@section('content')
<form action="new_post" method="post">
  @csrf
  <label for="sub_category">サブカテゴリー</label>
    <select name="sub_category_id" id="sub_category">
      @foreach($sub_category as $sub_category)
        <option value="{{$sub_category->id}}">{{$sub_category->sub_category}}</option>
      @endforeach
    </select>
  <label for="">タイトル</label>
    <input type="text" name="title">
  <label for="">投稿内容</label>
    <textarea name="post"></textarea>
  <input type="submit" value="投稿" class="btn btn-danger">
</form>
@endsection
