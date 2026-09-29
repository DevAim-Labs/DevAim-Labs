<?php

namespace App\Http\Controllers;

use App\Support\LeadIntake;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * POST /contact (rate limiter "contact", see AppServiceProvider): the HTTP
 * adapter of LeadIntake. Invalid input answers 422 through the framework's
 * ValidationException handling.
 */
class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        ['status' => $status, 'message' => $message] = LeadIntake::submit($request->all());

        return response()->json(['message' => $message], $status);
    }
}
