<div class="card shadow-sm">
    <div class="card-body">

        <div class="form-group">
            <label for="product_id" class="form-label font-weight-bold">入荷予定商品</label>
            <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                <option value="">選択してください</option>

                @foreach($products as $product)
                <option value="{{ $product->id }}"
                    data-weight="{{ $product->weight }}"
                    {{ old('product_id', $incomingPlan->product_id) == $product->id ? 'selected' : '' }}>
                    {{ $product->display_product_code }} |
                    {{ $product->name }}
                    ({{ $product->weight}}g)
                </option>
                @endforeach
            </select>
            @error('product_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity" class="form-label font-weight-bold">入荷予定数</label>
            <input type="number"
                name="quantity"
                id="quantity"
                value="{{ old('quantity', $incomingPlan->quantity) }}"
                class=" form-control @error('quantity') is-invalid @enderror">
            @error('quantity')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="arriving_date" class="form-label font-weight-bold">入荷予定日</label>
            <input type="date"
                name="arriving_date"
                id="arriving_date"
                class="form-control @error('arriving_date') is-invalid @enderror"
                value="{{ old('arriving_date', $incomingPlan->arriving_date ) }}">
            @error('arriving_date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="bg-light p-3 rounded text-end mb-4">
            <span class="font-weight-bold">合計数量:</span>
            <span id="total-weight" class="h5 text-primary">0</span>g
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('incomings.index') }}"
                class="btn btn-outline-secondary mr-3 mr-3">
                キャンセル
            </a>
            <button class="btn btn-primary" type="submit">
                {{ $buttonText }}
            </button>
        </div>
    </div>
</div>