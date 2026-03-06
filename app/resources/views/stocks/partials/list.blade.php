@forelse($stocks as $stock)
<tr>
    <td>{{ $stock->display_product_code }}</td>
    <td>{{ $stock->product->name }}</td>
    <td>{{ $stock->product->category->name }}</td>
    @if($mode === 'all')
    <td>{{ $stock->shop->name }}</td>
    @endif
    <td class="text-number">{{ $stock->quantity }}</td>
    <td class="text-number">
        {{ number_format($stock->totalWeight()) }}g
    </td>
    <td>
        @if($mode === 'my')
        <div class="d-flex align-items-center justify-content-center">
            <button class="btn btn-sm btn-outline-primary mr-2 js-product-detail" data-product-id="{{ $stock->product_id }}">商品詳細</button>
            <a href="{{ route('stocks.edit', $stock) }}" class="btn btn-sm btn-outline-danger">
                出庫登録
            </a>
        </div>
        @else
        <div class="d-flex align-items-center justify-content-center">
            <button class="btn btn-sm btn-outline-primary mr-2 js-product-detail" data-product-id="{{ $stock->product_id }}">商品詳細</button>
        </div>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="{{ $mode === 'all' ? 7 : 6 }}" class="text-center">
        まだ在庫はありません
    </td>
</tr>
@endforelse