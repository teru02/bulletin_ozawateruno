@extends('layouts.logout')
@section('content')
<div class="container">
    <div class="form-content">
        <h5>ユーザー登録</h5>
        <form method="POST" action="/register">
            @csrf
            <div class="form-group">
                <label for="name">ユーザー名</label>
                <div class="">
                    <input id="name" type="text" name="username" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <div class="">
                    <input id="email" type="email" name="email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <div class="">
                    <input id="password" type="password" name="password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm">パスワード確認</label>
                <div class="">
                    <input id="password-confirm" type="password" name="password_confirmation">
                </div>
            </div>

            @if(count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            <div class="form-group">
                <div class="">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
