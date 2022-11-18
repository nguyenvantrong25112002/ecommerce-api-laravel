@extends('backend.layout')
@section('admin-layout')

    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Sửa sản phẩm</h1>
        </div>
        <div class=" card-body">
            <div class="basic-form">

                <form id='edit_product' action="{{ route('admin.product.editSave', $product->id_product) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input value="{{ old('name_product', $product->name_product) }}" name="name_product"
                                    type="text" id="text_slug" class=" form-control" placeholder="Tên sản phẩm">
                                @error('name_product')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Slug sản phẩm</label>
                                <input value="{{ $product->slug_product }}" value="" name="slug_product" type="text"
                                    id="text_slug_result" class=" form-control">

                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <div style="padding-bottom: 10px" class="border-bottom border-primary increment xpress">
                                    <div class="input-group-append">
                                        <button style="width:25%" class="btn_imggallery_product btn btn-primary"
                                            type="button">
                                            Thêm ảnh khác
                                        </button>
                                        <input style="padding-left: 15px" type="file" name="img_gallery[]" multiple
                                            class="imggallery_product form-control-file" accept="image/*"
                                            accept="image/gif, image/jpeg, image/png, image/jfif">


                                    </div>
                                    @error('img_gallery')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div style="display: none;" class="remove ">
                                    <div style="margin-top: 20px;" class="xpress border-bottom border-primary">
                                        <div class="input-group-append">
                                            <button style="width:25%" class="btn_remove btn btn-danger" type="button">
                                                Xóa
                                            </button>
                                            <input style="padding-left: 15px" type="file" name="img_gallery[]" multiple
                                                class="imggallery_product form-control-file" accept="image/*"
                                                accept="image/gif, image/jpeg, image/png, image/jfif">

                                        </div>
                                        @error('img_gallery')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if ($gallery_count > 0)
                                <div id='table-responsive' class="table-responsive">
                                    <table class="table table-hover table-responsive-sm">
                                        <thead class=" thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th style="width:130px">Ảnh chi tiết</th>
                                                <th>Thứ tự</th>
                                                <th colspan="2">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form>
                                                @csrf
                                                @foreach ($gallery as $stt => $imgGallerys)
                                                    <tr id="sid{{ $imgGallerys->id_gallery }}">
                                                        <th>{{ $stt + 1 }}</th>
                                                        <td>
                                                            <img style="max-width:100%"
                                                                src="{{ asset("$URL_IMG_GALLERY/$imgGallerys->img_gallery") }}"
                                                                alt="">
                                                        </td>
                                                        <td class="edit_name_gallery" contenteditable>
                                                            {{ $imgGallerys->order_gallery }}</td>
                                                        <td>
                                                            <button data-id_gallery="{{ $imgGallerys->id_gallery }}"
                                                                type="button" class="delete_gallery btn btn-danger"
                                                                role="button">
                                                                Xóa
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">Mô tả ngắn</label>
                                <textarea class="summernote" placeholder="Mô tả ngắn" style="resize: none"
                                    class="form-control" name="description_product" id="ckeditor_product_1"
                                    rows="4">{{ old('description_product', $product->description_product) }} </textarea>
                                @error(' description_product') <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Chi tiết</label>
                                <textarea class="summernote" placeholder="Chi tiết" style="resize: none"
                                    class="form-control" name="details_product" class="details_product"
                                    id="ckeditor_product_2"
                                    rows="9"> {{ old('details_product', $product->details_product) }} </textarea>


                                @error('details_product')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="btn  btn-primary mt-3">Lưu</button>
                                <a class="btn btn-google mt-3" href="{{ route('admin.product.list') }}">
                                    Quay lại
                                </a>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Ảnh sản phẩm</label>
                                <input id="files" type="file" class="form-control-file" name="img_product" placeholder=""
                                    aria-describedby="fileHelpId" accept="image/gif, image/jpeg, image/png">
                                <label style="cursor: pointer" for="files">
                                    <img style="width:100%;padding-top: 15px;" id="image"
                                        onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png' "
                                        src="{{ asset("$URL_IMG_PRODUCT/$product->img_product") }}" />


                                </label>
                                @error('img_product')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Giá gốc sản phẩm</label>
                                <input value="{{ old('price_product', $product->price_product) }}" type="text"
                                    name="price_product" id="price_product" class="form-control"
                                    placeholder="Giá sản phẩm" aria-describedby="helpId">
                                @error('price_product')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Giảm theo (%)</label>
                                <input value="{{ old('saleoff_product', $product->saleoff_product) }} " type="text"
                                    name="saleoff_product" id="saleoff_product" class="form-control"
                                    placeholder="Giảm giá theo (%)" aria-describedby="helpId">
                                @error('saleoff_product')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div style="border: 1px solid black;border-radius: 5px;">
                                <div style="padding: 20px;user-select: none;">

                                    <div class="form-group">
                                        <label for="">Sản phẩm sẽ được giảm (so với giá gốc)</label>
                                        <input readonly="true" type="text" name="pricesale" id="pricesale"
                                            class="form-control" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Giá cuối cùng</label>
                                        <input readonly="true" type="text" name="pricesale_product" id="pricesale_product"
                                            class="form-control" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group">
                                        <button onclick="tinh()" type="button" class="btn btn-facebook mt-3">
                                            Check giá khi giảm
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Số lượng</label>
                                <input value="{{ old('quantity_product', $product->quantity_product) }}" type="text"
                                    name="quantity_product" id="" class="form-control" placeholder="Số lượng"
                                    aria-describedby="helpId">
                                @error('quantity_product')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Thuộc danh mục</label>
                                <select class="form-control " name="category_id" id="">
                                    @foreach ($categoryParent as $cateItemParent)
                                        @php
                                            $dash = '';
                                        @endphp
                                        <option
                                            {{ $product->category_id == $cateItemParent->id_category ? 'selected' : '' }}
                                            value="{{ $cateItemParent->id_category }}" class="form-control-lg">
                                            {{ $cateItemParent->name_category }}
                                        </option>
                                        @include('backend.page.product.include.Edit_cateSelectChildrent',['cateItemParent'=>$cateItemParent])
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                {{-- <select class="form-control" name="status_product" id="">
                                    <option {{ $product->status_product == 0 ? 'selected' : '' }} value="0">Hiện</option>
                                    <option {{ $product->status_product == 1 ? 'selected' : '' }} value="1">Ẩn</option>
                                </select> --}}
                                <div style="display: flex;justify-content: space-around;">
                                    <label class="radio-inline">
                                        <input {{ $product->status_product == 0 ? 'checked' : '' }} value="0"
                                            type="radio" name="status_product">Hiện</label>
                                    <label class="radio-inline">
                                        <input {{ $product->status_product == 1 ? 'checked' : '' }} value="1"
                                            type="radio" name="status_product">Ẩn</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('javascrip')
    <script>
        $(document).ready(function() {
            $("#edit_product").validate({
                onkeyup: false,
                rules: {
                    name_product: {
                        required: true,
                        minlength: 5,
                    },

                    quantity_product: {
                        number: true,
                    },
                },
                messages: {
                    name_product: {
                        required: 'Chưa nhập tên sản phẩm !!!',
                    },



                    quantity_product: {
                        number: "Số lượng phải là số !!",
                    },
                }
            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        document.getElementById("files").onchange = function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("image").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        };
    </script>

    <script>
        $(document).ready(function() {
            $('.btn_imggallery_product').click(function() {
                var htmlData = $('.remove').html();
                console.log(htmlData);

                $('.increment').after(htmlData);
            });
        });
        $('body').on('click', '.btn_remove', function() {
            $(this).parents('.xpress').remove();
        });
    </script>

    <script>
        $(document).on('click', '.delete_gallery', function() {
            var id_gallery = $(this).data('id_gallery');
            $.ajax({
                url: "{{ route('admin.gallery.delete') }}",
                method: 'post',
                data: {
                    id_gallery: id_gallery
                },
                success: function(response) {
                    $('#sid' + id_gallery).remove();
                }
            });
        });
    </script>



@endsection
