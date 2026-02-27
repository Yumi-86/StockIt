<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-4 mb-2">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <p class="text-muted mb-3">スタッフ管理</p>
                    <p class="h5">自店舗スタッフ {{ $ownShopStaff }}人</p>
                    <p class="h5">全店舗スタッフ {{ $allStaff }}人</p>
                    <a href="{{ route('staff.index') }}" class="color-gray">スタッフ管理画面へ</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <p class="text-muted mb-3">商品マスタ管理</p>
                    <p>登録商品数 {{ $productMasterCount }}点</p>
                    <a href="{{ route('products.index') }}" class="color-gray">商品マスタ管理画面へ</a>
                </div>
            </div>
        </div>
    </div>
</div>