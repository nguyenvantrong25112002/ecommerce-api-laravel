<div class="mb-3">
    <label for="" class="form-label">{{ $lable }}</label>
    <input value="{{ request()->has('search') ? request('search') : '' }}" type="text" data-key="search" id="search"
        class="form-control form-control-sm" placeholder="">
</div>
