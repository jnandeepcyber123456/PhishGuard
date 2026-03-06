<x-app-layout>
    <div class="min-h-screen bg-gray-950 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-white text-3xl font-bold" style="font-family: Syne, sans-serif;">Campaigns</h1>
                <p class="text-gray-400 mt-1">Manage your phishing simulations</p>
            </div>
            <a href="{{ route('campaigns.create') }}" 
               class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-xl transition duration-200"
               style="font-family: Syne, sans-serif;">
                + New Campaign
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 bg-opacity-10 border border-green-500 rounded-xl p-4 mb-6">
                <p class="text-green-400">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Campaigns Table -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
            <table class="w-full">
                <thead>
                    <tr class="text-gray-400 text-sm border-b border-gray-800">
                        <th class="text-left pb-3">Campaign Name</th>
                        <th class="text-left pb-3">Sender</th>
                        <th class="text-left pb-3">Status</th>
                        <th class="text-left pb-3">Created</th>
                        <th class="text-left pb-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($campaigns as $campaign)
                        <tr class="border-b border-gray-800 text-sm">
                            <td class="py-4 text-white">{{ $campaign->name }}</td>
                            <td class="py-4 text-gray-400">{{ $campaign->sender_name }}</td>
                            <td class="py-4">
                                <span class="px-3 py-1 rounded-full text-xs
                                    @if($campaign->status == 'active') bg-green-500 bg-opacity-20 text-green-400
                                    @elseif($campaign->status == 'completed') bg-blue-500 bg-opacity-20 text-blue-400
                                    @else bg-gray-500 bg-opacity-20 text-gray-400
                                    @endif">
                                    {{ ucfirst($campaign->status) }}
                                </span>
                            </td>
                            <td class="py-4 text-gray-400">{{ $campaign->created_at->diffForHumans() }}</td>
                            <td class="py-4">
                                <a href="{{ route('campaigns.show', $campaign) }}" class="text-blue-400 hover:text-blue-300 mr-3">View</a>
                                <a href="{{ route('campaigns.edit', $campaign) }}" class="text-yellow-400 hover:text-yellow-300 mr-3">Edit</a>
                                <form method="POST" action="{{ route('campaigns.destroy', $campaign) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Delete this campaign?')">Delete</button>
                                </form>
                            </td>
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