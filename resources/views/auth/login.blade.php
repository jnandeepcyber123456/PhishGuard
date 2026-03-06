<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
             <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
             <title>Phishguard - Login</title>
     <script src="https://cdn.tailwindcss.com"></script>
     <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet"/>
    </head>
    <body>
        <div class="min-h-screen bg-gray-950 flex items-center justify-center">
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 w-full max-w-md">
                <div class="flex flex-col items-center mb-8">
                    <div class="bg-blue-500 rounded-2xl p-3 mb-4">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2L3 6v6c0 5.25 3.75 10.15 9 11.25C17.25 22.15 21 17.25 21 12V6L12 2z" stroke="white" stroke-width="1.5"/>
                            <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h1 class="text-white text-2xl font-bold" style="font-family: Syne, sans-serif;">PhishGuard</h1>
                    <p class="text-gray-400 text-sm mt-1">Sign in to your console</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @if ($errors->any())
                    <div class="bg-redd-500 bg-opacity-10 border border-red-500 rounded-xl p-3 mb-4">
                        <p class="text-red-400 text-sm">{{ $errors->first() }}</p>
                    </div>
                    @endif    
                <div class="mb-4">
                    <label class="block text-gray-400 text-sm mb-2">Email Address </label>
                    <input
                    type="email"
                    name="email"
                    placeholder="admin@company.com"
                    class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-blue-500"
                    />
                </div>  
                <div class="mb-6">
                    <label class="block text-gray-400 text-sm mb-2">Password</label>
                    <input
                    type="password"
                    name="password"
                    placeholder="**********"
                    class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-blue-500"
                    />
                </div>
                <button 
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition duration-200"
                style="font-family: Syne, sans-serif;">
                Sign in to your console
                </button>  
                </form>   
            </div>
        </div>
    </body>
</html>    