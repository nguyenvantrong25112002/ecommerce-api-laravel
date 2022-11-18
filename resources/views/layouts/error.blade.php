<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> @yield('page-title', 'Admin')</title>
    <!-- Favicon icon -->
    {{-- <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png"> --}}
    <link href="{{ asset('asset/css/style.css') }} " rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center">
                        @yield('page-error-conten')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
