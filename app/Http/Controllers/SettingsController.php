<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = Settings::all();
        $statusText = Settings::statusText();
        $workingHours = Settings::where('id', 2)->pluck('data');
        $explode_id = json_decode($workingHours, true);
        return view('admin.settings', compact('settings', 'statusText', 'workingHours'));
    }

    public function changeStatus($id, Request $request)
    {
        $settings = Settings::findOrfail($id);
        if ($request->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $settings->status = $status;
        $settings->update();
        return redirect(route('settings'));
    }

    public function changeHours(Request $request)
    {
        $settings = Settings::findOrfail(2);
        $settings->data = $request->hours;
        $settings->update();
        return redirect(route('settings'));
    }
}
