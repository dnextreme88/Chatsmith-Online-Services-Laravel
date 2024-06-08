<?php

namespace App\Http\Controllers;

class LeadformController extends Controller
{
    public function chat_account_leadform() {
        return view('pages.leadform-chat-account');
    }

    public function focal_leadform() {
        return view('pages.leadform-focal');
    }

    public function plateiq_leadform() {
        return view('pages.leadform-plateiq');
    }
}
