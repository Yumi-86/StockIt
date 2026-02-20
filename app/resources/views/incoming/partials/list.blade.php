<div class="row mb-4">
    <div class="col-md-12">
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
                <tr>
                    <td>{{ $plan->product->code }}</td>
                    <td>{{ $plan->product->name }}</td>
                    <td>{{ $plan->product->category->name }}</td>
                    <td>{{ $plan->quantity }}</td>
                    <td>{{ number_format($plan->totalWeight()) }}g</td>
                    <td>{{ $plan->arriving_date }}</td>
                    @unless($isDashboard)
                    <td>
                        <span class="badge bg-success">確定</span>
                        <a href="#" class="btn btn-sm btn-outline-secondary">編集</a>
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
    </div>
</div>