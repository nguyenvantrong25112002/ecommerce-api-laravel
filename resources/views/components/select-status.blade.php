<div>

    <div class="form-group">
        <label class="form-label">Trạng thái</label>
        <select name="status" class="form-select " data-control="select2" data-hide-search="true"
            data-placeholder="Chọn trạng thái">
            @if (isset($data))
                <option @selected($data == config('util.INACTIVE_STATUS')) value="0">Hủy kích hoạt
                </option>
                <option @selected($data == config('util.ACTIVE_STATUS')) value="1">Kích hoạt
                </option>
            @else
                <option @selected(old('status') == config('util.INACTIVE_STATUS')) value="0">Hủy kích hoạt
                </option>
                <option @selected(old('status') == config('util.ACTIVE_STATUS')) selected value="1">Kích hoạt
                </option>
            @endif
        </select>
        <x-text-error key="status"></x-text-error>
    </div>
</div>
