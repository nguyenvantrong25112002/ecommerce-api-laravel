const admin = {
    selectRoles: function (rolesGroupElement, elementSelectRoles, auth_user_id, url_post_role) {

        // $(document).click(elementSelectRoles, function (e) {
        //     e.preventDefault();
        //     console.log(this);
        //     // alert($(this).val())
        //     // $(this + ' option').hide();
        // });
        $(document).on('change', elementSelectRoles, function (e) {
            e.preventDefault();
            var user_id = $(this).data('user_id');
            var val_role_id = $(this).val();
            if (user_id == auth_user_id) {
                main.toastr("warning", "Lỗi hệ thống ");
                return;
            }
            $.ajax({
                type: "post",
                url: url_post_role,
                data: {
                    role_id: val_role_id,
                    user_id: user_id
                },
                success: function (response) {
                    if (response.code == 200 && response.status == true) {
                        if (val_role_id == 0) $(`tr#user_id_${user_id}`).remove();
                        return main.toastr("success", response.message);
                    }
                },
                error: function (params) {
                    if (params.responseJSON.code == 404) return main.toastr("warning", params.responseJSON.message);
                }

            });
            // Swal.fire({
            //     html: `<span class="h2 text-dark">Bạn có chắc chắn muốn cấp lại quyền cho người này ?</span>`,
            //     showDenyButton: true,
            //     showCancelButton: true,
            //     cancelButtonText: 'Thoát',
            //     confirmButtonText: 'Đúng vậy.',
            //     denyButtonText: `Thôi tôi đổi ý !`,
            // }).then((result) => {
            //     if (result.isConfirmed) {

            //     } else if (result.isDenied) {
            //         Swal.fire('Bạn đã hủy cấp quyền !', '', 'info')
            //     }
            // })
        });

    },
    searchUsersAddAdmin: function (elementInput, urlSearchUser, informationUserEl) {
        function htmlInformationUser(data) {
            var _html = /*html*/ `
              
                <div class="row user">
                     <hr>
                     <div class="col-6">
                        <ul class="list-group">
                            <li class="list-group-item d-flex ">
                                <div class=" w-150px "> Họ và tên</div>
                                <span class="px-5">:</span>
                                <div>${data.name}</div>
                            </li>
                            <li class="list-group-item d-flex">
                                <div class="w-150px">
                                    Email
                                </div>
                                <span class="px-5">:</span>
                                <div>${data.email}</div>
                            </li>
                            <li class="list-group-item d-flex ">
                                <div class="w-150px">
                                    Số điện thoại
                                </div>
                                <span class="px-5">:</span>
                                <div>${data.phone_number}</div>
                            </li>
                            <li class="list-group-item d-flex ">
                                <div class="w-150px">
                                    Trạng thái
                                </div>
                                <span class="px-5">:</span>
                                <div>${data.status == 1 ? "Kích hoạt" : 'Chưa kích hoạt'}</div>
                            </li>
                        </ul>
                    </div>
                </div>
           `;
            $(informationUserEl).append(_html);
        }
        function searchUserGet(val) {
            var button = $('button[type="submit"]');

            return $.ajax({
                type: "get",
                url: urlSearchUser,
                data: {
                    information: val
                },
                beforeSend: function () {
                },
                success: function (response) {
                    if (response.code == 200 && response.status == true && response.payload) {
                        button.attr('disabled', false);
                        return htmlInformationUser(response.payload)
                    } else {
                        button.attr('disabled', true);
                        $(`${informationUserEl} small.text-danger`).text('Tài khoản không tồn tại trên hệ thống !!');
                        return;
                    }
                }
            });
        }
        $(elementInput).on('focusout', function (e) {
            var valInput = $(this).val();
            if (valInput == '' || valInput == null) {
                $(`${informationUserEl} small.text-danger`).text('Trường này không được bỏ trống.');
                return;
            }
            $(`${informationUserEl} small.text-danger`).text('');
            if ($(informationUserEl + ' .user').length > 0) $(informationUserEl + ' .user').remove();
            return searchUserGet(valInput);
        });
    },
    checkOldNewUser: function () {
        function checkUser() {
            var inputUset = $('#myTabContent input[type="text"][name="user"]');
            var button = $('button[type="submit"]');
            if ($("#myTabContent #kt_tab_pane_1").hasClass("active")) {
                button.attr('disabled', false);
                return inputUset.val('new');
            }
            if ($("#myTabContent #kt_tab_pane_2").hasClass("active")) {
                button.attr('disabled', true);
                return inputUset.val('old');
            }
        }
        checkUser()
        $(document).on('shown.bs.tab', 'a[data-bs-toggle="tab"]', function (e) {
            return checkUser()
        });
    }
}