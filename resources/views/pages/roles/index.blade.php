@extends('backend.layout')
@section('admin-layout')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-10">
                        <div class="card-header">
                            <h2>Danh sách Phân quyền quản lý</h2>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card-header">
                            <a href="" class="btn btn-rounded btn-success mb-2">
                                <i class="icofont-ui-add"></i>
                                Thêm mới
                            </a>
                        </div>
                    </div>

                </div>

                <div class=" card-body">
                    <div class="table-responsive">
                        <table id="tableData" class="table table-hover table-responsive-sm">
                            <thead class="thead-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên quyền</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            {{-- <tbody id="conten_table_role">
                                @php
                                    $stt = 1;
                                @endphp
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>


                                            {{ $stt++ }}
                                        </td>
                                        <td class="edit_role" data-id_role="{{ $role->id_role }}"
                                            style="font-size: 1.3rem;" contenteditable id="id_role_{{ $role->id_role }}">
                                            {{ $role->name_role }}
                                        </td>
                                        <td>
                                            <button data-toggle="modal" data-target="#exampleModal"
                                                data-id_role="{{ $role->id_role }}"
                                                data-name_role="{{ $role->name_role }}"
                                                class="btn_edit_role btn badge badge-rounded badge-primary mb-2">
                                                <i class="icofont-ui-edit"></i>
                                                Sửa
                                            </button>
                                            <a href="{{ route('admin.roles.delete', ['id' => $role->id_role]) }}"
                                                class="badge badge-rounded badge-danger mb-2">
                                                <i class="icofont-bin"></i>
                                                Xóa
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
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
