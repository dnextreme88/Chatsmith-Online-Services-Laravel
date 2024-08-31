<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // The user must be logged in to access the views
    public function __construct() {
        $this->middleware('auth');
    }

    public function show ($id) {
        // Show specific employee
        $employee = Employee::find($id);
        $user = Auth::user();

        return view('show_employee', [
            'employee' => $employee,
            'user' => $user
        ]);
    }
}
