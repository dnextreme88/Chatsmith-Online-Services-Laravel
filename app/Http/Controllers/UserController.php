<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // The user must be logged in to access the views
    public function __construct() {
        $this->middleware('auth');
    }

    public function index () {
        $user = Auth::user();
        $users = User::paginate(5);

        if ($user->is_staff == 'True') {
            return view('users')->with('users', $users);
        } else {
            abort(403, 'Forbidden page.');
        }
    }
}
