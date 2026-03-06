@forelse($products as $product)
<tr>
    <td>
        <img src="{{ $product->image_url ?? asset('images/no-image.png') }}" alt="商品画像" class="table-image">
    </td>
    <td>{{ $product->display_product_code }}</td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->category->name }}</td>
    <td class="text-number">{{ number_format($product->weight) }}g</td>
    <td class="text-center">
        @if($product->is_active)
        <span class="badge badge-success">{{ $product->statusName }}</span>
        @else
        <span class="badge badge-secondary">{{ $product->statusName }}</span>
        @endif
    </td>
    <td>
        @if($product->is_active)
        <div class="d-flex align-items-center justify-content-center">
            <a href="{{ route('products.edit', $product ) }}" class="btn btn-sm btn-outline-primary mr-2">編集</a>
            <form action="{{ route('products.toggle', $product) }}" method="post" class="mb-0">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-outline-danger js-confirm"
                    data-message="本当に無効化しますか？">無効化</button>
            </form>
        </div>
        @else
        <div class="d-flex justify-content-center">
            <form action="{{ route('products.toggle', $product ) }}" method="post" class="mb-0">
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
    <td colspan="7" class="text-center">商品が存在しません。</td>
</tr>
@endforelse