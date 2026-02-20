@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">スタッフ編集</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body py-4">
                    <form action="{{ route('staff.update', ['user' => $staff]) }}" method="post" novalidate>
                        @csrf
                        @method('PUT')

                        @include('staff._form', [
                        'buttonText' => '更新',
                        'staff' => $staff,
                        'isEdit' => true
                        ])
                    </form>
        
                    <hr>
        
                    <div class="text-right">
                        <form action="{{ route('staff.toggle', ['user' => $staff]) }}" method="post" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-outline-danger btn-sm js-confirm" data-message="本当に無効化しますか？">
                                無効化
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection