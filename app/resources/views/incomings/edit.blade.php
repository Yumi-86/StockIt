@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">入荷予定編集</h2>

    <form action="{{ route('incomings.update', $incomingPlan) }}" method="post" class="form">
        @method('PUT')
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-4">
                <div class="card shadow-sm border-secondary px-5">
                    <div class="card-body">
                        <h3 class="mb-3 text-secondary">現在の登録情報</h3>
                        <div class="mb-3">
                            商品：
                            <span class="font-weight-bold">
                                {{ $incomingPlan->product->display_product_code}} {{$incomingPlan->product->name }}
                            </span>
                        </div>
                        <div class="mb-3">
                            数量：
                            <span class="font-weight-bold">
                                {{ $incomingPlan->quantity}}点
                            </span>
                        </div>
                        <div class="mb-3">
                            総重量：<span class="font-weight-bold">
                                {{ $incomingPlan->product->weight * $incomingPlan->quantity }}g
                            </span>
                        </div>
                        <div class="mb-3">
                            入荷予定日：
                            <span class="font-weight-bold">
                                {{ $incomingPlan->arriving_date }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-8">
                @include('incomings._form', [
                'incomingPlan' => $incomingPlan,
                'buttonText' => '更新',
                ])
            </div>
        </div>
    </form>
    @if($incomingPlan->status === \App\IncomingPlan::STATUS_NOT_ARRIVED)

    <div class="border-top pt-4 my-4">
        <div class="alert alert-warning">
            この入荷予定を確定すると、在庫へ反映され、編集できなくなります。
        </div>

        <form action="{{ route('incomings.confirm', $incomingPlan) }}" method="post" class="text-right">
            @csrf
            @method('PATCH')
            <button class="btn btn-danger">
                入荷確定する
            </button>
        </form>
    </div>

    @endif

</div>
@endsection