<input type="text" value="{{ $id_admin }}" name="id_admin">
@if ($roles_admin == null)
    @foreach ($roles as $role)
        <div class="form-check form-check-inline mr-5">
            <label class="form-check-label" style="user-select: none;">
                <input class="form-check-input" type="radio" name="role[]" id="" value="{{ $role->name }}">
                {{ $role->name }}
            </label>
        </div>
    @endforeach
@else
    @foreach ($roles as $role)
        <div class="form-check form-check-inline mr-5">
            <label class="form-check-label" style="user-select: none;">
                <input {{ $roles_admin->id == $role->id ? 'checked' : '' }} class="form-check-input" type="radio"
                    name="role[]" id="" value="{{ $role->name }}">
                {{ $role->name }}
            </label>
        </div>
    @endforeach
@endif
