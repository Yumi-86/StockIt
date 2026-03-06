@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="mb-0">入荷予定一覧</h2>
        <a href="{{ route('incomings.create') }}" class="btn btn-primary btn-sm">
            + 入荷予定登録
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
            @enderror

            <form action="{{ route('incomings.index') }}" method="get" class="row align-items-end">

                <div class="col-lg-2 col-md-2">
                    <label for="code" class="form-label">商品コード</label>
                    <input type="text"
                        name="code"
                        id="code"
                        class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code', request('code')) }}"
                        placeholder="ABC-12345">
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
                    <label for="arriving_date" class="form-label">入荷予定日</label>
                    <input type="date" name="arriving_date" id="arriving_date" value="{{ request('arriving_date') }}" class="form-control">
                </div>

                <div class="col-md-4 col-lg-3 d-flex justify-content-end">
                    <button class="btn btn-primary px-4 mr-2">検索</button>
                    <a href="{{ route('incomings.index') }}" class="btn btn-outline-secondary px-4">
                        クリア
                    </a>
                </div>
            </form>
        </div>
    </div>
    @include('incomings.partials.list', [
    'incomingPlans' => $incomingPlans,
    'isDashboard' => false,
    ])
</div>
<button id="scrollTopBtn" class="btn btn-primary scroll-top-btn">
    ↑
</button>
@endsection