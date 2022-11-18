@extends('backend.layout')
@section('admin-layout'),
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Thêm quyền</h2>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form autocomplete="off" id="add_role" action="{{ route('admin.roles.add') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="">Tên quyền</label>
                                        <input name="name_role" type="text" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-rounded btn-primary">Lưu</button>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Được truy cập</label>
                                        <input name="permissions" type="text" class="form-control">
                                    </div>
                                    <div class="form-group" style="    height: 300px; overflow-y: auto;">
                                        @foreach ($routes as $route)
                                            <div style=" margin-right: 30px;" class="form-check">
                                                <label style=" user-select: none;" class="form-check-label"
                                                    for="{{ $route }}">
                                                    <input type="checkbox" class="form-check-input" id="{{ $route }}"
                                                        value="{{ $route }}">
                                                    {{ $route }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
{{-- @section('javascrip')
    <script>
        $(document).ready(function() {
            $('.btn_edit_role').on('click', function(e) {
                e.preventDefault();
                var id_role = $(this).data('id_role');
                var name_role = $(this).data('name_role');
                $('.input_name_role').val(name_role);
                $('.id_role').val(id_role);
            });
            $('.form_edit').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var data = form.serialize();
                $.ajax({
                    method: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: data,
                    success: function(response) {
                        // $(form)[0].reset();
                        $('#conten_table_role').html(response);
                        $('#exampleModal').modal('hide');

                    }
                });
            });
            // $('.edit_role').blur(function(e) {
            //     e.preventDefault();

            //     var id_role = $(this).data('id_role');
            //     alert(id_role);
            // });

            $("#add_role").validate({
                onkeyup: false,
                rules: {
                    name: {
                        required: true,
                        minlength: 1,
                    },
                },
                messages: {
                    name: {
                        required: 'Bạn chưa tên quyền !!!',
                    },
                }
            });

        });
    </script>
@endsection --}}
