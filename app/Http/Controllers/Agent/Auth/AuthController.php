<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\State;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\AgentResetPwdEmail;
use App\Models\Staff;
use App\Mail\AgentRegisterEmail;
use App\Models\AdminSetting;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function sendInactiveAgentResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.inactive')],
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        // Attempt to authenticate the user
        if (auth()->guard('agent')->attempt(
            $this->credentials($request),
            $request->boolean('remember')
        )) {
            // Check if the authenticated agent is active
            $agent = auth()->guard('agent')->user();
            if (!$agent->is_active) {
                // Log out the agent immediately
                auth()->guard('agent')->logout();

                // Invalidate the session and regenerate the CSRF token
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Send the inactive user response
                $this->sendInactiveAgentResponse($request);
            }
            // If the agent is active, return true (successful login)
            return true;
        }

        // If authentication fails, return false
        return false;
    }

    public function login()
    {
        $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
        $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
        return view('agent.auth.login', ['adminmail' => $adminSetting , 'adminmobile' => $adminwhatsapp ]);
    }

    public function postLogin(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return redirect()->route('agent.dashboard');
        }
        // dd($request->all());
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        auth()->guard('agent')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return to_route('agent.login');
    }

    public function register()
    {
        $states = State::desc()->get(['id', 'state_name']);
        $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
        $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
        return view('agent.auth.register', ['QsStates' => $states , 'adminmail' => $adminSetting , 'adminmobile' => $adminwhatsapp ]);
    }

    public function postRegister(Request $request)
    {
        // dd($request->cpassword);
        // Validate the request
        $validated = $request->validate([
            'agency_name' => 'required|string|max:150',
            'owner_name' => 'required|string|max:150',
            'state_id' => 'required',
            'city' => 'required',
            'mobile' => [
                'required',
                'numeric',
                'digits_between:10,12',
                Rule::unique('aihut_agent', 'mobile')->whereNull('deleted_at'),
            ],
            'email' => [
                'required',
                'email',
                'string',
                'max:150',
                Rule::unique('aihut_agent', 'email')->whereNull('deleted_at'),
            ],
            // 'password' => 'required|string|min:8|max:150', // 'confirmed' checks if 'password' matches 'cpassword'
            // 'cpassword' => 'required|same:password'
        ], [], [
            'cpassword' => 'confirm password',
            'mobile' => 'mobile number',
            'state_id' => 'state',
        ]);
        $nonHashedPassword = $validated['mobile'];

        // Additional fields
        $validated['is_active'] = $request->is_active ?? 0;
        $validated['membership'] = 2;
        $validated['password'] = Hash::make($validated['mobile']); // Hash the password
		$randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['rm_staff_id'] = $randomStaff->id;
        $validated['status'] = 1;

        if($validated) {
            // Create a new feedback record
            $agent = Agent::create($validated);
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';

            Mail::to($agent->email)
            ->cc('biswajitadas15@gmail.com')
            ->send(new AgentRegisterEmail($agent, $request->mobile, $adminSetting, $adminwhatsapp));


            // Redirect to login with success message
            session()->flash('register_success',
            'Thanks For Your Registration. Mr. <strong style="color: blue;">'
            . $randomStaff->first_name . ' '
            . $randomStaff->last_name . ' ('
            . $randomStaff->mobile . ')</strong> is your Relationship Manager. Your Account will be activated soon...'
        );return redirect()->route('agent.register');
        }
    }

    public function forgotPassword()
    {
        $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
        $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
        return view('agent.auth.forgot-password', ['adminmail' => $adminSetting , 'adminmobile' => $adminwhatsapp ]);
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:aihut_agent,email',
        ]);

        // Generate a token
        $token = Str::random(64);

        // Fetch the agent details
        $agent = Agent::where('email', $request->email)->first();

        // Generate the reset password URL (without storing the token)
        $salt =  $token . "||" . $agent->email;
        $url = url('agent/reset-password/' . base64_encode($salt));
        // dd($url);
        // Send the email
        $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
        $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';

        // mail::to('joddhajitputel143@gmail.com')->send(new AgentResetPwdEmail($url, $agent));
        Mail::to($agent->email)->cc($adminEmail)->send(new AgentResetPwdEmail($url, $agent));


        return back()->with('success', 'A reset password link has been sent to your email.');
    }


    public function showResetPasswordForm($token)
    {
        return view('agent.auth.change-password', ['token' => $token]);
    }

    public function emailCallback($token)
    {
        $salt = base64_decode($token);
        $exploded = explode("||", $salt);
        $email = $exploded[1];
        // dd($email, 123123213);
        return view('agent.auth.change-password', ['email' => $email]);
        //return view for new password and conform password
    }

    public function submitResetPasswordForm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:aihut_agent,email',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        Agent::where('email', $request->email)->update(['password' => Hash::make($request->new_password)]);
        session()->flash('success', 'Your password has been reset!');
        return redirect()->route('agent.login');

        // Redirect to login with success message
        session()->flash('success', 'Your password has been reset!');
        return redirect()->route('agent.login');
    }
}
