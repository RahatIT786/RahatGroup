<!DOCTYPE html>

<html lang="en">



<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>AIHUT Staff</title>

    <!-- base:css -->

    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">

    <!-- endinject -->

    <!-- plugin css for this page -->

    <!-- End plugin css for this page -->

    <!-- inject:css -->

    <link rel="stylesheet" href="{{ asset('css/staff/style.css') }}">

    <!-- endinject -->

    <link rel="shortcut icon" href="{{ asset('img/staff/favicon.png') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>



<body>

    <div class="container-scroller d-flex">

        <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">

            <div class="content-wrapper d-flex align-items-center auth px-0">

                <div class="row w-100 mx-0">

                    <div class="col-lg-4 mx-auto">

                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                            <div class="brand-logo">

                                <img src="{{ asset('img/staff/logo.svg') }}" alt="logo">

                            </div>

                            <h4>Hello! let's get started</h4>

                            <h6 class="font-weight-light">Forgot Password?</h6>

                            <form method="POST" class="pt-3" action="{{ route('staff.postLogin') }}"
                                class="needs-validation" novalidate="">

                                @csrf

                                <div class="form-group">

                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                        placeholder="Email" name="email">

                                    @error('email')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror

                                </div>

                                {{-- <div class="form-group">

                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password" name="password">

                                    @error('password')
                                        <span class="v-msg">{{ $message }}</span>
                                    @enderror

                                </div> --}}

                                <div class="mt-3">

                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Submit</button>

                                </div>

                                <div class="my-2 d-flex justify-content-end align-items-center">

                                    <a href="{{ route('staff.login') }}" class="auth-link text-black">Already have an account? Log In</a>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <!-- content-wrapper ends -->

        </div>

        <!-- page-body-wrapper ends -->

    </div>

    <!-- container-scroller -->

    <!-- base:js -->

    <script src="../../vendors/js/vendor.bundle.base.js"></script>

    <!-- endinject -->

    <!-- inject:js -->

    <script src="../../js/off-canvas.js"></script>

    <script src="../../js/hoverable-collapse.js"></script>

    <script src="../../js/template.js"></script>

    <!-- endinject -->

</body>



</html>
