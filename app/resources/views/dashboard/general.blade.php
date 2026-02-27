<div class="container mt-4">

    <div class="mb-4">
        <h1 class="h4 font-weight-bold mb-1">管理者ダッシュボード</h1>
        <p class="text-muted small mb-0">
            こんにちは {{ $user->name }} さん
        </p>
    </div>

    {{-- アクションボタン --}}
    <section class="mb-5">
        <h2 class="h5 font-weight-bold mb-4 border-bottom pb-2">
            作業メニュー
        </h2>

        <div class="row g-3">
            <div class="col-md-6">
                <a href="{{ route('incomings.index') }}"
                    class="btn btn-outline-primary w-100 py-3">
                    入荷予定一覧を見る
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('stocks.index') }}"
                    class="btn btn-outline-secondary w-100 py-3">
                    在庫一覧を見る
                </a>
            </div>
        </div>
    </section>

    {{-- 在庫サマリーカード --}}
    <section class="mb-5">
        <h2 class="h5 font-weight-bold mb-4 border-bottom pd-2">
            在庫状況
        </h2>
        @include('dashboard.partials.stock_summary')
    </section>

    {{-- 直近入荷 --}}
    <section>
        <h2 class="h5 font-weight-bold mb-4 border-bottom pb-2">
            直近1週間の入荷予定
        </h2>

        @include('incomings.partials.list', [
        'incomingPlans' => $inOneWeekIncomings,
        'isDashboard' => true,
        ])
    </section>

</div>