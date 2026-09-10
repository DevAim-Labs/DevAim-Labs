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
        ], [
            'name.required'    => 'Vul je naam in.',
            'email.required'   => 'Vul je e-mailadres in.',
            'email.email'      => 'Vul een geldig e-mailadres in.',
            'message.required' => 'Schrijf een bericht.',
            'message.min'      => 'Je bericht moet minimaal 20 tekens bevatten.',
            'message.max'      => 'Je bericht mag maximaal 2000 tekens bevatten.',
        ]);

        // TODO: Re-enable database storage when Supabase is configured
        // ContactSubmission::create($validated + [
        //     'ip_address' => $request->ip(),
        //     'user_agent' => $request->userAgent(),
        // ]);

        // No queue worker runs in production, so respond to the browser
        // immediately and only then do the slow SMTP send — otherwise the
        // visitor sits waiting for the full mail round-trip.
        $response = response()->json(['message' => 'Verzonden.'], 200);
        $response->send();
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        try {
            Mail::to(config('mail.from.address'))
                ->send(new ContactFormSubmission($validated));
        } catch (\Throwable $e) {
            report($e);
        }

        return $response;
    }
}
