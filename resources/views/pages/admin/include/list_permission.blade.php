@if ($name_roles)
    <p class="form-text text-muted">
        Vai trò hiện tại :
        <span class=" font-weight-bold">
            @foreach ($name_roles as $name_role)
                {{ $name_role->name }}
            @endforeach
        </span>
    </p>
@endif
<input value=" {{ $id_admin }}" name="id_admin" type="text">
<div style="display: grid; grid-template-columns: 1fr 1fr; row-gap: 20px;">
    @foreach ($permissions as $permission)
        <div class="form-check" style="">
            <label class="form-check-label" style="user-select: none;">
                <input
                    @foreach ($permissions_via_role as $pvr) @if ($pvr->id == $permission->id)
                   checked @endif
                    @endforeach
                type="checkbox" class="form-check-input" name="permission_id[]"
                id="" value="{{ $permission->name }}">
                {{ $permission->name }}
            </label>
        </div>
    @endforeach
</div>
