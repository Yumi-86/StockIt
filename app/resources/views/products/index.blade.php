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
            <form action="{{ route('products.index') }}" method="get" class="row align-items-end">

                <div class="col-lg-5 col-md-4">
                    <label for="keyword" class="form-label">キーワード</label>
                    <input type="text"
                        name="keyword"
                        id="keyword"
                        class="form-control"
                        value="{{ request('keyword') }}"
                        placeholder="商品名・商品コード・カテゴリで検索">
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
                <div>
                    {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <table class="table table-striped table-hover align-middle ">
                <thead>
                    <tr>
                        <th style="width: 20%;">商品コード</th>
                        <th style="width: 15%;">商品画像</th>
                        <th style="width: 20%;">商品名</th>
                        <th style="width: 10%;">カテゴリ</th>
                        <th style="width: 10%;">重量（g）</th>
                        <th style="width: 10%;">状態</th>
                        <th style="width: 15%;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->display_product_code }}</td>
                        <td>
                            <img src="{{ $product->image_url }}" width="60" alt="商品画像" width="60">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ number_format($product->weight) }}g</td>
                        <td>
                            {{ $product->statusName }}
                        </td>
                        <td>
                            @if($product->is_active)
                            <div class="d-flex align-items-center">
                                <a href="{{ route('products.edit', $product ) }}" class="btn btn-sm btn-outline-primary mr-2">編集</a>
                                <form action="{{ route('products.toggle', $product) }}" method="post" class="mb-0">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-danger js-confirm"
                                        data-message="本当に無効化しますか？">無効化</button>
                                </form>
                            </div>
                            @else
                            <div class="d-flex justify-content-start">
                                <form action="{{ route('products.toggle', $product ) }}" method="post" class="mb-0">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-outline-success">有効化</button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">商品が存在しません。</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end align-items-center my-3">
                {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection