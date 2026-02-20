<div class="container mt-4">
    <h1 class="h5 mb-1">ダッシュボード</h1>
    <p class="text-muted small">こんにちは {{ $user->name }} さん</p>

    <div class="row mb-2">
        <div class="col-12">
            <h3 class="h3 fw-bold">在庫管理</h3>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <p class="text-muted mb-1">総在庫数</p>
                    <h3 class="fw-bold display-6">{{$stockTotal}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <p class="text-muted mb-1">本日入荷予定数</p>
                    <h3 class="fw-bold display-6">{{$todayIncomingCount}}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <p class="text-muted mb-1">未確定入荷予定数</p>
                    <h3 class="fw-bold display-6">{{$unconfirmedIncomingCount}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-md-6">
            <h3 class="h3 fw-bold">直近１週間の入荷予定</h3>
        </div>
        <div class="col-md-6 text-end text-right">
            <a href="">入荷予定一覧へ</a>
        </div>
    </div>
    @include('incoming.partials.list', [
        'incomingPlans' => $inOneWeekIncomings,
        'isDashboard' => true,
    ])
    @if(!$user->isAdmin())
    <div class="row text-right">
        <div class="col-12 text-end">
            <a href="">入荷予定を入力する</a>
        </div>
        <div class="col-12 text-end">
            <a href="">在庫一覧を見る</a>
        </div>
    </div>
    @endif
</div>