<?php

namespace App\Http\Controllers;

use App\Mail\PhishingEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'subject'      => 'required',
            'body'         => 'required',
            'sender_name'  => 'required',
            'sender_email' => 'required|email',
        ]);

        Campaign::create($request->all());

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign created successfully!');
    }

    public function show(Campaign $campaign)
    {
        return view('campaigns.show', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'name'         => 'required',
            'subject'      => 'required',
            'body'         => 'required',
            'sender_name'  => 'required',
            'sender_email' => 'required|email',
        ]);

        $campaign->update($request->all());

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign updated successfully!');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaigns.index')
            ->with('success', 'Campaign deleted!');
    }

    public function send(Campaign $campaign)
    {
        $recipients = $campaign->recipients;

        if($recipients->count() == 0) {
            return redirect()->route('campaigns.show', $campaign)
                ->with('error', 'No recipients added yet!');
        }

        foreach($recipients as $recipient) {
            Mail::to($recipient->email)
                ->send(new PhishingEmail($campaign, $recipient));

            $recipient->update([
                'sent_at' => now(),
            ]);

            sleep(2);
        }

        $campaign->update(['status' => 'active']);

        return redirect()->route('campaigns.show', $campaign)
            ->with('success', 'Campaign launched! Emails sent to ' . $recipients->count() . ' recipients!');
    }
}