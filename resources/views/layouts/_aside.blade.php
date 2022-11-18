<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0" style="height: 617px;">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
            <div class="menu-item menu-accordion">
                <a class="menu-link" href="{{ route('admin.dashboard') }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-house"></i>
                    </span>
                    <span class="menu-title">Trang chủ</span>
                </a>
            </div>
            <div class="menu-item menu-accordion">
                <a class="menu-link" href="{{ route('admin.personnel.list') }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-users-gear"></i>
                    </span>
                    <span class="menu-title">Bộ máy nhân sự</span>
                </a>

            </div>

            {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="http://127.0.0.1:8000/admin/contests">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Star.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path
                                            d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z"
                                            fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-title">Cuộc thi</span>
                    </span>
                </a>
                <div class="menu-sub menu-sub-accordion menu-active-bg">

                </div>
            </div> --}}

            {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">

                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Code/Question-circle.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10">
                                    </circle>
                                    <path
                                        d="M12,16 C12.5522847,16 13,16.4477153 13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 C11,16.4477153 11.4477153,16 12,16 Z M10.591,14.868 L10.591,13.209 L11.851,13.209 C13.447,13.209 14.602,11.991 14.602,10.395 C14.602,8.799 13.447,7.581 11.851,7.581 C10.234,7.581 9.121,8.799 9.121,10.395 L7.336,10.395 C7.336,7.875 9.31,5.922 11.851,5.922 C14.392,5.922 16.387,7.875 16.387,10.395 C16.387,12.915 14.392,14.868 11.851,14.868 L10.591,14.868 Z"
                                        fill="#000000"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <!--end::Svg Icon-->

                    </span>
                    <span class="menu-title">Đánh giá năng lực</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="http://127.0.0.1:8000/admin/contests?type=1">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Bài đánh giá</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="http://127.0.0.1:8000/admin/questions">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Bộ câu hỏi </span>
                        </a>
                    </div>

                </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">

                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Tools/Pantone.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path
                                        d="M22,15 L22,19 C22,20.1045695 21.1045695,21 20,21 L8,21 C5.790861,21 4,19.209139 4,17 C4,14.790861 5.790861,13 8,13 L20,13 C21.1045695,13 22,13.8954305 22,15 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z"
                                        fill="#000000" opacity="0.3"></path>
                                    <path
                                        d="M15.5421357,5.69999981 L18.3705628,8.52842693 C19.1516114,9.30947552 19.1516114,10.5758055 18.3705628,11.3568541 L9.88528147,19.8421354 C8.3231843,21.4042326 5.79052439,21.4042326 4.22842722,19.8421354 C2.66633005,18.2800383 2.66633005,15.7473784 4.22842722,14.1852812 L12.7137086,5.69999981 C13.4947572,4.91895123 14.7610871,4.91895123 15.5421357,5.69999981 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z"
                                        fill="#000000" opacity="0.3"></path>
                                    <path
                                        d="M5,3 L9,3 C10.1045695,3 11,3.8954305 11,5 L11,17 C11,19.209139 9.209139,21 7,21 C4.790861,21 3,19.209139 3,17 L3,5 C3,3.8954305 3.8954305,3 5,3 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z"
                                        fill="#000000"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>

                    </span>
                    <span class="menu-title">Thử thách mã </span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="http://127.0.0.1:8000/admin/dev?type=1">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Bộ ngôn ngữ </span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="http://127.0.0.1:8000/admin/dev">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Bộ thử thách </span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="http://127.0.0.1:8000/admin/dev">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Cài đặt</span>
                        </a>
                    </div>

                </div>
            </div> --}}
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="fa-solid fa-gear"></i>
                    </span>
                    <span class="menu-title">Cấu hình</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.category.list') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Danh mục sản phẩm</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.product.list') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Sản phẩm</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.properties.list') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Thuộc tính sản phẩm</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.user.list') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Người dùng</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>
