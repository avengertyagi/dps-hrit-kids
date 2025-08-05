<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Display the settings page view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module_data = Setting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('module_data'));
    }
    /**
     * Update the application settings.
     *
     * This method validates the incoming request for settings data, then updates
     * the respective settings in the database or creates them if they do not exist. 
     * After updating, it redirects back with a success message.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);
        foreach ($request->only(['address', 'phone', 'email', 'facebook', 'youtube']) as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        return redirect()->back()->with('success', 'Settings Updated Successfully.');
    }
}
