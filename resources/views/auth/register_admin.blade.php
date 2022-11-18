<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> Admin </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{ asset('backend/css/style.css') }} " rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Đăng kí admin</h4>
                                    <span style="color: red">
                                        <?php $message = Session::get('message');
                                        if ($message) {
                                            echo $message;
                                            Session::put('message', null);
                                        } ?>

                                    </span>
                                    <form id="add_admin" action="{{ route('admin.auth.registerSave') }}"
                                        method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label><strong>Họ và tên</strong></label>
                                            <input name="admin_name" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input name="admin_email" type="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Số điện thoại</strong></label>
                                            <input name="admin_phone" type="number" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Địa chỉ</strong></label>
                                            <input name="admin_address" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Mật khẩu</strong></label>
                                            <input name="admin_pass" type="password" class="form-control">
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Đăng kí</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('backend/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $("#add_admin").validate({
            rules: {
                onkeyup: true,
                "admin_email": {
                    required: !0,
                    minlength: 3
                },
                "admin_pass": {
                    required: !0,
                    minlength: 5
                }
            },
            messages: {
                "admin_email": {
                    required: "Chưa nhập email !!",
                    minlength: "Ít nhất 3 kí tự !!"
                },
                "admin_pass": {
                    required: "Bạn chưa nhập mật khẩu",
                    minlength: "Mật khẩu của bạn phải dài ít nhất 5 ký tự !!!"
                }
            },





        });
    </script>
</body>

</html>
