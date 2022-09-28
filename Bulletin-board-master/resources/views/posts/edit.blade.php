@extends('layouts.login')

@section('page_name')
<h1><a href="/top">投稿編集画面</a></h1>
@endsection

@section('content')
<form action="update" method="post">
  @csrf
  <label for="sub_category">サブカテゴリー</label>
    <select name="sub_category_id" id="sub_cetegory">
      @foreach($sub_category as $sub_category)
        @if($sub_category->sub_category === $post_subcategory)
          <option value="{{$sub_category->id}}" selected>{{$sub_category->sub_category}}</option>
        @else
          <option value="{{$sub_category->id}}">{{$sub_category->sub_category}}</option>
        @endif
      @endforeach
    </select>
  <label for="title">タイトル</label>
    <input type="text" id="title" value="{{old('title',$post->title)}}" name="title">
  <label for="post">投稿内容</label>
    <textarea id="post" value="{{old('post')}}" name="post">{{$post->post}}</textarea>

  <input type="submit" value="更新" class="btn btn-danger">
</form>

  <input type="submit" value="削除" class="btn btn-danger">

@endsection
