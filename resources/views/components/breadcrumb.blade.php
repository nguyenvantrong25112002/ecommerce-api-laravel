<div>
    @props(['datas'])
    <div class="card mb-4 p-4">

        <ol class="breadcrumb text-muted fs-6 fw-bold ">
            @foreach ($datas as $data)
                @if ($data['active'])
                    <li class="breadcrumb-item pe-3 text-muted" aria-current="page">{{ $data['content'] }}</li>
                @else
                    <li class="breadcrumb-item pe-3">
                        <a class="pe-3" href="{{ $data['route'] }}">{{ $data['content'] }}</a>
                    </li>
                @endif
            @endforeach
        </ol>
    </div>

    {{-- <ol class="breadcrumb ">
        <li class="breadcrumb-item pe-3"><a href="#" class="pe-3">Home</a></li>
        <li class="breadcrumb-item pe-3"><a href="#" class="pe-3">Library</a></li>
        <li class="breadcrumb-item px-3 text-muted">Active</li>
    </ol> --}}
</div>
