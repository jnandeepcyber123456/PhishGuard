<x-app-layout>
    <div class="min-h-screen bg-gray-950 p-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-white text-3xl font-bold" style="font-family: Syne, sans-serif;">PhishGuard Console</h1>
            <p class="text-gray-400 mt-1">Welcome back, {{ auth()->user()->name }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
                <p class="text-gray-400 text-sm mb-2">Total Campaigns</p>
                <p class="text-white text-3xl font-bold">{{ $totalCampaigns }}</p>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
                <p class="text-gray-400 text-sm mb-2">Emails Sent</p>
                <p class="text-blue-400 text-3xl font-bold">{{ $totalSent }}</p>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
                <p class="text-gray-400 text-sm mb-2">Links Clicked</p>
                <p class="text-yellow-400 text-3xl font-bold">{{ $totalClicked }}</p>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
                <p class="text-gray-400 text-sm mb-2">Click Rate</p>
                <p class="text-red-400 text-3xl font-bold">{{ $clickRate }}%</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <a href="{{ route('campaigns.create') }}" class="bg-blue-600 hover:bg-blue-500 rounded-2xl p-6 transition duration-200">
                <p class="text-white font-bold text-lg" style="font-family: Syne, sans-serif;">New Campaign</p>
                <p class="text-blue-200 text-sm mt-1">Create a phishing simulation</p>
            </a>
            <a href="{{ route('campaigns.index') }}" class="bg-gray-900 border border-gray-800 hover:border-gray-600 rounded-2xl p-6 transition duration-200">
                <p class="text-white font-bold text-lg" style="font-family: Syne, sans-serif;">All Campaigns</p>
                <p class="text-gray-400 text-sm mt-1">Manage your campaigns</p>
            </a>
            <a href="{{ route('reports') }}" class="bg-gray-900 border border-gray-800 hover:border-gray-600 rounded-2xl p-6 transition duration-200">
                <p class="text-white font-bold text-lg" style="font-family: Syne, sans-serif;">View Reports</p>
                <p class="text-gray-400 text-sm mt-1">See campaign results</p>
            </a>
        </div>

        <!-- Recent Campaigns -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <h2 class="text-white font-bold text-xl mb-4" style="font-family: Syne, sans-serif;">Recent Campaigns</h2>
            <table class="w-full">
                <thead>
                    <tr class="text-gray-400 text-sm border-b border-gray-800">
                        <th class="text-left pb-3">Campaign Name</th>
                        <th class="text-left pb-3">Status</th>
                        <th class="text-left pb-3">Sent</th>
                        <th class="text-left pb-3">Clicked</th>
                        <th class="text-left pb-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentCampaigns as $campaign)
                        <tr class="border-b border-gray-800 text-sm">
                            <td class="py-4 text-white">
                                <a href="{{ route('campaigns.show', $campaign) }}" class="hover:text-blue-400">
                                    {{ $campaign->name }}
                                </a>
                            </td>
                            <td class="py-4">
                                <span class="px-3 py-1 rounded-full text-xs
                                    @if($campaign->status == 'active') bg-green-500 bg-opacity-20 text-green-400
                                    @elseif($campaign->status == 'completed') bg-blue-500 bg-opacity-20 text-blue-400
                                    @else bg-gray-500 bg-opacity-20 text-gray-400
                                    @endif">
                                    {{ ucfirst($campaign->status) }}
                                </span>
                            </td>
                            <td class="py-4 text-gray-400">{{ $campaign->recipients->whereNotNull('sent_at')->count() }}</td>
                            <td class="py-4 text-yellow-400">{{ $campaign->recipients->whereNotNull('clicked_at')->count() }}</td>
                            <td class="py-4 text-gray-400">{{ $campaign->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-gray-600 text-sm py-8 text-center">
                                No campaigns yet. Create your first one!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>