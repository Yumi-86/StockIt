@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 80vh; background-color: #f8f9fa;">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm p-4 rounded-3">
            <h2 class="text-center mb-4 font-weight-bold text-primary">ログイン</h2>

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <!-- メールアドレス -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">メールアドレス</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- パスワード -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">パスワード</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" required>
                    @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- ログインボタン -->
                <div class="d-grid mb-3 text-center">
                    <button type="submit" class="btn btn-primary btn-lg">ログイン</button>
                </div>

                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-decoration-none small text-secondary">パスワードを忘れた場合</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection