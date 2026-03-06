<x-app-layout>
    <div class="min-h-screen bg-gray-950 p-8">

        <div class="mb-8">
            <a href="{{ route('campaigns.index') }}" class="text-gray-400 hover:text-white text-sm mb-4 inline-block">← Back to Campaigns</a>
            <h1 class="text-white text-3xl font-bold" style="font-family: Syne, sans-serif;">Edit Campaign</h1>
            <p class="text-gray-400 mt-1">Update your phishing simulation</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 max-w-2xl">

            @if($errors->any())
                <div class="bg-red-500 bg-opacity-10 border border-red-500 rounded-xl p-4 mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-red-400 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('campaigns.update', $campaign) }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm mb-2">Campaign Name</label>
                    <input type="text" name="name" value="{{ $campaign->name }}"
                        class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500"/>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm mb-2">Sender Name</label>
                    <input type="text" name="sender_name" value="{{ $campaign->sender_name }}"
                        class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500"/>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm mb-2">Sender Email</label>
                    <input type="email" name="sender_email" value="{{ $campaign->sender_email }}"
                        class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500"/>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm mb-2">Email Subject</label>
                    <input type="text" name="subject" value="{{ $campaign->subject }}"
                        class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500"/>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-400 text-sm mb-2">Email Body</label>
                    <textarea name="body" rows="6"
                        class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500">{{ $campaign->body }}</textarea>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition duration-200"
                    style="font-family: Syne, sans-serif;">
                    Update Campaign
                </button>

            </form>
        </div>
    </div>
</x-app-layout>