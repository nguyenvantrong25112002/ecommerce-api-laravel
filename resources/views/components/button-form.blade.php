@props(['route_back'])
<div>
    <button type="submit" class="btn btn-rounded btn-primary">
        Lưu
    </button>
    <button type="button" style="margin-left: 10px" id="reset" class="btn btn-rounded btn-secondary">
        Tải lại
    </button>
    <a href="{{ $route_back }}" style="margin-left: 10px" class="btn btn-rounded btn-dark">
        Quay lại
    </a>
</div>
