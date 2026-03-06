<x-app-layout>
    <div class="min-h-screen bg-gray-950 p-8">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('campaigns.index') }}" class="text-gray-400 hover:text-white text-sm mb-4 inline-block">← Back to Campaigns</a>
            <h1 class="text-white text-3xl font-bold" style="font-family: Syne, sans-serif;">{{ $campaign->name }}</h1>
            <p class="text-gray-400 mt-1">Campaign Details</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 bg-opacity-10 border border-green-500 rounded-xl p-4 mb-6">
                <p class="text-green-400">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 bg-opacity-10 border border-red-500 rounded-xl p-4 mb-6">
                <p class="text-red-400">{{ session('error') }}</p>
            </div>    
        @endif

        <div class="grid grid-cols-2 gap-6">

            <!-- Left: Campaign Details -->
            <div>
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 mb-6">

                    <div class="mb-4">
                        <p class="text-gray-400 text-sm mb-1">Status</p>
                        <span class="px-3 py-1 rounded-full text-xs
                            @if($campaign->status == 'active') bg-green-500 bg-opacity-20 text-green-400
                            @elseif($campaign->status == 'completed') bg-blue-500 bg-opacity-20 text-blue-400
                            @else bg-gray-500 bg-opacity-20 text-gray-400
                            @endif">
                            {{ ucfirst($campaign->status) }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-400 text-sm mb-1">Sender</p>
                        <p class="text-white">{{ $campaign->sender_name }} &lt;{{ $campaign->sender_email }}&gt;</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-400 text-sm mb-1">Email Subject</p>
                        <p class="text-white">{{ $campaign->subject }}</p>
                    </div>

                    <div class="mb-6">
                        <p class="text-gray-400 text-sm mb-1">Email Body</p>
                        <div class="bg-gray-800 rounded-xl p-4 text-white text-sm whitespace-pre-wrap">{{ $campaign->body }}</div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-4">
                      <a href="{{ route('campaigns.edit', $campaign) }}"
                          class="bg-yellow-600 hover:bg-yellow-500 text-white font-bold px-6 py-3 rounded-xl transition duration-200"
                          style="font-family: Syne, sans-serif;">
                          Edit
                      </a>
                      <form method="POST" action="{{ route('campaigns.send', $campaign) }}">
                          @csrf
                          <button type="submit"
                              onclick="return confirm('Launch this campaign and send all emails?')"
                              class="bg-green-600 hover:bg-green-500 text-white font-bold px-6 py-3 rounded-xl transition duration-200"
                              style="font-family: Syne, sans-serif;">
                              🚀 Launch Campaign
                          </button>
                      </form>
                      <form method="POST" action="{{ route('campaigns.destroy', $campaign) }}">
                          @csrf
                          @method('DELETE')
                          <button type="submit"
                              onclick="return confirm('Delete this campaign?')"
                              class="bg-red-600 hover:bg-red-500 text-white font-bold px-6 py-3 rounded-xl transition duration-200"
                              style="font-family: Syne, sans-serif;">
                              Delete
                          </button>
                      </form>
                  </div>
                </div>
            </div>

            <!-- Right: Recipients -->
            <div>

                <!-- Add Recipient Form -->
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                    <h2 class="text-white font-bold text-xl mb-4" style="font-family: Syne, sans-serif;">Add Recipient</h2>

                    <form method="POST" action="{{ route('recipients.store', $campaign) }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm mb-2">Name</label>
                            <input type="text" name="name"
                                placeholder="John Smith"
                                class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-blue-500"/>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm mb-2">Email</label>
                            <input type="email" name="email"
                                placeholder="john@company.com"
                                class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-blue-500"/>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition duration-200"
                            style="font-family: Syne, sans-serif;">
                            Add Recipient
                        </button>
                    </form>
                </div>

                <!-- Recipients List -->
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6">
                    <h2 class="text-white font-bold text-xl mb-4" style="font-family: Syne, sans-serif;">
                        Recipients ({{ $campaign->recipients->count() }})
                    </h2>

                    @forelse($campaign->recipients as $recipient)
                        <div class="flex items-center justify-between py-3 border-b border-gray-800">
                            <div>
                                <p class="text-white text-sm">{{ $recipient->name }}</p>
                                <p class="text-gray-400 text-xs">{{ $recipient->email }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                @if($recipient->clicked_at)
                                    <span class="text-xs text-red-400">Clicked ⚠️</span>
                                @elseif($recipient->sent_at)
                                    <span class="text-xs text-yellow-400">Sent ✉️</span>
                                @else
                                    <span class="text-xs text-gray-600">Not sent</span>
                                @endif
                                <form method="POST" action="{{ route('recipients.destroy', $recipient) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 text-xs">Remove</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 text-sm text-center py-4">No recipients yet</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>