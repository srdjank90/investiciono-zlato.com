<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller

{
    protected $theme = 'gold';

    public function __construct()
    {
        $this->theme = getOption('setting_theme_active_opt', 'gold');
    }


    public function sendContactForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // For demonstration, we'll use Laravel's built-in email
        Mail::send('frontend.themes.' . $this->theme . '.emails.contact', ['request' => $request], function ($message) use ($request) {
            $message->from($request->email, $request->name);
            $message->to('srdjank90@gmail.com')->subject('Contact Form Submission');
        });

        // Response
        return response()->json(['message' => 'Poruka je uspešno poslata!']);
    }
}
