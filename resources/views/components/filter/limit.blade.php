<div class="mb-3">
    <label for="" class="form-label">Hiển thị</label>
    <select data-key="limit" id="limit-page" class="form-select form-select-sm  " data-control="select2"
        data-hide-search="true" data-placeholder="Chọn số lượng hiển thị">
        <option @selected(!request()->has('limit')) value="null">Mặc định</option>
        <option @selected(request()->has('limit') && request('limit') == 5) value="5">5</option>
        <option @selected(request()->has('limit') && request('limit') == 10) value="10">10</option>
        <option @selected(request()->has('limit') && request('limit') == 15) value="15">15</option>
        <option @selected(request()->has('limit') && request('limit') == 20) value="20">20</option>
    </select>
</div>
