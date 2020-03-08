<?php

namespace App\Http\Controllers;

class StaticPagesController extends Controller
{
	public function about_us_index () {
		return view('static/aboutus');
	}

    public function careers_index () {
        return view('static/careers');
    }

    public function privacy_index () {
        return view('static/privacy_policy');
    }

    public function terms_and_conditions_index () {
        return view('static/terms_and_conditions');
    }
}
