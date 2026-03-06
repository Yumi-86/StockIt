<div class="row">
    <div class="col-md-4 mb-2">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <p class="text-muted small border-bottom pb-2 mb-3">スタッフ管理</p>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>自店舗スタッフ</span>
                        <span class="h3 mb-0 text-primary">{{ $ownShopStaff }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>全店舗スタッフ</span>
                        <span class="h3 mb-0 text-primary">{{ $allStaff }}</span>
                    </div>
                </div>
                <div class="mt-auto">
                    <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary btn-block">スタッフ管理画面へ</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <p class="text-muted small border-bottom pb-2 mb-3">店舗管理</p>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>全体店舗数</span>
                        <span class="h3 mb-0 text-primary">{{ $totalShops }}</span>
                    </div>
                </div>
                <div class="mt-auto">
                    <a href="{{ route('shops.index') }}" class="btn btn-outline-secondary btn-block"> 店舗管理画面へ</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <p class="text-muted small border-bottom pb-2 mb-3">商品マスタ管理</p>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>登録商品数</span>
                        <span class="h3 mb-0 text-primary">{{ $productMasterCount }}</span>
                    </div>
                </div>
                <div class="mt-auto">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-block">商品マスタ管理画面へ</a>
                </div>
            </div>
        </div>
    </div>
</div>