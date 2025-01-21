<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    /**
     * Display admin profile details.
     */
    public function profile()
    {
        return view("dashboard.pages.admin-profile.profile");
    }


    /**
     * Update admin profile.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }


    /**
     * Update admin password.
     */
    public function update_password(Request $request, Admin $admin)
    {
        //
    }


}
