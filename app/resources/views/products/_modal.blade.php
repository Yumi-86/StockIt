<div class="modal fade" id="productModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">商品詳細</h5>
                <button class="close" data-dismiss="modal" aria-label="close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-6">
                            <div class="w-100">
                                <img
                                    id="modal-img"
                                    class="img-fluid"
                                    style="width:100%; height:250px; object-fit: contain;"
                                    src=""
                                    alt="商品画像">
                            </div>
                        </div>
                        <div class="col-6 text-left px-6">
                            <div class="mb-1">
                                <div id="modal-code" class="text-muted h5"></div>
                            </div>
                            <div class="mb-3">
                                <span class="text-muted">商品名 :</span>
                                <span id="modal-name" class="h3"></span>
                            </div>
                            <div class="mb-1">
                                <span class="text-muted">カテゴリ :</span>
                                <span id="modal-category" class="h5"></span>
                            </div>
                            <div class="mb-1">
                                <span class="text-muted">単体重量 :</span>
                                <span id="modal-weight" class="h5"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">CLOSE</button>
            </div>
        </div>
    </div>
</div>