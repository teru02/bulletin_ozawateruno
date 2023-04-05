@extends('layouts.logout')
@section('content')
    <div class="form-content">
        <h5>ログイン</h5>
        <form method="POST" action="/login">
        @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                    <div>
                        <input type="text" name="email" required autofocus>
                    </div>
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                    <div>
                        <input type="password" name="password" required>
                    </div>
            </div>
            @if(isset($error))
            <div class="alert alert-danger">
                <ui>
                <li>{{$error}}</li>
                </ui>
            </div>
            @endif
                <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
        <p>新規ユーザー登録は<a href="/register_view">こちら</a></p>
    </div>
@endsection
