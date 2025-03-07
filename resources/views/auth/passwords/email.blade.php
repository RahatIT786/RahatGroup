<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>AIHUT</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
    {{-- <!-- CSS Libraries -->
    <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css"> --}}
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/core/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/core/components.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<body>
    <div id="app">
        <section class="section">
            <div class="container">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <h1 style="margin-top: 100px">AIHUT</h1>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">

                                {{ session('status') }}

                            </div>
                        @endif
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Forgot Password</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.email') }}" class="needs-validation"
                                    novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                        @error('email')
                                            <span class="v-msg">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Converthink Solutions {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->


    <script src="{{ asset('js/jquery.min.js') }}"></script>


    <script src="{{ asset('js/popper.js') }}"></script>


    <script src="{{ asset('js/tooltip.js') }}"></script>


    <script src="{{ asset('css/bootstrap/js/bootstrap.min.js') }}"></script>


    <script src="{{ asset('css/nicescroll/jquery.nicescroll.min.js') }}"></script>


    <script src="{{ asset('js/moment.min.js') }}"></script>


    <script src="{{ asset('js/stisla.js') }}"></script>


    <script src="{{ asset('js/scripts.js') }}"></script>


    <script src="{{ asset('js/custom.js') }}"></script>


</body>

</html>
