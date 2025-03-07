<?php

namespace App\Http\Controllers\UserFront\Auth;

use App\Mail\CustomerRegisterEmail;
use App\Mail\CustomerResetPwdEmail;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\State;
use Livewire\Component;
use App\Models\AdminSetting;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Component
{
    use AuthenticatesUsers;

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function sendInactiveCustomerResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.inactive')],
        ]);
    }

    public function register()
    {
        $states = State::desc()->get(['id', 'state_name']);
        // return view('user-front.auth.login', ['QsStates' => $states]);
        return view('user-front.auth.register', ['QsStates' => $states]);
    }

    public function postRegister(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'state_id' => 'required',
            'city' => 'required',
            'mobile' => 'required|numeric|unique:aihut_customer_register,mobile|digits_between:10,12',
            'email' => 'required|email|string|unique:aihut_customer_register,email|max:150',
            // 'password' => 'required|string|min:8|max:150', // 'confirmed' checks if 'password' matches 'cpassword'
            // 'cpassword' => 'required|same:password'
        ], [], [
            // 'cpassword' => 'confirm password',
            'mobile' => 'mobile number',
        ]);
        $nonHashedPassword = $validated['mobile'];
        // Additional fields
        $validated['is_active'] = $request->is_active ?? 0;
        $validated['password'] = Hash::make($validated['mobile']); // Hash the password
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['rm_staff_id'] = $randomStaff->id;
        $validated['status'] = 1;

        if ($validated) {
            // Create a new feedback record
            $customer = Customer::create($validated);
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($customer->email)->cc($adminEmail)->send(new CustomerRegisterEmail($customer, $randomStaff, $nonHashedPassword, $adminSetting, $adminwhatsapp));

            // Redirect to login with success message
            session()->flash(
                'user_register_success',
                'Thanks For Your Registration. Mr. <strong style="color: blue;">'
                    . $randomStaff->first_name . ' '
                    . $randomStaff->last_name . ' ('
                    . $randomStaff->mobile . ')</strong> is your Relationship Manager. Your Account will be activated soon...'
            );
            return redirect()->route('customer.register');
        }
    }

    protected function attemptLogin(Request $request)
    {
        // Attempt to authenticate the user
        if (auth()->guard('customer')->attempt(
            $this->credentials($request),
            $request->boolean('remember')
        )) {
            // Check if the authenticated customer is active
            $customer = auth()->guard('customer')->user();
            if (!$customer->is_active) {
                // Log out the customer immediately
                auth()->guard('customer')->logout();

                // Invalidate the session and regenerate the CSRF token
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Send the inactive user response
                $this->sendInactiveCustomerResponse($request);
            }
            // If the customer is active, return true (successful login)
            return true;
        }

        // If authentication fails, return false
        return false;
    }

    public function login()
    {
        $states = State::desc()->get(['id', 'state_name']);
        return view('user-front.auth.login', ['QsStates' => $states]);
    }

    public function postLogin(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            // dd('logdin');
            return redirect()->route('customer.dashboard');
        }
        // dd($request->all());
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        auth()->guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return to_route('customer.login');
    }

    public function forgotPassword()
    {
        return view('user-front.auth.forgot-password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:aihut_customer_register,email',
        ]);

        // Generate a token
        $token = Str::random(64);

        // Fetch the customer details
        $customer = Customer::where('email', $request->email)->first();

        // Generate the reset password URL (without storing the token)
        $salt =  $token . "||" . $customer->email;
        $url = url('customer/reset-password/' . base64_encode($salt));
        // dd($url);
        // Send the email

        $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
        $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
        Mail::to($customer->email)->cc($adminEmail)->send(new CustomerResetPwdEmail($url, $customer));

        return back()->with('success', 'A reset password link has been sent to your email.');
    }

    public function showResetPasswordForm($token)
    {
        return view('user-front.auth.change-password', ['token' => $token]);
    }

    public function emailCallback($token)
    {
        $salt = base64_decode($token);
        $exploded = explode("||", $salt);
        $email = $exploded[1];
        // dd($email, 123123213);
        return view('user-front.auth.change-password', ['email' => $email]);
        //return view for new password and confirm password
    }

    public function submitResetPasswordForm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:aihut_customer_register,email',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        Customer::where('email', $request->email)->update(['password' => Hash::make($request->new_password)]);
        session()->flash('success', 'Your password has been reset!');
        return redirect()->route('customer.login');

        // Redirect to login with success message
        session()->flash('success', 'Your password has been reset!');
        return redirect()->route('customer.login');
    }
}
