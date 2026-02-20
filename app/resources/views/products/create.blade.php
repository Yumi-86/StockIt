@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">商品マスタ登録</h2>

    <form action="{{ route('products.store') }}" method="post" class="form" enctype="multipart/form-data">
        @csrf

        @include('products._form', [
            'product' => $product,
            'buttonText' => '登録',
        ])
    </form>

</div>
@endsection