<div class="row">
    <div class="col-md-4 mb-2">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <p class="text-muted mb-3">スタッフ管理</p>
                <p>
                    <span>自店舗スタッフ</span> <span class="h4">{{ $ownShopStaff }}</span><span>人</span>
                </p>
                <p>
                    <span>全店舗スタッフ</span><span class="h4">{{ $allStaff }}</span><span>人</span>
                </p>
                <a href="{{ route('staff.index') }}" class="color-gray">スタッフ管理画面へ</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <p class="text-muted mb-3">店舗管理</p>
                <p>
                    <span>全体店舗数</span> <span class="h4">{{ $totalShops }}</span><span>店</span>
                </p>
                <a href="{{ route('shops.index') }}" class="color-gray"> 店舗管理画面へ</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <p class="text-muted mb-3">商品マスタ管理</p>
                <p>
                    <span>登録商品数</span>
                    <span class="h4">{{ $productMasterCount }}</span>
                    <span>点</span>
                </p>
                <a href="{{ route('products.index') }}" class="color-gray">商品マスタ管理画面へ</a>
            </div>
        </div>
    </div>
</div>