@if($shop->exists)
<div class="form-group">
    <label for="code" class="form-label">店舗コード</label>
    <input type="text" value="{{ $shop->display_shop_code }}" name="code" id="code" class="form-control no-border" disabled readonly>
</div>
@endif

<div class="form-group">
    <label for="name" class="form-label">店舗名<span class="text-danger"> *</span></label>
    <input type="text"
        name="name"
        id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $shop->name ?? '') }}"
        placeholder="OSAKA店">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="phone" class="form-label">電話番号</label>
    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="08000000000" value="{{ old('phone', $shop->phone) }}">
    @error('phone')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="postal_code" class="form-label">郵便番号</label>
    <input type="text"
        name="postal_code"
        id="postal_code"
        inputmode="numeric"
        class="form-control @error('postal_code') is-invalid @enderror"
        value="{{ old('postal_code', $shop->postal_code ?? '') }}"
        placeholder="111-1111">
    @error('postal_code')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="prefecture" class="form-label">都道府県<span class="text-danger"> *</span></label>
    <select name="prefecture" id="prefecture" class="form-control @error('prefecture') is-invalid @enderror">
        <option value="">選択してください</option>

        @foreach($regions as $region)
        <option value="{{ $region->id }}" {{ old('prefecture', $shop->region_id) == $region->id ? 'selected' : '' }}>
            {{ $region->name }}
        </option>
        @endforeach

    </select>
    @error('prefecture')
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="city" class="form-label">市区町村<span class="text-danger"> *</span></label>
    <input type="text"
        name="city"
        id="city"
        class="form-control @error('city') is-invalid @enderror"
        value="{{ old('city', $shop->city ?? '') }}"
        placeholder="大阪市">
    @error('city')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="address_line1" class="form-label">町名・番地<span class="text-danger"> *</span></label>
    <input type="text"
        name="address_line1"
        id="address_line1"
        class="form-control @error('address_line1') is-invalid @enderror"
        value="{{ old('address_line1', $shop->address_line1 ?? '') }}"
        placeholder="萩之茶屋1-1-1">
    @error('address_line1')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="address_line2" class="form-label">建物名など</label>
    <input type="text"
        name="address_line2"
        id="address_line2"
        class="form-control @error('address_line2') is-invalid @enderror"
        value="{{ old('address_line2', $shop->address_line2 ?? '') }}"
        placeholder="萩之ビル1F">
    @error('address_line2')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex justify-content-between mt-4">
    <a href="{{ route('shops.index') }}" class="btn btn-outline-secondary">
        キャンセル
    </a>
    <button class="btn btn-primary" type="submit">
        {{ $buttonText }}
    </button>
</div>