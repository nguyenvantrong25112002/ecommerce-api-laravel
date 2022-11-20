const admin = {
    selectRoles: function (elementSelectRoles) {
        $(document).on('change', elementSelectRoles, function (e) {
            e.preventDefault();
            alert($(this).val())
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