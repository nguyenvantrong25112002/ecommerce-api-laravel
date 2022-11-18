const properties = {
    deleteProperties: function (el, urlDelete) {
        $(el).click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var elRemove = `tr#properties_${id}`
            Swal.fire({
                html: `<span class="h2 text-dark">Bạn có chắc chắn muốn xóa ?</span>`,
                showDenyButton: true,
                showCancelButton: true,
                cancelButtonText: 'Thoát',
                confirmButtonText: 'Đúng vậy.',
                denyButtonText: `Thôi tôi đổi ý !`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: urlDelete,
                        data: {
                            id: id
                        },
                        success: function (response) {
                            $(elRemove).remove();
                            Swal.fire(response.payload, '', 'success')
                            setTimeout(() => {
                                window.location.href = response.urlTo
                            }, 2000);
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Bạn đã hủy xóa !', '', 'info')
                }
            })
        });
    },
    deleteSpecies: function (el, urlDelete) {
        $(el).click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var elRemove = `div#species_${id}`
            Swal.fire({
                html: `<span class="h2 text-dark">Bạn có chắc chắn muốn xóa ?</span>`,
                showDenyButton: true,
                showCancelButton: true,
                cancelButtonText: 'Thoát',
                confirmButtonText: 'Đúng vậy.',
                denyButtonText: `Thôi tôi đổi ý !`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: urlDelete,
                        data: {
                            id: id
                        },
                        success: function (response) {
                            $(elRemove).remove();
                            Swal.fire(response.payload, '', 'success')
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Bạn đã hủy xóa !', '', 'info')
                }
            })
        });
    },
    editSpecies: function (el, urlGet, urlSubmit) {

        $(el).click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "get",
                url: urlGet,
                data: {
                    id: id
                },
                success: function (response) {
                    if (response.payload.error) {
                        toastr.error(response.payload.error)
                        setTimeout(() => {
                            // $('#kt_modal_1').modal('toggle');
                            $('#kt_modal_1').modal('hide');
                        }, 500);
                        return;
                    }
                    $('#kt_modal_1 input#name_species').val(response.payload.name);
                    $('#kt_modal_1 textarea#describe_species').val(response.payload.describe);
                    $('#kt_modal_1 input#id_species').val(response.payload.id);
                    $('#form_species_edit').attr('data-id', id);
                }
            });



        });
        $('#form_species_edit').submit(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var values = $(this).serializeArray();
            values.push({
                name: 'id',
                value: id
            });
            $.ajax({
                type: "put",
                url: urlSubmit,
                data: values,
                beforeSend: function () {
                    $(document).find('#form_species_edit small.text-danger').text('');
                },
                success: function (response) {
                    if (response.status == false && response.errors) {
                        $.each(response.errors, function (preFix, val) {
                            $(`#form_species_edit small.text-danger.${preFix}_error`).text(val[0]);
                        });
                    } else {
                        if (response.payload.error) {
                            toastr.error(response.payload.error)
                            setTimeout(() => {
                                $('#kt_modal_1').modal('hide');
                            }, 500);
                            return;
                        }
                        if (response.status == true && !response.payload.error) {
                            toastr.success(response.payload)
                            setTimeout(() => {
                                $('#kt_modal_1').modal('hide');
                            }, 500);
                            return;
                        }
                    }
                }
            });
        });
    }
}


