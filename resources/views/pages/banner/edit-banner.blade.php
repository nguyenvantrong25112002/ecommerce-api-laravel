@extends('backend.layout')
@section('admin-layout')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Sửa banner</h1>
        </div>
        <div class=" card-body">
            <div class="basic-form">
                <form id="edit_banner" action="{{ route('admin.banner.editSave', $banner->id_banner) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tiêu đề banner</label>
                                <input value="{{ old('title_banner', $banner->title_banner) }}" name="title_banner"
                                    type="text" id="text_slug" class=" form-control" placeholder="Tiêu đề banner">
                                @error('title_banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Slug banner</label>
                                <input value="{{ old('slug_banner', $banner->slug_banner) }}" readonly="true"
                                    placeholder="Tự động điền" name="slug_banner" type="text" id="text_slug_result"
                                    class=" form-control">

                            </div>

                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <input value="{{ old('url_banner', $banner->url_banner) }}" name="url_banner" type="text"
                                    class="form-control">
                                @error('url_banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Mô tả ngắn</label>
                                <textarea class="summernote" placeholder="Mô tả ngắn" style="resize: none"
                                    class="form-control" name="description_banner" id="ckeditor_product_2"
                                    rows="9"> {{ old('description_banner', $banner->description_banner) }} </textarea>
                                @error('description_banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="btn  btn-primary mt-3">Thêm</button>
                                <a class="btn btn-pinterest mt-3" href="{{ route('admin.product.addForm') }}">Reset</a>
                                <a class="btn btn-google mt-3" href="{{ route('admin.product.list') }}">
                                    Quay lại
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Ảnh</label>
                                <input id="files" type="file" name="img_banner" accept="image/gif, image/jpeg, image/png">
                                <label style="cursor: pointer" for="files">
                                    <img style="width:100%;padding-top: 15px;" id="image"
                                        src="{{ asset("$URL_IMG_BANNER/$banner->img_banner") }}" />
                                </label>
                                @error('img_banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Thứ tự banne</label>
                                <input value="{{ old('order_banner', $banner->order_banner) }}" type="text"
                                    name="order_banner" id="" class="form-control" placeholder="Thứ tự banner"
                                    aria-describedby="helpId">
                                @error('order_banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div style="display: flex;justify-content: space-around;">
                                    <label class="radio-inline">
                                        <input {{ $banner->status_banner == 0 ? 'checked' : '' }} value="0" type="radio"
                                            name="status_banner">Hiện</label>
                                    <label class="radio-inline">
                                        <input {{ $banner->status_banner == 1 ? 'checked' : '' }} value="1" type="radio"
                                            name="status_banner">Ẩn</label>
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
            $("#edit_banner").validate({
                onkeyup: false,
                rules: {
                    title_banner: {
                        required: true,
                        minlength: 5,
                    },
                    url_banner: {
                        url: true,
                    },
                    description_banner: {
                        maxlength: 100,
                    },

                    order_banner: {
                        number: true,
                    },
                },
                messages: {

                    title_banner: {
                        required: "Bạn chưa nhập tiêu đề của banner !!",
                        minlength: "Ít nhất phải được 5 kí tự !!",
                    },
                    url_banner: {
                        url: "Phải là url !!!",
                    },
                    description_banner: {
                        maxlength: "Tối đa 200 kí tự !!!",
                    },
                    order_banner: {
                        number: "Thứ tự phải là số !!",
                    },
                }
            });
        });
    </script>




@endsection
