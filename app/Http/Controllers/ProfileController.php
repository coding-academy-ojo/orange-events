<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FileProcessing;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view("dashboard.pages.admin-profile.profile");
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('admin')->fill($request->validated());

        // if ($request->user('admin')->isDirty('email')) {
        //     $request->user('admin')->email_verified_at = null;
        // }

        if ($request->hasFile('image')){
            
            $path = "admins/" . Auth::guard('admin')->user()->id;
            $image_name = FileProcessing::file_processing($request->image, $path);

            Auth::guard('admin')->user()->image = $image_name;
            Auth::guard('admin')->user()->image_path = $path;
            // Auth::guard('admin')->save;
        }



        $request->user('admin')->save();
        
        return Redirect::route('admin.profile')->with('status', 'Your profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
