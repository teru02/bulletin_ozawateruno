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
  <div class="error">
    <ul>
      @if($errors->first('main_category'))
        <li>{{ $errors->first('main_category') }}</li>
      @endif
    </ul>
  </div>


  <form action="add_sub_category" method="post">
    @csrf
    <label for="main">メインカテゴリー</label>
    <select name="main_category_id" id="main">
      <!-- <option value="">メインカテゴリーを選択してください</option> -->
      @foreach($main_category as $main_category)
      <option value="{{$main_category->id}}">{{$main_category->main_category}}</option>
      @endforeach
    </select>
    <div class="error">
    <ul>
      @if($errors->first('main_category_id'))
        <li>{{$errors->first('main_category_id')}}</li>
      @endif
    </ul>
    </div>

    <label for="new_sub">新規サブカテゴリー</label>
    <input type="text" name="sub_category" id="new_sub">
    <input type="submit" class="btn btn-danger" value="登録">
  </form>
  <div class="error">
    <ul>
      @if($errors->first('sub_category'))
        <li>{{ $errors->first('sub_category') }}</li>
      @endif
    </ul>
  </div>

  <div>
    <h2>カテゴリー一覧</h2>
      @foreach($category_list as $category_list)
        <h5>{{$category_list->main_category}}</h5>
          @if(isset($sub_category_id[$category_list->id]))
            <h4>サブ</h4>
          @else
            <a href="/main_delete/{{$category_list->id}}" type="submit" value="削除" class="btn btn-danger">削除</a>
          @endif
              @foreach($category_list->postSubCategories as $sub_category)
                <div>{{$sub_category->sub_category}}</div>
                <a href="sub_delete/{{$sub_category->id}}" type="submit" value="削除" class="btn btn-danger">削除</a>
              @endforeach

      @endforeach

  </div>
</div>

@endsection
