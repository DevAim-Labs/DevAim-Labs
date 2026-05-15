<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:20', 'max:2000'],
        ]);

        Mail::to(config('mail.from.address'))
            ->send(new ContactFormSubmission($validated));

        return response()->json(['message' => 'Sent.'], 200);
    }
}
