@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">スタッフ登録</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body py-4">
                    <form action="{{ route('staff.store') }}" method="post" novalidate>
                        @csrf
        
                        @include('staff._form', [
                        'buttonText' => '登録',
                        'staff' => null,
                        'isEdit' => false
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection