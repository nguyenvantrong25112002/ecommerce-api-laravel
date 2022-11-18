@extends('backend.layout')
@section('admin-layout')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Thêm banner</h1>
        </div>
        <div class=" card-body">
            <div class="basic-form">
                <form id="add_banner" action="{{ route('admin.banner.addSave') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tiêu đề banner</label>
                                <input value="{{ old('title_banner') }}" name="title_banner" type="text" id="text_slug"
                                    class=" form-control" placeholder="Tiêu đề banner">
                                @error('title_banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Slug banner</label>
                                <input value="{{ old('slug_banner') }}" readonly="true" placeholder="Tự động điền"
                                    name="slug_banner" type="text" id="text_slug_result" class=" form-control">

                            </div>

                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <input name="url_banner" type="text" class="form-control">
                                @error('url_banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Mô tả ngắn</label>
                                <textarea class="summernote" placeholder="Mô tả ngắn" style="resize: none"
                                    class="form-control" name="description_banner" id="ckeditor_product_2"
                                    rows="9"> {{ old('description_banner') }} </textarea>
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
                                <input value="{{ old('img_banner') }}" id="files" type="file" name="img_banner"
                                    accept="image/gif, image/jpeg, image/png">
                                <label style="cursor: pointer" for="files">
                                    <img style="width:100%;padding-top: 15px;" id="image"
                                        src="https://daugiatruongphat.vn/assets/images/noimage.png" />
                                </label>
                                @error('img_banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Thứ tự banne</label>
                                <input value="{{ old('order_banner') }}" type="text" name="order_banner" id=""
                                    class="form-control" placeholder="Thứ tự banner" aria-describedby="helpId">
                                @error('order_banner')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div style="display: flex;justify-content: space-around;">
                                    <label class="radio-inline">
                                        <input checked value="0" type="radio" name="status_banner">Hiện</label>
                                    <label class="radio-inline">
                                        <input value="1" type="radio" name="status_banner">Ẩn</label>
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
            $("#add_banner").validate({
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
                    img_banner: {
                        required: true,
                    },
                    order_banner: {
                        number: true,
                    },
                },
                messages: {
                    img_banner: {
                        required: 'Bạn chưa chọn ảnh !!!',
                    },
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
