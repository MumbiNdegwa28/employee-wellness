<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.home');
    }

    /**
     * Display the user records.
     *
     * @return \Illuminate\View\View
     */
    public function viewUserRecords()
    {
        // Fetch user records logic here
        return view('admin.view-user-records'); 
    }

    /**
     * Display the manage user permissions page.
     *
     * @return \Illuminate\View\View
     */
    public function manageUserPermissions()
    {
        // Fetch user permissions logic here
        return view('admin.manage-user-permissions'); 
    }
}
