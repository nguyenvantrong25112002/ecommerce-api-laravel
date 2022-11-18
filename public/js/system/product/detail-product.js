const product = {
    addGallery: function (urlAddGallery, urlListGallery) {
        // set the dropzone container id
        const id = "#kt_dropzonejs_example_2";
        const dropzone = document.querySelector(id);

        // set the preview element template
        var previewNode = dropzone.querySelector(".dropzone-item");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        function addGallerySuccess(dataIMG) {
            var galleryHtml = $("#gallerys");
            var _html = /*html*/ `
               <div class="symbol symbol-75px me-5 mb-5">
                    <div class="symbol-label"
                        style="background-image:url('${dataIMG}')"></div>
                   
                </div>
            `;
            return galleryHtml.append(_html);
        }
        function loadGallerySuccess(data) {
            var galleryHtml = $("#gallerys");
            var _html = ` `;
            $.map(data, function (val, key) {
                _html += /*html*/ `  <div id="gallery_${val.id}" class="symbol symbol-75px me-5 mb-5">
                    <div class="symbol-label"
                        style="background-image:url('${val.image}')"></div>
                    <button data-id="${val.id}" class="remove-gallery symbol-badge badge badge-circle bg-danger start-100">
                        X
                    </button>
                </div>`;
            });
            galleryHtml.empty();
            return galleryHtml.html(_html);
        }
        var myDropzone = new Dropzone(id, {
            // Make the whole body a dropzone
            url: urlAddGallery, // Set the url for your upload script location
            params: {
                _token: _token,
            },
            paramName: "image",
            uploadMultiple: true,
            createImageThumbnails: true,
            thumbnailWidth: 200,
            thumbnailHeight: 200,
            maxFiles: 2,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            maxFilesize: 10, // Max filesize in MB
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            clickable: id + " .dropzone-select", // Define the element that should be used as click trigger to select files.

            success: function (file, response) {
                this.removeFile(file);
                toastr.success(response.message);
                loadGallerySuccess(response.payload);
                return true;
            },
            error: function (file, response) {
                this.removeFile(file);
                toastr.error(response.message);
                $.ajax({
                    type: "get",
                    url: urlListGallery,
                    success: function (response) {
                        return loadGallerySuccess(response.payload);
                    }
                });
                return false;
            },
        });

        myDropzone.on("addedfile", function (file) {
            // Hookup the start button
            file.previewElement.querySelector(id + " .dropzone-start").onclick =
                function () {
                    myDropzone.enqueueFile(file);
                };
            const dropzoneItems = dropzone.querySelectorAll(".dropzone-item");
            dropzoneItems.forEach((dropzoneItem) => {
                dropzoneItem.style.display = "";
            });
            dropzone.querySelector(".dropzone-upload").style.display =
                "inline-block";
            dropzone.querySelector(".dropzone-remove-all").style.display =
                "inline-block";
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            const progressBars = dropzone.querySelectorAll(".progress-bar");
            progressBars.forEach((progressBar) => {
                progressBar.style.width = progress + "%";
            });
        });

        myDropzone.on("sending", function (file) {
            // Show the total progress bar when upload starts
            const progressBars = dropzone.querySelectorAll(".progress-bar");
            progressBars.forEach((progressBar) => {
                progressBar.style.opacity = "1";
            });
            // And disable the start button
            // file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
            // file.previewElement.querySelector(id + " .dropzone-start").style.display = "none";
            // file.previewElement.querySelector(id + " .dropzone-toolbar").style.display = "none";
            // console.log('ok');
            const dropzoneItems = dropzone.querySelectorAll(".dropzone-item");
            dropzoneItems.forEach((dropzoneItem) => {
                dropzoneItem.style.display = "none";
            });
            addGallerySuccess(file.dataURL);
            setTimeout(() => {
                main.toastr("info", "Đang chạy...");
            }, 500);
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("complete", function (progress) {
            const progressBars = dropzone.querySelectorAll(".dz-complete");
            setTimeout(function () {
                progressBars.forEach((progressBar) => {
                    progressBar.querySelector(".progress-bar").style.opacity =
                        "0";
                    progressBar.querySelector(".progress").style.opacity = "0";
                    progressBar.querySelector(".dropzone-start").style.opacity =
                        "0";
                });
            }, 300);
        });

        // Setup the buttons for all transfers
        dropzone
            .querySelector(".dropzone-upload")
            .addEventListener("click", function () {
                myDropzone.enqueueFiles(
                    myDropzone.getFilesWithStatus(Dropzone.ADDED)
                );
            });

        // Setup the button for remove all files
        dropzone
            .querySelector(".dropzone-remove-all")
            .addEventListener("click", function () {
                dropzone.querySelector(".dropzone-upload").style.display =
                    "none";
                dropzone.querySelector(".dropzone-remove-all").style.display =
                    "none";
                myDropzone.removeAllFiles(true);
            });

        // On all files completed upload
        myDropzone.on("queuecomplete", function (progress) {
            const uploadIcons = dropzone.querySelectorAll(".dropzone-upload");
            uploadIcons.forEach((uploadIcon) => {
                uploadIcon.style.display = "none";
            });
        });

        // On all files removed
        myDropzone.on("removedfile", function (file) {
            if (myDropzone.files.length < 1) {
                dropzone.querySelector(".dropzone-upload").style.display =
                    "none";
                dropzone.querySelector(".dropzone-remove-all").style.display =
                    "none";
            }
        });
    },
    removeGallery: function (el, urlDelete) {
        $(document).on("click", el, function (e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var elRemove = `#gallerys div#gallery_${id}`;
            Swal.fire({
                html: `<span class="h2 text-dark">Bạn có chắc chắn muốn xóa ?</span>`,
                showDenyButton: true,
                showCancelButton: true,
                cancelButtonText: "Thoát",
                confirmButtonText: "Đúng vậy.",
                denyButtonText: `Thôi tôi đổi ý !`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).hide();
                    main.toastr("info", "Đang chạy...");
                    $.ajax({
                        type: "delete",
                        url: urlDelete,
                        data: {
                            id: id,
                        },
                        dataType: "json",
                        encode: true,
                        success: function (response) {
                            $(elRemove).remove();
                            main.toastr("success", response.payload);
                            return true;
                        },
                        error: function (response) {
                            $(this).show();
                            main.toastr("error", response.responseJSON.message);
                            return false;
                        },
                    });
                } else if (result.isDenied) {
                    Swal.fire("Bạn đã hủy xóa !", "", "info");
                }
            });
        });
    },
    addProperties: function (
        formElPropertiesSubmit,
        urlAddProperties,
        formElSpecies,
        urlLoadSpecies,
        propertiesArr
    ) {
        function checkLengthProperties(dataValues) {
            var flag = 0;
            var valuesArr = [];
            $.map(dataValues, function (key) {
                valuesArr.push(Number(key.value));
            });
            let filteredArray1 = valuesArr.filter(el => propertiesArr.includes(el));
            if (propertiesArr.length > filteredArray1.length) {
                flag = true;
            } else {
                flag = false;
            }
            propertiesArr = valuesArr
            return flag;
        }
        $(document).on('submit', formElPropertiesSubmit, function (e) {
            e.preventDefault();
            var values = $(this).serializeArray();
            $.ajax({
                type: "post",
                url: urlAddProperties,
                data: values,
                beforeSend: function () {
                    $('#modalAddProperties').modal('hide');
                    $(document).find(`${formElPropertiesSubmit} small.text-danger`).text('');
                    if (checkLengthProperties(values) === true) $(formElSpecies).submit()
                },
                success: function (response) {
                    if (response.status === true && response.code === 200) {
                        main.toastr('success', response.message);
                        loadSpeciesProduct().then(() => {
                            setTimeout(() => {
                                $('#modalSpecies').modal('show');
                            }, 1000);
                        })
                    }
                    return true;
                },
                error: function (response) {
                    if (response.responseJSON.status === false && response.responseJSON.code === 400) {
                        $.each(response.responseJSON.payload, function (preFix, val) {
                            $(`${el} small.text-danger.${preFix}_error`).text(val[0]);
                        });
                    }
                    return false;
                }
            });
        });
        async function loadSpeciesProduct() {
            var el_conten_species = $(`${formElSpecies} #conten-species`);
            var el_footer_species = $(`${formElSpecies} .modal-footer`);
            $.ajax({
                type: "get",
                url: urlLoadSpecies,
                beforeSend: function () {
                    el_conten_species.empty();
                    el_footer_species.empty();
                },
                success: function (response) {
                    console.log(response);
                    if (response.payload.properties.length > 0) {
                        el_footer_species.append(`
                            <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Thoát</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        `);
                    } else {
                        el_footer_species.append(`
                            <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Thoát</button>
                        `);
                    }
                    htmlContenSpecies(response.payload.properties, response.payload.species_id)
                }
            });
        }
        function htmlContenSpecies(datas, species_id) {
            var _html = ``;
            var el_conten_species = $(`${formElSpecies} #conten-species`);
            function speciesCheck(id) {
                let countSpecies = species_id.filter(function (key) { return key == id; });
                if (countSpecies > 0) return true;
                return false;
            }
            function propertiesSpecies(datas) {
                let _html = ``;
                if (datas.length <= 0) return;
                datas.forEach(key => {
                    _html +=/*html*/`
                        <div class="form-check mt-3 py-1 ">
                            <input ${speciesCheck(key.id) ? 'checked' : ''}  type="checkbox" class="form-check-input" name="species[]" id="${key.id}" value="${key.id}">
                            <label class="form-check-label"  for="${key.id}">
                                ${key.name}
                            </label>
                        </div>
                    `;
                });
                return _html;
            }
            datas.forEach(key => {
                _html += /*html*/`
                    <div id="propertie_${key.id}">
                        <h5 class="">${key.name}</h5>
                        ${propertiesSpecies(key.species)}
                    </div>
                    <hr>
                `;
            });
            return el_conten_species.append(_html);
        }
        $(document).on('change', `${formElPropertiesSubmit} input.properties_checkbox`, function () { // on change of state
            var val = $(this).val();
            if (!this.checked) $(`${formElSpecies} #propertie_${val} input[type='checkbox']`).prop("checked", false);
        })
    },
    addSpecies: function (el, urlAddSpecies) {
        $(el).submit(function (e) {
            e.preventDefault();
            var values = $(this).serialize();
            $.ajax({
                type: "post",
                url: urlAddSpecies,
                data: values,
                beforeSend: function () {
                    $("#modalSpecies").modal("hide");
                    $(document).find(`${el} small.text-danger`).text("");
                },
                success: function (response) {
                    if (response.status === true && response.code === 200) main.toastr("success", response.message);
                    return true;
                },
                error: function (response) {
                    if (
                        response.responseJSON.status === false &&
                        response.responseJSON.code === 400
                    ) {
                        $.each(response.responseJSON.payload, function (preFix, val) {
                            $(`${el} small.text-danger.${preFix}_error`).text(val[0]);
                        });
                    }
                    return false;
                },
            });
        });
    },
};
