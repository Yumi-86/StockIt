@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="mb-0">スタッフ一覧</h2>
        <a href="{{ route('staff.create') }}" class="btn btn-primary btn-sm">
            + スタッフ登録
        </a>
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button class="close" type="button" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif
    <div class="card shadow-sm mb-4 border-0 rounded">
        <div class="card-body">
            <form action="{{ route('staff.index') }}" method="get" class="row align-items-end">

                <div class="col-lg-5 col-md-4">
                    <label for="keyword" class="form-label">キーワード</label>
                    <input type="text"
                        name="keyword"
                        id="keyword"
                        class="form-control"
                        value="{{ request('keyword') }}"
                        placeholder="氏名・店舗・メールで検索">
                </div>

                <div class="col-md-2">
                    <label for="role" class="form-label">権限</label>
                    <select name="role" id="role" class="form-control">
                        <option value="">すべて</option>
                        <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>一般</option>
                        <option value="0" {{ request('role') == '0' ? 'selected' : '' }}>管理者</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="is_active" class="form-label">状態</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="">すべて</option>
                        <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>有効</option>
                        <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>無効</option>
                    </select>
                </div>
                <div class="col-md-4 col-lg-3 d-flex justify-content-end">
                    <button class="btn btn-primary px-4 mr-2">検索</button>
                    <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary px-4">
                        クリア
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center my-2">
                <div>
                    全 {{ $staffs->total() }} 件
                </div>
            </div>
            <table class="table table-striped table-hover align-middle table-fixed">
                <thead>
                    <tr>
                        <th style="width: 25%;">スタッフ名</th>
                        <th style="width: 25%;">メールアドレス</th>
                        <th style="width: 15%;">所属店舗名</th>
                        <th style="width: 10%;" class="text-center">権限</th>
                        <th style="width: 10%;" class="text-center">状態</th>
                        <th style="width: 15%;" class="text-center">操作</th>
                    </tr>
                </thead>
                <tbody id="list">
                    @include('staff.partials.list')
                </tbody>
            </table>
            <div id="loading" class="d-none">
                Loading...
            </div>
            <div id="endOfList" class="d-none text-center h6 text-secondary font-weight-bold">
                登録スタッフは以上です
            </div>
        </div>
    </div>
</div>
<button id="scrollTopBtn" class="btn btn-primary scroll-top-btn">
    ↑
</button>
@endsection