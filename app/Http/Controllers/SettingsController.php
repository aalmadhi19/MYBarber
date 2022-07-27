<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::all();
        return view('admin.settings', compact('settings'));
    }

    public function changeStatus($id, Request $request)
    {
        $settings = Settings::findOrfail($id);
        $settings->status = !$request->status;
        $settings->update();
        return redirect(route('settings'));
    }
}
