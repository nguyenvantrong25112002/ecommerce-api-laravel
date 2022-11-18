<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>LOGIN</title>
    <meta charset="utf-8" />


    @include('layouts._style')
</head>

<body id="kt_body" class="bg-dark">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url(assets/media/illustrations/sketchy-1/14-dark.png">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">


                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form">

                        <div class="mb-10 text-center">
                            {{-- <h1 class="text-dark mb-3">Đăng nhập</h1> --}}


                        </div>

                        <a href="{{ route('auth.redirect-google') }}"
                            class="btn btn-light-primary fw-bolder w-100 mb-10">
                            <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg"
                                class="h-20px me-3" />Đăng nhập bằng Google</a>

                        {{-- <div class="d-flex align-items-center mb-10">
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                            <span class="fw-bold text-gray-400 fs-7 mx-2">hoặc</span>
                            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder=""
                                name="email" autocomplete="off" />
                        </div>

                        <div class="mb-10 fv-row" data-kt-password-meter="true">

                            <div class="mb-1">

                                <label class="form-label fw-bolder text-dark fs-6">Password</label>

                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        placeholder="" name="password" autocomplete="off" />
                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                </div>

                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>

                            </div>

                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp;
                                symbols.</div>

                        </div> --}}

                        {{-- <div class="text-center">
                            <button type="button" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div> --}}

                    </form>

                </div>

            </div>

        </div>

    </div>

    @include('layouts._script')
</body>
<!--end::Body-->

</html>
