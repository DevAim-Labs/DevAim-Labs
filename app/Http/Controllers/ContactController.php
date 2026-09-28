<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormSubmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request): JsonResponse
    {
        $isEn = $request->isEnglish();
        $sent = response()->json(['message' => $isEn ? 'Sent.' : 'Verzonden.'], 200);

        if ($reason = $request->spamReason()) {
            // Silently pretend success so the bot doesn't learn it was caught.
            // Logged without personal data: only why and which form.
            Log::info('Contact form submission blocked', [
                'reason' => $reason,
                'type' => $request->lead()['type'],
            ]);

            return $sent;
        }

        // Mail now goes out via Resend's HTTP API (fast, no blocking SMTP
        // round-trip), so we can wait for the actual result and report a
        // real failure instead of always answering 200.
        try {
            Mail::to(config('mail.from.address'))
                ->send(new ContactFormSubmission($request->lead()));
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'message' => $isEn
                    ? 'Sending failed. Please try again later or email me directly.'
                    : 'Verzenden is mislukt. Probeer het later opnieuw of mail rechtstreeks.',
            ], 500);
        }

        return $sent;
    }
}
