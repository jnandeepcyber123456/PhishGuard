<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track($token)
    {
        // Find the recipient by their unique token
        $recipient = Recipient::where('token', $token)->first();

        // If token doesn't exist show 404
        if (!$recipient) {
            abort(404);
        }

        // Record the click if not already clicked
        if (!$recipient->clicked_at) {
            $recipient->update([
                'clicked_at' => now(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }

        // Show awareness page
        return view('tracking.awareness', compact('recipient'));
    }
}