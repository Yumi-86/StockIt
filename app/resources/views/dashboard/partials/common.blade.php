<div class="container mt-4">
    <h1 class="h5 mb-1">ダッシュボード</h1>
    <p class="text-muted small">こんにちは {{ $user->name }} さん</p>

    <div class="row mb-2">
        <div class="col-12">
            <h3 class="h3 font-weight-bold">在庫管理</h3>
            <div class="text-right mb-3">
                <a href="{{ route('stocks.index') }}">在庫一覧を見る</a>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
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
    <div class="row mb-1">
        <div class="col-md-6">
            <h3 class="h3 font-weight-bold">直近１週間の入荷予定</h3>
        </div>
        <div class="col-md-6 text-end text-right">
            <a href="{{ route('incomings.index') }}">入荷予定一覧へ</a>
        </div>
    </div>
    @include('incomings.partials.list', [
    'incomingPlans' => $inOneWeekIncomings,
    'isDashboard' => true,
    ])
    @if(!$user->isAdmin())
    <div class="row text-right mb-3">
        <div class="col-12 text-end">
            <a href="{{ route('incomings.create') }}">入荷予定を入力する</a>
        </div>
        <div class="col-12 text-end">
            <a href="{{ route('stocks.index') }}">在庫一覧を見る</a>
        </div>
    </div>
    @endif
</div>