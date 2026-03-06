<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecipientController extends Controller
{
    public function store(Request $request, Campaign $campaign)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        Recipient::create([
            'campaign_id' => $campaign->id,
            'name'        => $request->name,
            'email'       => $request->email,
            'token'       => Str::uuid(),
        ]);

        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'Recipient added successfully!');
    }

    public function destroy(Recipient $recipient)
    {
        $campaign = $recipient->campaign;
        $recipient->delete();

        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'Recipient removed!');
    }
}