<div class="form-group">
    <label for="name" class="form-label">氏名</label>
    <input type="text"
        name="name"
        id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $staff->name ?? '') }}">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="email" class="form-label">メールアドレス</label>
    <input type="email"
        name="email"
        id="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $staff->email ?? '') }}">
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if(!$isEdit)
<div class="form-group">
    <label for="password" class="form-label">パスワード</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
    @error('password')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="password_confirmation" class="form-label">パスワード（確認用）</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
</div>
@endif

<div class="form-group">
    <label for="shop_id" class="form-label">所属店舗</label>
    <select name="shop_id" id="shop_id" class="form-control @error('shop_id') is-invalid @enderror">
        <option value="" disabled {{ old('shop_id', optional($staff)->shop_id) ? '' : 'selected' }}>選択してください</option>
        @foreach($shops as $shop)
        <option value="{{ $shop->id }}"
            {{ old('shop_id', optional($staff)->shop_id) == $shop->id ? 'selected' : '' }}>
            {{ $shop->name }}
        </option>
        @endforeach
        @error('shop_id')
        <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </select>
</div>

<div class="d-flex justify-content-between mt-4">
    <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary">
        キャンセル
    </a>
    <button class="btn btn-primary" type="submit">
        {{ $buttonText }}
    </button>
</div>