@extends('layouts.login')
@section('page_name')
<h1><a href="top">カテゴリー追加画面</a></h1>
@endsection

@section('content')
<div>
  <form action="add_main_category" method="post">
    @csrf
    <label for="new_main">新規メインカテゴリー</label>
    <input type="text" name="main_category" id="new_main">
    <input type="submit" class="btn btn-danger" value="登録">
  </form>
  @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif


  <form action="add_sub_category" method="post">
    @csrf
    <label for="main">メインカテゴリー</label>
    <select name="main_category_id" id="main">
      <!-- <option value="">メインカテゴリーを選択してください</option> -->
      @foreach($main_category as $main_category)
      <option value="{{$main_category->id}}">{{$main_category->main_category}}</option>
      @endforeach
    </select>
    <label for="new_sub">新規サブカテゴリー</label>
    <input type="text" name="sub_category" id="new_sub">
    <input type="submit" class="btn btn-danger" value="登録">
  </form>

  <div>
    <h2>カテゴリー一覧</h2>

  </div>
</div>

@endsection
