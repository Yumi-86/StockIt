<div class="row d-flex justify-content-center align-items.center">
    <div class="col-lg-5 col-md-12 mr-4">
        <div class="w-100 mb-2 border bg-light d-flex justify-content-center align-items-center" style="height: 250px;">

            <img src="{{ $product->image_url ?? '' }}"
                alt="商品画像"
                class="img-fluid {{ $product->image_url ? '' : 'd-none' }}"
                style="max-height: 100%; object-fit: contain;"
                id="previewImage">
            <span id="noImageText" class="text-muted {{ $product->image_url ? 'd-none' : '' }}">
                画像が選択されていません
            </span>

        </div>

        <label for="putImage" class="btn btn-outline-primary btn-sm mb-0 mr-3 mt-2">
            商品画像を選択してください
        </label>
        <input type="file" name="image_path" id="putImage" class="d-none">

        <button type="button" id="removeImageBtn" class="btn btn-sm btn-outline-danger mt-2 d-none">
            画像クリア
        </button>

        @error('image_path')
        <div class="d-block alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-body">
                @if($product->exists)
                <div class="form-group">
                    <label for="code" class="form-label">商品コード</label>
                    <input type="text" value="{{ $product->display_product_code }}" name="code" id="code" class="form-control no-border" readonly>
                </div>
                @endif
                <div class="form-group">
                    <label for="name" class="form-label">商品名</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name ) }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id" class="form-label">カテゴリ</label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach

                        @error('category_id')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </select>
                </div>
                <div class="form-group">
                    <label for="weight" class="form-label">重量（g）</label>
                    <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $product->weight ) }}">
                    @error('weight')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end align-items-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mr-4">
                        キャンセル
                    </a>
                    <button class="btn btn-primary" type="submit">
                        {{ $buttonText }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>