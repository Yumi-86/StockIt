@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">出庫登録</h2>

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">

                    <!-- 商品情報 -->
                    <div class="text-muted small mb-1">
                        商品：{{ $stock->display_product_code}} - {{ $stock->product->name }}
                    </div>
                    <div class="text-muted small mb-3">
                        店舗：{{ $stock->shop->name }}
                    </div>
                    <hr>

                    <!-- 在庫情報 -->
                    <div class="text-center my-3">
                        <div class="text-muted small">現在在庫</div>
                        <div class="display-4 font-weight-bold text-primary">
                            {{ $stock->quantity }}
                            <span class="h6 text-dark">点</span>
                        </div>
                    </div>

                    <!-- 出庫入力フォーム -->
                    <form action="{{ route('stocks.update', $stock) }}" method="post" class="form" novalidate>
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="issue_quantity" class="form-label">出庫数量</label>
                            <input
                                type="number"
                                id="issue_quantity"
                                name="quantity"
                                value="{{ old('quantity') }}"
                                class="form-control @error('quantity') is-invalid @enderror"
                                data-issue="{{ $stock->quantity }}">
                            @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="my-3 text-center">
                            <div class="text-muted small">出庫後在庫</div>
                            <div id="stock_after" class="h4 font-weight-bold">
                                <span id="stock_after_value">{{ $stock->quantity }}</span>
                                <span class="small">点</span>
                            </div>
                            <div class="d-none text-warning" id="issue_warning">今回の出庫で在庫が０になります。入荷予定を確認してください。</div>
                            <div class="d-none text-danger" id="issue_danger">
                                出庫数を見直してください。
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-4">
                            <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary w-25 mr-5">
                                キャンセル
                            </a>
                            <button class="btn btn-primary w-25" type="submit">
                                確定
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection