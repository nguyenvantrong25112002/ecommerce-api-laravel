const admin = {
    selectRoles: function (elementSelectRoles) {
        $(document).on('change', elementSelectRoles, function (e) {
            e.preventDefault();
            alert($(this).val())
        });
    },
    searchUsersAddAdmin: function (elementInput, modalElement, urlSearchUser, modalElementConten) {
        function searchUserGet(val) {
            return $.ajax({
                type: "get",
                url: urlSearchUser,
                data: {
                    information: val
                },
                beforeSend: function () {
                    $(modalElement).modal("show");
                },
                success: function (response) {
                    if (response.code == 200 && response.status == true) {
                        console.log(response);
                    }
                }
            });
        }
        // $(elementInput).on({
        //     focusout: function (e) {
        //         e.preventDefault();
        //         var valInput = $(this).val();
        //         return searchUserGet(valInput);
        //     },
        //     keypress: function (e) {
        //         e.preventDefault();
        //         var valInput = $(this).val();
        //         if (e.which == 13) return searchUserGet(valInput);
        //     }
        // });
        $(elementInput).keyup(function (e) {
            e.preventDefault();
            var valInput = $(this).val();
            console.log(valInput);
        });
        $(elementInput).on('focusout', function (e) {
            var valInput = $(this).val();
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