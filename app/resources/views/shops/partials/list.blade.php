@forelse($shops as $shop)
<tr>
    <td>{{ $shop->display_shop_code }}</td>
    <td>{{ $shop->name }}</td>
    <td>{{ $shop->prefecture }}{{ $shop->city }}</td>
    <td>{{ $shop->phone }}</td>
    <td>{{ $shop->stocks_count }}点</td>
    <td>{{ $shop->status_name }}</td>
    <td>{{ $shop->created_at->format('Y-m-d') }}</td>
    <td>
        @if($shop->is_active)
        <div class="d-flex align-items-center">
            <a href="{{ route('shops.edit', $shop) }}" class="btn btn-sm btn-outline-primary mr-2">編集</a>
            <form action="{{ route('shops.toggle', $shop) }}" method="post" class="mb-0">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-outline-danger js-confirm"
                    data-message="本当に無効化しますか？">無効化</button>
            </form>
        </div>
        @else
        <div class="d-flex justify-content-start">
            <form action="{{ route('shops.toggle', $shop) }}" method="post" class="mb-0">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-outline-success">有効化</button>
            </form>
        </div>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center">店舗が存在しません。</td>
</tr>
@endforelse