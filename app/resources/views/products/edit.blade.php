@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">商品マスタ編集</h2>

    <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('products._form', [
        'product' => $product,
        'buttonText' => '更新',
        ])
    </form>

    <hr>

    <div class="text-right">
        <form action="{{ route('products.toggle', $product) }}" method="post" class="d-inline">
            @csrf
            @method('PATCH')
            <button class="btn btn-outline-danger btn-sm js-confirm" data-message="本当に無効化しますか？">
                無効化
            </button>
        </form>
    </div>
</div>
@endsection