
const main = {
    ajaxSetup: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    },
    setUpPluginsToastr: function (page = "toastr-top-right") {
        toastr.options = {
            "closeButton": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": page,
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

    },
    slug: function (elementstast, elementEnd) {
        $(elementstast).keyup(function () {
            var slug = $(this).val();
            slug = slug.toLowerCase();
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
                '');
            slug = slug.replace(/ /gi, "-");
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            return $(elementEnd).val(slug);
        });
    },
    test: function () {
        alert()
    },
    resetForm: function () {
        $(document).on('click', 'button#reset', function (e) {
            e.preventDefault();
            window.location.reload()
        });
    },
    previewImage: function (elementInput, elementPreview) {


        // $("input[name='image']").val('c:/passwords.txt')
        // document.foo.submit();



        // console.log(  localStorage.getItem('mytime'));
        // localStorage.setItem("mytime",'sdsdasd');
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    console.log(e.target.result);
                    $(elementPreview).attr('src', e.target.result);
                    $(elementPreview).hide();
                    $(elementPreview).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(elementInput).change(function () {

            //  localStorage.setItem("mytime",$(this).val());
            readURL(this);
            // localStorage.setItem("mytime",$(this)[0].files[0])
            // console.log($(this)[0].files[0]);
            // console.log($(this).val());
        });


        //   const fileInput = document.querySelector(elementInput);
        // const myFile = new File(['Hello World!'], localStorage.getItem('mytime'), {type: 'image/jpeg', lastModified:new Date().getTime()}, 'utf-8'
        // );
        // const dataTransfer = new DataTransfer();
        // dataTransfer.items.add(myFile);
        // fileInput.files = dataTransfer.files;


    },
    toastr: function (key, conten, title) {
        switch (key) {
            case 'success':
                toastr.success(conten, title ?? 'Thành công')
                break;
            case 'warning':
                toastr.warning(conten, title ?? 'Cảnh báo')
                break;
            case 'error':
                toastr.error(conten, title ?? 'Lỗi')
                break;
            case 'info':
                toastr.info(conten, title ?? 'Thông báo')
                break;
            default:
                break;
        }
    }
}

main.ajaxSetup();
main.setUpPluginsToastr();



