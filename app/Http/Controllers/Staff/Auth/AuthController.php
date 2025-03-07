<?php



namespace App\Http\Controllers\Staff\Auth;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use App\Models\StaffAttendance;



class AuthController extends Controller

{

	use AuthenticatesUsers;

    public function login()

    {
        return view('staff.auth.login');
    }


    public function postLogin(Request $request)
    {
        // Validate user credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (auth()->guard('staff')->attempt($credentials)) {
            $staff = auth()->guard('staff')->user();
            // Insert or update attendance record
            try {
                $this->insertAttendanceRecord($staff->id);
            } catch (\Exception $e) {
                dd($e->getMessage());
                // Handle the exception and return an error message
                return redirect()->back()->withErrors(['attendanceError' => 'Unable to record attendance. Please try again later.']);
            }

            // Redirect to staff dashboard or another page
            return redirect()->route('staff.dashboard');
        } else {
            // Redirect back with error message
            return redirect()->back()->withErrors(['authError' => 'The credentials are incorrect.']);
        }
    }

    protected function insertAttendanceRecord($staffId)
    {
        $now = Carbon::now();
        $attendanceDate = $now->toDateString();
        $logInTime = $now->toTimeString();

        // Check if an attendance record already exists for today
        $attendance = StaffAttendance::where('staff_id', $staffId)
            ->where('attendance_date', $attendanceDate)
            ->first();

        if ($attendance) {
            // Only update log_in_time if it's not already set
            if (is_null($attendance->log_in_time)) {
                $attendance->update([
                    'log_in_time' => $logInTime,
                    'work_day' => $this->getWorkDayType(), // Optional: Add logic for determining work day type
                ]);
            }
        } else {
            // Create a new attendance record
            StaffAttendance::create([
                'staff_id' => $staffId,
                'attendance_date' => $attendanceDate,
                'log_in_time' => $logInTime,
                'work_day' => $this->getWorkDayType(), // Optional: Add logic for determining work day type
            ]);
        }
    }


    public function logout(Request $request)
    {
        $staffId = auth()->guard('staff')->id();
        $attendanceDate = Carbon::now()->toDateString(); // Current date
        $logOutTime = Carbon::now()->toTimeString();    // Current time

        // Find the attendance record for the logged-in staff member and today's date
        $attendance = StaffAttendance::where('staff_id', $staffId)
            ->where('attendance_date', $attendanceDate)
            ->first();

        if ($attendance) {
            // Ensure log_in_time is set before calculating hours
            if ($attendance->log_in_time) {
                // Calculate total hours
                $logInTime = Carbon::createFromFormat('H:i:s', $attendance->log_in_time);
                $logOutTimeCarbon = Carbon::createFromFormat('H:i:s', $logOutTime);

                // Calculate the total hours worked
                $totalMinutes = $logInTime->diffInMinutes($logOutTimeCarbon);
                $totalHours = round($totalMinutes / 60, 2); // Convert to hours with 2 decimal places

                // Update log_out_time and total_hours fields
                $attendance->update([
                    'log_out_time' => $logOutTime,
                    'total_hours' => $totalHours,
                    'work_day' => $this->getWorkDayType($totalHours), // Optionally set work_day based on total hours
                ]);
            } else {
                // Handle case where log_in_time is not set
                return redirect()->back()->withErrors(['logInError' => 'You must log in before logging out.']);
            }
        } else {
            // Handle case where attendance record does not exist
            return redirect()->back()->withErrors(['attendanceError' => 'No attendance record found for today.']);
        }

        // Log out the staff user
        auth()->guard('staff')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page or another page
        return to_route('staff.login');
    }
	
	protected function getWorkDayType($totalHours = null)
	{
		if ($totalHours < 4) {
			return 'No Day';
		} elseif ($totalHours >= 4 && $totalHours <= 5) {
			return 'Half Day';
		} elseif ($totalHours == 8) {
			return 'Full Day';
		} elseif ($totalHours > 8) {
			return 'Overtime';
		} else {
			return 'No Day';
		}
	}


    public function forgotPassword()
    {

        return view('staff.auth.forgot-password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:staffs,email',
        ]);

        // Generate a token
        $token = Str::random(64);

        // Fetch the agent details
        $staff = Staff::where('email', $request->email)->first();

        // Generate the reset password URL (without storing the token)
        $salt =  $token . "||" . $staff->email;
        $url = url('staff/reset-password/' . base64_encode($salt));
        // Send the email
        // Mail::to($agent->email)->send(new AgentResetPwdEmail($url, $agent));
        // mail::to('joddhajitputel143@gmail.com')->send(new AgentResetPwdEmail($url, $agent));

        return back()->with('success', 'A reset password link has been sent to your email.');
    }

    public function showResetPasswordForm($token)
    {
        return view('staff.auth.change-password', ['token' => $token]);
    }

    public function emailCallback($token)
    {
        $salt = base64_decode($token);
        $exploded = explode("||", $salt);
        $email = $exploded[1];
        return view('staff.auth.change-password', ['email' => $email]);
        //return view for new password and conform password
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:staffs,email',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        Agent::where('email', $request->email)->update(['password' => Hash::make($request->new_password)]);
        session()->flash('success', 'Your password has been reset!');
        return redirect()->route('staff.login');

        // Redirect to login with success message
        session()->flash('success', 'Your password has been reset!');
        return redirect()->route('agent.login');

    }
}

