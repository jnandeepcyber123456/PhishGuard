<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Security Awareness Training</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet"/>
</head>
<body>
    <div class="min-h-screen bg-gray-950 flex items-center justify-center p-8">
        <div class="max-w-2xl w-full">

            <!-- Warning Icon -->
            <div class="flex justify-center mb-8">
                <div class="bg-yellow-500 bg-opacity-20 border border-yellow-500 rounded-full p-6">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M12 9v4M12 17h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke="#EAB308" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            <!-- Main Message -->
            <div class="text-center mb-8">
                <h1 class="text-white text-4xl font-bold mb-4" style="font-family: Syne, sans-serif;">
                    This Was A Phishing Test
                </h1>
                <p class="text-gray-400 text-lg">
                    Hi {{ $recipient->name }}, you clicked a simulated phishing link.
                    Don't worry — this was a safe security awareness test!
                </p>
            </div>

            <!-- What Happened Card -->
            <div class="bg-gray-900 border border-yellow-500 border-opacity-30 rounded-2xl p-8 mb-6">
                <h2 class="text-yellow-400 font-bold text-xl mb-4" style="font-family: Syne, sans-serif;">
                    ⚠️ What Just Happened?
                </h2>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start gap-3">
                        <span class="text-yellow-400 mt-1">→</span>
                        <span>You received a fake phishing email as part of a security training exercise</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-yellow-400 mt-1">→</span>
                        <span>You clicked the suspicious link inside the email</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-yellow-400 mt-1">→</span>
                        <span>In a real attack this could have compromised your account</span>
                    </li>
                </ul>
            </div>

            <!-- How To Spot Phishing -->
            <div class="bg-gray-900 border border-blue-500 border-opacity-30 rounded-2xl p-8 mb-6">
                <h2 class="text-blue-400 font-bold text-xl mb-4" style="font-family: Syne, sans-serif;">
                    🛡️ How To Spot Phishing Emails
                </h2>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start gap-3">
                        <span class="text-green-400 mt-1">✓</span>
                        <span>Check the sender's email address carefully</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-green-400 mt-1">✓</span>
                        <span>Be suspicious of URGENT or threatening language</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-green-400 mt-1">✓</span>
                        <span>Hover over links before clicking to see the real URL</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-green-400 mt-1">✓</span>
                        <span>Never enter your password after clicking an email link</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-green-400 mt-1">✓</span>
                        <span>When in doubt contact your IT department directly</span>
                    </li>
                </ul>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    This test was conducted by your security team using PhishGuard
                </p>
            </div>

        </div>
    </div>
</body>
</html>