<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\{Str};
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\{Auth, Validator, Response, RateLimiter, Hash, File,};

class AuthController extends Controller
{
    /**
     * Display the login form for the admin.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('admin.auth.login');
    }
    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $this->clearLoginAttempts($request);
            return redirect()->route('admission.index')->with('success', 'Login Successfully.');
        } else {
            $this->incrementLoginAttempts($request);
            throw ValidationException::withMessages([
                'email' => ["The provided credentials are incorrect."],
            ]);
        }
    }
    /**
     * Get the rate limiting response for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));
        throw ValidationException::withMessages([
            'email' => [trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ])->status(429);
    }
    /**
     * Send the response after a failed login attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    /**
     * Determine if the user has too many login attempts.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return RateLimiter::tooManyAttempts(
            $this->throttleKey($request),
            config('auth.login_throttle.max_attempts', 5)
        );
    }
    /**
     * Increment the login attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request));
    }
    /**
     * Clear the login attempts for the specified user.
     *
     * This function uses the rate limiter to clear any recorded login attempts
     * for the user identified by the throttle key generated from the given request.
     *
     * @param \Illuminate\Http\Request $request The current HTTP request instance.
     * @return void
     */
    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }
    /**
     * Get the rate limiting throttle key for the request.
     *
     * @param \Illuminate\Http\Request $request The current HTTP request instance.
     * @return string The throttle key to use for rate limiting.
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    /**
     * Log the user out of the application.
     *
     * This method will log the user out by invalidating the current session and regenerating
     * the CSRF token to ensure security. It then returns a JSON response indicating successful
     * logout.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Response::json(['success' => 'Logout Successfully.']);
    }
    /**
     * Show the form for changing the current user's password.
     *
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm()
    {
        return view('admin.auth.change_password');
    }
    /**
     * Change the current user's password.
     *
     * This method will validate the current and new passwords, then update the user's
     * password in the database. If the current password does not match the user's
     * stored password, it will return a JSON response indicating an error. If the
     * new password is invalid, it will also return a JSON response with an error
     * message. If the password is successfully changed, it will log the user out,
     * invalidate the current session, and regenerate the CSRF token to ensure
     * security.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', Password::min(8)],
            'new_password'     => ['required', Password::min(8)],
            'confirm_password' => ['required', 'same:new_password'],
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        } else {
            if (!Hash::check($request['current_password'], Auth::user()->password)) {
                return back()->with('error', __('Current Password did not match.'));
            } else {
                User::where('id', Auth::user()->id)->update(['password' => Hash::make($request['new_password'])]);
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with('success', __('Password has been Updated Successfully.'));
            }
        }
    }
    /**
     * Display the profile view for the current user.
     *
     * This method returns the view for the admin user profile page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showProfile()
    {
        return view('admin.auth.profile');
    }
    /**
     * Update the current user's profile information.
     *
     * This method validates the request data for the current user's profile
     * information, updates the user in the database, and returns a JSON response
     * indicating whether the update was successful.
     *
     * @param \Illuminate\Http\Request $request The request containing the user's profile information.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating if the update was successful.
     */
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'logo' => 'mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }
        $user = User::find(Auth::id());
        $image = $user->image;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            try {
                if ($image && File::exists(public_path($image))) {
                    File::delete(public_path($image));
                }
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/logo/'), $filename);
                $image = 'uploads/logo/' . $filename;
            } catch (\Exception $e) {
                return back()->with('error', 'Could not upload your file: ' . $e->getMessage());
            }
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $image,
        ]);
        return redirect(route('dashboard'))->with('success', __('Profile Updated Successfully'));
    }
}
