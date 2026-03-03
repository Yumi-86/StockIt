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
            <form action="{{ route('stocks.index') }}" method="get" class="row align-items-end">

                <div class="col-md-6">
                    <label for="keyword" class="form-label">キーワード</label>
                    <input type="text"
                        name="keyword"
                        id="keyword"
                        class="form-control"
                        value="{{ request('keyword') }}"
                        @if(auth()->user()->isAdmin())
                    placeholder="商品名・商品コード・店舗名で検索"
                    @else
                    placeholder="商品名・商品コードで検索"
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
                    <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary px-4">
                        クリア
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>商品コード</th>
                        <th>商品名</th>
                        <th>カテゴリ</th>
                        @if(auth()->user()->isAdmin())
                        <th>所属店舗</th>
                        @endif
                        <th>在庫数</th>
                        <th>重量（g）</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="stock-list">
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
@endsection

@push('modals')
@include('products._modal')
@endpush