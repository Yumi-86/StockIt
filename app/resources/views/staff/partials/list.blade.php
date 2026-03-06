@forelse($staffs as $staff)
<tr>
    <td>{{ $staff->name }}</td>
    <td>{{ $staff->email }}</td>
    <td>{{ $staff->shop->name }}</td>
    <td class="text-center">{{ $staff->role_name }}</td>
    <td class="text-center">
        @if($staff->is_active)
        <span class="badge badge-success">{{ $staff->status_name }}</span>
        @else
        <span class="badge badge-secondary">{{ $staff->status_name }}</span>
        @endif
    </td>
    <td>
        @if($staff->is_active)
        <div class="d-flex align-items-center justify-content-center">
            <a href="{{ route('staff.edit', ['user' => $staff] ) }}" class="btn btn-sm btn-outline-primary mr-2">編集</a>
            <form action="{{ route('staff.toggle', ['user' => $staff]) }}" method="post" class="mb-0">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-outline-danger js-confirm"
                    data-message="本当に無効化しますか？">無効化</button>
            </form>
        </div>
        @else
        <div class="d-flex justify-content-center">
            <form action="{{ route('staff.toggle', ['user' => $staff] ) }}" method="post" class="mb-0">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-outline-success">有効化</button>
            </form>
        </div>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center">ユーザーが存在しません。</td>
</tr>
@endforelse