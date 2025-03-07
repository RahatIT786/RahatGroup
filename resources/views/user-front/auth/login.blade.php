<!DOCTYPE html>
<html lang="en">


@include('user-front.includes.header')

<body>

    <div class="bg-light py-5"
        style="background:url({{ asset('img/login-bg-b2c.jpg') }}) no-repeat;background-size:cover;">
        <div class="container">
            <div class="containerbox">
                <div class="sign_up form_container">
                    <form class="validate-form" method="POST"
                        action="{{ route('customer.postRegister') }}">

                        @if (session('user_register_success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="color: #1d6119;border: 1px solid #1d6119;">
                                {!! session('user_register_success') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    style="color: #1d6119;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @csrf
                        @method('post')
                      <h4>
                            AIHUT &ndash; User Registration
                      </h4>

                        <input class="name" type="text" id="name" maxlength="100" placeholder="{{ __('tablevars.name') }}" autocomplete="off">
                            <p class="namefield text">
                                <i class="fa fa-circle-exclamation"></i>
                                Please enter a valid username
                            </p>

                        <input class="city" type="text" id="city" maxlength="100"
                            placeholder="{{ __('tablevars.city') }}" autocomplete="off">
                        <p class="cityfield text"><i class="fa fa-circle-exclamation"></i> Please enter a city
                        </p>
                        <select style="border: 0" class="input100" id="state_id" name="state_id">
                            <option value="">{{ __('tablevars.select') }}
                                {{ __('tablevars.state') }}</option>
                            @foreach ($QsStates as $RsCity)
                                <option value="{{ $RsCity->id }}">{{ $RsCity->state_name }}</option>
                            @endforeach
                        </select>
                        <input class="email" type="email" maxlength="100" placeholder="{{ __('tablevars.email') }}"
                            autocomplete="off">
                        <p class="emailfield text"><i class="fa fa-circle-exclamation"></i> Please enter a valid
                            email-address</p>

                        <input class="mobile" type="mobile" placeholder="{{ __('tablevars.mobile') }}" maxlength="10"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off">
                        <p class="mobilefield text"><i class="fa fa-circle-exclamation"></i> Please enter a valid
                            phone-no</p>

                        <div class="passdiv">
                            <input class="pass" type="password" id="password" placeholder="Password"><i
                                class="fa fa-lock show-hide"></i>
                        </div>

                        <div class="passdiv">
                            <input class="pass2" type="cpassword" id="cpassword"
                                placeholder="{{ __('tablevars.confirm_pwd') }}" maxlength="150"
                                autocomplete="off"><i class="fa fa-lock show-hide"></i>
                        </div>
                        <p class="passfield text"><i class="fa fa-circle-exclamation"></i> Please enter atleast 6-12
                            character longer with numbers, symbol, small and capital letter.</p>
                        <p class="passfield2 text"><i class="fa fa-circle-exclamation"></i> Please enter a confirm
                            password</p>
                        <p class="forgetpass"><a href="{{ route('customer.forgotPassword') }}">Forget Your
                                Password?</a></p>
                        <p class="forgetpass"><a href="{{ route('customer.login') }}">Already have an account ? sign
                                in</a></p>
                        <button type="submit" class="btn secondary-btn">SIGN UP</button>
                    </form>
                </div>
                <div class="sign_in form_container">
                    <form class="login100-form validate-form" method="POST"
                        action="{{ route('customer.postLogin') }}">
                        @csrf
                        @method('post')
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h4>Sign In</h4>
                        <p>Use your email & password</p>
                        <input class="email1" name="email" type="email" placeholder="Email" autocomplete="off">
                        <p class="emailfield1 text"><i class="fa fa-circle-exclamation"></i> Please enter a valid
                            email-address</p>
                            @error('email')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>

                        @enderror
                        <div class="passdiv">
                            <input class="pass1" type="password"  name="password" placeholder="Password" autocomplete="off"><i
                                class="fa fa-lock show-hide"></i>
                        </div>
                        <p class="passfield1 text"><i class="fa fa-circle-exclamation"></i> Please enter a valid
                            password</p>
                            @error('password')
                            <span class="text-red" style="font-size: 0.875rem; font-weight: bold;">{{ $message }}</span>
                        @enderror
                        <button class="btn secondary-btn">SIGN IN</button>
                    </form>
                </div>
                <div class="toggle_container">
                    <div class="toggle">
                        <div class="toggle_panel toggle_left">
                            <h4>Welcome Back!</h4>
                            <p>Enter your personal details to use all of site features</p>
                            <button class="hidden btn default-btn" id="login">SIGN IN</button>
                        </div>
                        <div class="toggle_panel toggle_right">
                            <a href="{{ route('customer.register') }}" class="hidden btn default-btn" id="register" >SIGN UP</a>
                            <p class="forgetpass"><a href="{{ route('customer.forgotPassword') }}" style="color: white; font-weight: bold;"><strong>Forget Your
                                Password?</strong></a></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="{{ asset('assets/user-front/javascripts/jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('js/agent/login/main.js') }}"></script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
        const container = document.querySelector('.containerbox');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');
        const form = document.querySelector("form");

        const inputs = {
            name: document.querySelector(".name"),
            email: document.querySelector(".email"),
            pass: document.querySelector('.pass'),
            pass2: document.querySelector('.pass2'),
            mobile: document.querySelector('.mobile'),
            city: document.querySelector('.city'),
            email1: document.querySelector(".email1"),
            pass1: document.querySelector(".pass1")
        };

        const errorFields = {
            name: document.querySelector(".namefield"),
            email: document.querySelector(".emailfield"),
            mobile: document.querySelector(".mobilefield"),
            city: document.querySelector(".cityfield"),
            pass: document.querySelector(".passfield"),
            pass2: document.querySelector(".passfield2"),
            email1: document.querySelector(".emailfield1"),
            pass1: document.querySelector(".passfield1")
        };

        const patterns = {
            name: /^[a-z\d]{6,12}$/i,
            email: /^[^ ]+@[^ ]+\.[a-z]{2,3}$/,
            pass: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,12}$/,
            mobile: /^[+]?[0-9]{1,4}?[0-9]{7,12}$/,
            city: /^[a-z\d]{6,12}$/i
        };

        // Toggle between register and login views
        registerBtn.addEventListener('click', () => container.classList.add('active'));
        loginBtn.addEventListener('click', () => container.classList.remove('active'));

        // Toggle password visibility
        document.querySelectorAll(".show-hide").forEach(icon => {
            icon.addEventListener("click", () => {
                const input = icon.parentElement.querySelector("input");
                const isPassword = input.type === "password";
                input.type = isPassword ? "text" : "password";
                icon.classList.toggle("fa-lock", !isPassword);
                icon.classList.toggle("fa-unlock", isPassword);
            });
        });

        // Validate individual fields
        function validateField(input, pattern, errorField) {
            const isValid = pattern.test(input.value);
            errorField.style.display = isValid ? "none" : "inline";
            return isValid;
        }

        // Handle validation for each input
        function validateInputs() {
            return (
                validateField(inputs.name, patterns.name, errorFields.name) &&
                validateField(inputs.email, patterns.email, errorFields.email) &&
                validateField(inputs.pass, patterns.pass, errorFields.pass) &&
                validateField(inputs.pass2, patterns.pass, errorFields.pass2) &&
                validateField(inputs.mobile, patterns.mobile, errorFields.mobile) &&
                validateField(inputs.city, patterns.city, errorFields.city) &&
                validateField(inputs.email1, patterns.email, errorFields.email1) &&
                validateField(inputs.pass1, patterns.pass, errorFields.pass1)
            );
        }

        // Attach event listeners to fields for real-time validation
        Object.keys(inputs).forEach(key => {
            const inputElement = inputs[key];
            const pattern = patterns[key] || patterns.pass; // Use `pass` pattern as default for passwords
            const errorElement = errorFields[key];
            inputElement.addEventListener("keyup", () => validateField(inputElement, pattern, errorElement));
        });

        // Form submission with validation check
        // form.addEventListener("submit", (e) => {
        //     if (!validateInputs()) {
        //         e.preventDefault(); // Prevent form submission if validation fails
        //     }
        // });
    });
    </script> --}}

    <script>
         // Toggle password visibility
         document.querySelectorAll(".show-hide").forEach(icon => {
            icon.addEventListener("click", () => {
                const input = icon.parentElement.querySelector("input");
                const isPassword = input.type === "password";
                input.type = isPassword ? "text" : "password";
                icon.classList.toggle("fa-lock", !isPassword);
                icon.classList.toggle("fa-unlock", isPassword);
            });
        });
    </script>

</body>

</html>

@include('user-front.includes.footer')
