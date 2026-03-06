@forelse($products as $product)
<tr>
    <td>{{ $product->display_product_code }}</td>
    <td>
        <img src="{{ $product->image_url ?? asset('images/no-image.png') }}" width="60" alt="商品画像" width="60">
    </td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->category->name }}</td>
    <td>{{ number_format($product->weight) }}g</td>
    <td>
        {{ $product->statusName }}
    </td>
    <td>
        @if($product->is_active)
        <div class="d-flex align-items-center">
            <a href="{{ route('products.edit', $product ) }}" class="btn btn-sm btn-outline-primary mr-2">編集</a>
            <form action="{{ route('products.toggle', $product) }}" method="post" class="mb-0">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-outline-danger js-confirm"
                    data-message="本当に無効化しますか？">無効化</button>
            </form>
        </div>
        @else
        <div class="d-flex justify-content-start">
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