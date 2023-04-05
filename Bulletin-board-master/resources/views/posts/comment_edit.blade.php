@extends('layouts.login')

@section('page_name')
<a href="/top" class="page-name">コメント編集画面</a>
@endsection

@section('content')
<div id="post-content">
<form action="comment_update" method="post">
  @csrf
  <h4 for="comment">コメント</h4>
    <textarea id="comment" value="{{old('comment')}}" name="comment" class="comment-edit">{{$comment->comment}}</textarea>
    <input type="hidden" value="{{ $comment->id }}" name="comment_id">
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


<form action="comment_delete" method="get">
  @csrf
  <input type="hidden" value="{{ $comment->id }}" name="comment_id">
  <input type="submit" value="削除" class="btn btn-danger post-btn">
</form>
</div>
@endsection
