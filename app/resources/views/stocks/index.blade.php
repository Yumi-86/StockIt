@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="mb-0">在庫一覧</h2>
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
            @enderror
            <form action="{{ $mode === 'all' ? route('stocks.all') : route('stocks.my') }}" method="get" class="row align-items-end">
                <div class="col-md-2">
                    <label for="code" class="form-label">商品コード</label>
                    <input type="text"
                        name="code"
                        id="code"
                        class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code', request('code')) }}"
                        placeholder="ABC-12345">
                </div>

                <div class="col-md-4">
                    <label for="keyword" class="form-label">キーワード</label>
                    <input type="text"
                        name="keyword"
                        id="keyword"
                        class="form-control"
                        value="{{ request('keyword') }}"
                        @if(auth()->user()->isAdmin())
                    placeholder="商品名・店舗名で検索"
                    @else
                    placeholder="商品名で検索"
                    @endif>
                </div>

                <div class="col-md-3">
                    <label for="category_id" class="form-label">カテゴリ</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">すべて</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                    <button class="btn btn-primary px-4 mr-2">検索</button>
                    <a href="{{ $mode === 'all' ? route('stocks.all') : route('stocks.my') }}" class="btn btn-outline-secondary px-4">
                        クリア
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center my-2">
                <div>
                    全 {{ $stocks->total() }} 件
                </div>
            </div>
            <table class="table table-bordered table-hover align-middle table-fixed">
                <thead>
                    <tr>
                        <th>商品コード</th>
                        <th>商品名</th>
                        <th>カテゴリ</th>
                        @if($mode === 'all')
                        <th>所属店舗</th>
                        @endif
                        <th class="text-number">在庫数</th>
                        <th class="text-number">重量（g）</th>
                        <th class="text-center">操作</th>
                    </tr>
                </thead>
                <tbody id="list">
                    @include('stocks.partials.list')
                </tbody>
            </table>
            <div id="loading" class="d-none">
                Loading...
            </div>
            <div id="endOfList" class="d-none text-center h6 text-secondary font-weight-bold">
                在庫商品は以上です
            </div>
        </div>
    </div>
</div>
<button id="scrollTopBtn" class="btn btn-primary scroll-top-btn">
    ↑
</button>
@endsection

@push('modals')
@include('products._modal')
@endpush