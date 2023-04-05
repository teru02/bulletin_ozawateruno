@extends('layouts.login')
@section('page_name')
<a href="top" class="page-name">カテゴリー追加画面</a>
@endsection

@section('content')
<div id="main-content">
  <form action="add_main_category" method="post" class="add-category">
    @csrf
    <h4 for="new_main">新規メインカテゴリー</h4>
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


  <form action="add_sub_category" method="post" class="add-category">
    @csrf
    <h4 for="main">メインカテゴリー</h4>
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

    <h4 for="new_sub">新規サブカテゴリー</h4>
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
</div>
<div id="sub-content">
  <div>
    <h4>カテゴリー一覧</h4>
      @foreach($category_list as $category_list)
        <div class="main-category">
          <span>{{$category_list->main_category}}</span>
          @if(isset($sub_category_id[$category_list->id]))
          @else
            <a href="/main_delete/{{$category_list->id}}" type="submit" value="削除" class="btn btn-danger">削除</a>
          @endif
          </div>
              @foreach($category_list->postSubCategories as $sub_category)
                <div class="sub-category">
                  <span>{{$sub_category->sub_category}}</span>
                <a href="sub_delete/{{$sub_category->id}}" type="submit" value="削除" class="btn btn-danger">削除</a>
                </div>
              @endforeach

      @endforeach

  </div>
</div>

@endsection
