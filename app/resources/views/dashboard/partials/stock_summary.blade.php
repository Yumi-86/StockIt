<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <p class="text-muted mb-1">総在庫数</p>
                <h3 class="font-weight-bold display-6">{{$stockTotal}}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <p class="text-muted mb-1">本日入荷予定数</p>
                <h3 class="font-weight-bold display-6">{{$todayIncomingCount}}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <p class="text-muted mb-1">未確定入荷予定数</p>
                <h3 class="font-weight-bold display-6">{{$unconfirmedIncomingCount}}</h3>
            </div>
        </div>
    </div>
</div>