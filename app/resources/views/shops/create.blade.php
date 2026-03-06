@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">店舗登録</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body py-4">
                    <form action="{{ route('shops.store') }}" method="post" novalidate>
                        @csrf

                        @include('shops.partials.form', [
                        'buttonText' => '登録',
                        'staff' => null,
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection