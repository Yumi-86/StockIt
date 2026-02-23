@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">入荷予定登録</h2>

    <form action="{{ route('incomings.store') }}" method="post" class="form">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                @include('incomings._form', [
                'incomingPlan' => $incomingPlan,
                'buttonText' => '登録',
                ])
            </div>
        </div>
    </form>

</div>
@endsection
