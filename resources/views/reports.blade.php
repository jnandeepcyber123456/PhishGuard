<x-app-layout>
    <div class="min-h-screen bg-gray-950 p-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-white text-3xl font-bold" style="font-family: Syne, sans-serif;">Reports</h1>
            <p class="text-gray-400 mt-1">Campaign performance overview</p>
        </div>

        <!-- Campaign Reports -->
        @forelse($campaigns as $campaign)
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">

                <!-- Campaign Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-white font-bold text-xl" style="font-family: Syne, sans-serif;">{{ $campaign->name }}</h2>
                        <p class="text-gray-400 text-sm mt-1">{{ $campaign->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs
                        @if($campaign->status == 'active') bg-green-500 bg-opacity-20 text-green-400
                        @elseif($campaign->status == 'completed') bg-blue-500 bg-opacity-20 text-blue-400
                        @else bg-gray-500 bg-opacity-20 text-gray-400
                        @endif">
                        {{ ucfirst($campaign->status) }}
                    </span>
                </div>

                <!-- Stats Row -->
                @php
                    $total   = $campaign->recipients->count();
                    $sent    = $campaign->recipients->whereNotNull('sent_at')->count();
                    $clicked = $campaign->recipients->whereNotNull('clicked_at')->count();
                    $rate    = $sent > 0 ? round(($clicked / $sent) * 100) : 0;
                @endphp

                <div class="grid grid-cols-4 gap-4 mb-6">
                    <div class="bg-gray-800 rounded-xl p-4 text-center">
                        <p class="text-gray-400 text-xs mb-1">Total Recipients</p>
                        <p class="text-white text-2xl font-bold">{{ $total }}</p>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-4 text-center">
                        <p class="text-gray-400 text-xs mb-1">Emails Sent</p>
                        <p class="text-blue-400 text-2xl font-bold">{{ $sent }}</p>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-4 text-center">
                        <p class="text-gray-400 text-xs mb-1">Links Clicked</p>
                        <p class="text-yellow-400 text-2xl font-bold">{{ $clicked }}</p>
                    </div>
                    <div class="bg-gray-800 rounded-xl p-4 text-center">
                        <p class="text-gray-400 text-xs mb-1">Click Rate</p>
                        <p class="text-red-400 text-2xl font-bold">{{ $rate }}%</p>
                    </div>
                </div>

                <!-- Recipients Table -->
                <table class="w-full">
                    <thead>
                        <tr class="text-gray-400 text-xs border-b border-gray-800">
                            <th class="text-left pb-3">Name</th>
                            <th class="text-left pb-3">Email</th>
                            <th class="text-left pb-3">Sent At</th>
                            <th class="text-left pb-3">Clicked At</th>
                            <th class="text-left pb-3">IP Address</th>
                            <th class="text-left pb-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($campaign->recipients as $recipient)
                            <tr class="border-b border-gray-800 text-sm">
                                <td class="py-3 text-white">{{ $recipient->name }}</td>
                                <td class="py-3 text-gray-400">{{ $recipient->email }}</td>
                                <td class="py-3 text-gray-400">{{ $recipient->sent_at ? \Carbon\Carbon::parse($recipient->sent_at)->diffForHumans() : '—' }}</td>
                                <td class="py-3 text-gray-400">{{ $recipient->clicked_at ? \Carbon\Carbon::parse($recipient->clicked_at)->diffForHumans() : '—' }}</td>
                                <td class="py-3 text-gray-400">{{ $recipient->ip_address ?? '—' }}</td>
                                <td class="py-3">
                                    @if($recipient->clicked_at)
                                        <span class="px-2 py-1 rounded-full text-xs bg-red-500 bg-opacity-20 text-red-400">Clicked ⚠️</span>
                                    @elseif($recipient->sent_at)
                                        <span class="px-2 py-1 rounded-full text-xs bg-yellow-500 bg-opacity-20 text-yellow-400">Sent ✉️</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full text-xs bg-gray-500 bg-opacity-20 text-gray-400">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @empty
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-12 text-center">
                <p class="text-gray-600">No campaigns yet. Create your first one!</p>
            </div>
        @endforelse

    </div>
</x-app-layout>