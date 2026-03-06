@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="mb-0">商品マスタ一覧</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
            + 商品マスタ登録
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
            @error('code')
            <div class="alert alert-danger py-2">
                {{ $message }}
            </div>
            @endif

            <form action="{{ route('products.index') }}" method="get" class="row align-items-end">
                <div class="col-lg-2 col-md-2">
                    <label for="code" class="form-label">商品コード</label>
                    <input type="text"
                        name="code"
                        id="code"
                        class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code', request('code')) }}"
                        placeholder="ABC-01234">
                </div>

                <div class="col-lg-3 col-md-2">
                    <label for="keyword" class="form-label">キーワード</label>
                    <input type="text"
                        name="keyword"
                        id="keyword"
                        class="form-control"
                        value="{{ request('keyword') }}"
                        placeholder="商品名・カテゴリで検索">
                </div>

                <div class="col-md-2">
                    <label for="category_id" class="form-label">カテゴリ</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">すべて</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
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
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">
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
                    全 {{ $products->total() }} 件
                </div>
            </div>
            <table class="table table-striped table-hover align-middle table-fixed">
                <thead>
                    <tr>
                        <th style="width: 15%;">商品画像</th>
                        <th style="width: 15%;">商品コード</th>
                        <th style="width: 25%;">商品名</th>
                        <th style="width: 10%;">カテゴリ</th>
                        <th style="width: 10%;" class="text-number">重量（g）</th>
                        <th style="width: 10%;" class="text-center">状態</th>
                        <th style="width: 15%;" class="text-center">操作</th>
                    </tr>
                </thead>
                <tbody id="list">
                    @include('products.partials.list')
                </tbody>
            </table>
            <div id="loading" class="d-none">
                Loading...
            </div>
            <div id="endOfList" class="d-none text-center h6 text-secondary font-weight-bold">
                商品は以上です
            </div>
        </div>
    </div>
</div>
<button id="scrollTopBtn" class="btn btn-primary scroll-top-btn">
    ↑
</button>
@endsection