@extends('layouts.logout')
@section('page_name')
<p>ログイン</p>
@endsection
@section('content')
<div class="container">
    <div class="">
        <form method="POST" action="/login">
        @csrf
            <div class="">
                <label for="email">メールアドレス</label>
                    <div class="">
                        <input type="text" name="email" required autofocus>
                    </div>
            </div>

            <div class="">
                <label for="password">パスワード</label>
                    <div class="">
                        <input type="password" name="password" required>
                    </div>
            </div>

            <div class="">
                <div class="">
                    <button type="submit" class="btn btn-primary">ログイン</button>
                </div>
            </div>
        </form>
    </div>
    <p>新規ユーザー登録は<a href="/register_view">こちら</a></p>
</div>
@endsection
