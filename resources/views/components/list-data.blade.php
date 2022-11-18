<div class=" card card-flush p-4">
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-baseline">
                <div>
                    <button id="filter_show" type="button" class="btn btn-primary btn-sm">
                        <i class="bi bi-funnel"></i>
                        Lọc
                    </button>

                    <button id="reset-page" type="button" class="btn btn-info btn-sm">
                        <i class="bi bi-arrow-clockwise"></i>
                        Tải lại trang
                    </button>
                </div>
                <div>
                    {!! $action ?? '' !!}
                </div>
                @if ($route_add)
                    <a class="btn btn-primary btn-sm" href="{{ $route_add }}" role="button">
                        <i class="bi bi-plus-lg"></i>
                        {{ $route_add_text ?? ' Thêm mới' }}
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div id="filter" class="bg-light ">
        {!! $filter ?? '' !!}
    </div>
    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class=" table table-hover table-striped gy-7 gs-5">
                    <thead class="thead-primary">
                        {!! $header !!}
                    </thead>
                    <tbody>
                        @if ($pagination->count())
                            {!! $body !!}
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @if ($pagination->count())
        {{ $pagination->appends(request()->all())->links('pagination::bootstrap-5') }}
    @else
        <p class=" text-center">
            Không có dữ liệu nào như bạn mong muốn
        </p>
    @endif
    {{-- {{ $pagination->links() }} --}}

</div>
