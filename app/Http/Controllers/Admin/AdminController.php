<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Jobs\SendAdminRestPasswordJob;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        return view("dashboard.pages.admins.index", compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.pages.admins.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdminRequest $request)
    {
        $admin = $request->validated();
        $admin["password"] = Hash::make("");
        Admin::create($admin);
        SendAdminRestPasswordJob::dispatch(['email' => $admin['email']]);
        
        return back()->with("addingSuccessfully", "The Admin was added successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view("dashboard.pages.admins.show", ["admin" => $admin]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->update(["status" => "inactive"]);
        $admin->delete();
        return to_route("admin.index");
    }
}
