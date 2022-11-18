@extends('backend.layout')
@section('admin-layout')
    ,


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Danh sách banner</h1>
            </div>
            <?php 
            $mes = Session::get('mes');
           
            if ($mes) :?>
            <div class="alert alert-info" role="alert">
                <strong> <?= $mes ?></strong>
                <?php Session::put('mes', null); ?>
            </div>
            <?php endif?>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableData" class="table table-hover table-responsive-sm">
                        <thead class="thead-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tiêu đề</th>
                                <th style="width:130px" scope="col">Ảnh</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Ngày thêm</th>
                                <th scope="col">Ngày sửa</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banner as $stt => $bannerItem)
                                <tr>
                                    <th>{{ $stt + 1 }}</th>
                                    <td>
                                        {{ $bannerItem->title_banner }}
                                    </td>
                                    <td>
                                        <img style="max-width:100%"
                                            src="{{ asset("$URL_IMG_BANNER/$bannerItem->img_banner") }}" alt="">

                                    </td>
                                    <td>
                                        {{ $bannerItem->status_banner == 0 ? 'Hiện' : 'Ẩn' }}
                                    </td>
                                    <td>{{ date('d-m-Y H:i', strtotime($bannerItem->created_at)) }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($bannerItem->updated_at)) }}</td>
                                    <td style="text-align: center;display: grid;align-content: space-evenly;">
                                        <a href="{{ route('admin.banner.editForm', $bannerItem->id_banner) }}"
                                            class="badge badge-rounded badge-primary mb-2">Sửa</a>
                                        <a onclick="return Delete('{{ $bannerItem->title_banner }}')"
                                            href="{{ route('admin.banner.delete', $bannerItem->id_banner) }}"
                                            class="badge badge-rounded badge-danger mb-2">Xóa</a>

                                        {{-- <a href="{{ route('admin.details.Product', $pro->id_product) }}"
                                            class="badge badge-rounded badge-dark mb-2">Chi tiết</a> --}}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
    <script>
        function Delete(title_banner) {
            return confirm('Bạn có chắc chắn muốn xóa banner có ttlie:' + title_banner + ' ?');
        }
    </script>
@endsection
