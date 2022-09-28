@extends('layouts.login')

@section('page_name')
<h1><a href="/top">コメント編集画面</a></h1>
@endsection

@section('content')
<form action="comment_update" method="post">
  @csrf
  <label for="comment">コメント</label>
    <textarea id="comment" value="{{old('comment')}}" name="comment">{{$comment->comment}}</textarea>

  <input type="submit" value="更新" class="btn btn-danger">
</form>

  <input type="submit" value="削除" class="btn btn-danger">

@endsection
