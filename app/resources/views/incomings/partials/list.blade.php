<div class="row mb-4">
    <div class="col-md-12">
        @unless($isDashboard)
        <div class="d-flex justify-content-between">
            <div>
                全 {{ $incomingPlans->total() }} 件
            </div>
            <div>
                {{ $incomingPlans->appends(request()->except('page'))
                ->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @endif
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>商品コード</th>
                    <th>商品名</th>
                    <th>カテゴリ</th>
                    <th>入荷予定数</th>
                    <th>重量（g）</th>
                    <th>入荷予定日</th>
                    @unless($isDashboard)
                    <th>操作</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($incomingPlans as $plan)
                <tr class="{{ $plan->status === \App\IncomingPlan::STATUS_ARRIVED ? 'table_secondary text-muted' : ''}}">
                    <td>{{ $plan->display_product_code }}</td>
                    <td>{{ $plan->product->name }}</td>
                    <td>{{ $plan->product->category->name }}</td>
                    <td>{{ $plan->quantity }}</td>
                    <td>{{ number_format($plan->totalWeight()) }}g</td>
                    <td>
                        {{ $plan->arriving_date }}
                        @if($plan->status === \App\IncomingPlan::STATUS_ARRIVED)
                            <span class="badge bg-success ml-2">入荷済み</span>
                        @endif
                    </td>
                    @unless($isDashboard)
                    <td>
                        @if($plan->status === \App\IncomingPlan::STATUS_NOT_ARRIVED)
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="{{ route('incomings.edit', $plan) }}" class="btn btn-sm btn-outline-primary mr-2">編集</a>
                            <form action="{{ route('incomings.confirm', $plan ) }}" method="post" class="mb-0">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-danger js-confirm"
                                    data-message="この入荷予定を確定すると、在庫へ反映され、編集できなくなります。本当に確定しますか？">確定</button>
                            </form>
                        </div>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        入荷予定はありません
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @unless($isDashboard)
        <div class="d-flex justify-content-end align-items-center">
            {{ $incomingPlans->appends(request()->except('page'))
            ->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </div>
</div>