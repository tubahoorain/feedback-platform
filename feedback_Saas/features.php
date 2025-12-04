<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedbackSaaS - Features</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .blob { position: absolute; filter: blur(40px); z-index: -1; opacity: 0.5; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen">

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="index.php" class="flex items-center cursor-pointer">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center mr-2 text-white font-bold text-xl">F</div>
                    <span class="text-xl font-bold text-gray-900 tracking-tight">Feedback<span class="text-indigo-600">SaaS</span></span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Home</a>
                    <a href="features.php" class="text-sm font-medium text-indigo-600 transition-colors">Features</a>
                    <a href="pricing.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Pricing</a>
                    <a href="contact.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Contact</a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <button onclick="window.location.href='index.php'" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium">Login</button>
                    <button onclick="window.location.href='index.php'" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Get Started</button>
                </div>

                <div class="md:hidden flex items-center">
                    <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="text-gray-600 hover:text-gray-900 p-2">
                        <i data-lucide="menu"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100 py-4 px-4 space-y-4 shadow-lg absolute w-full">
            <a href="index.php" class="block w-full text-left py-2 font-medium text-gray-600">Home</a>
            <a href="features.php" class="block w-full text-left py-2 font-medium text-indigo-600">Features</a>
            <a href="pricing.php" class="block w-full text-left py-2 font-medium text-gray-600">Pricing</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="relative overflow-hidden bg-white pt-20 pb-32">
        <div class="absolute top-0 right-0 -z-10 translate-x-1/3 -translate-y-1/4">
            <div class="h-96 w-96 rounded-full bg-indigo-50 blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-600 text-xs font-semibold uppercase tracking-wide mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span> Platform Overview
            </div>
            <h1 class="text-5xl md:text-6xl font-bold text-slate-900 mb-6 tracking-tight">
                Everything you need to <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Understand Your Customers</span>
            </h1>
            <p class="text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed">
                From emotive reactions to detailed star ratings, our dual-module system adapts to your business needs perfectly.
            </p>
        </div>
    </header>

    <!-- Feature 1: DUAL MODULES -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                
                <!-- Content -->
                <div class="flex-1 space-y-8">
                    <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600">
                        <i data-lucide="layers" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-4xl font-bold text-slate-900">Two Modes, Infinite Possibilities.</h2>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        Different businesses need different feedback styles. We give you the power to switch instantly.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="mt-1"><div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600"><i data-lucide="star" class="w-4 h-4"></i></div></div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Star Rating Module</h3>
                                <p class="text-slate-500 mt-1">Perfect for services requiring precision. Customers rate from 1 to 5 stars, ideal for hotels, restaurants, and professional services.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="mt-1"><div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-600"><i data-lucide="smile" class="w-4 h-4"></i></div></div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Emoji Reaction Module</h3>
                                <p class="text-slate-500 mt-1">Best for high-volume, quick sentiment capture. Capture "Angry" to "Amazing" emotions instantly in cafeterias or washrooms.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual -->
                <div class="flex-1 relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-3xl transform rotate-3 opacity-20 blur-xl"></div>
                    <div class="bg-white border border-slate-100 p-8 rounded-3xl shadow-2xl relative z-10 animate-float">
                        <!-- Simulated Toggle -->
                        <div class="flex justify-center mb-8">
                            <div class="bg-slate-100 p-1 rounded-lg flex gap-1">
                                <span class="px-4 py-1.5 bg-white shadow-sm rounded-md text-sm font-semibold text-slate-800">Stars</span>
                                <span class="px-4 py-1.5 text-sm font-medium text-slate-500">Emojis</span>
                            </div>
                        </div>
                        <!-- Star Visual -->
                        <div class="flex justify-center gap-2 mb-4 text-yellow-400">
                            <i data-lucide="star" class="w-10 h-10 fill-current"></i>
                            <i data-lucide="star" class="w-10 h-10 fill-current"></i>
                            <i data-lucide="star" class="w-10 h-10 fill-current"></i>
                            <i data-lucide="star" class="w-10 h-10 fill-current"></i>
                            <i data-lucide="star" class="w-10 h-10 text-gray-200"></i>
                        </div>
                        <div class="text-center text-slate-400 text-sm">4.0 Average Rating</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Feature 2: SMART PARAMETERS -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row-reverse items-center gap-20">
                
                <div class="flex-1 space-y-8">
                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600">
                        <i data-lucide="tags" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-4xl font-bold text-slate-900">Smart Parameter Analysis</h2>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        Don't just know <i>that</i> they are unhappy, know <i>why</i>. Our dynamic tag system adapts based on the rating.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 mt-0.5"></i>
                            <div>
                                <span class="font-bold text-slate-800">Dynamic Context</span>
                                <p class="text-slate-500 text-sm">If a user rates low, we ask "What went wrong?". If high, "What did you like?".</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 mt-0.5"></i>
                            <div>
                                <span class="font-bold text-slate-800">Custom Tags</span>
                                <p class="text-slate-500 text-sm">Create your own tags like 'Food', 'Service', 'Ambiance' directly from the dashboard.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="flex-1">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100">
                            <div class="text-xs font-bold text-red-500 uppercase mb-2">Negative Trigger</div>
                            <div class="text-lg font-semibold mb-3">What went wrong?</div>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-red-50 text-red-600 text-xs rounded-full border border-red-100">Slow Service</span>
                                <span class="px-3 py-1 bg-red-50 text-red-600 text-xs rounded-full border border-red-100">Cold Food</span>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100 mt-8">
                            <div class="text-xs font-bold text-green-500 uppercase mb-2">Positive Trigger</div>
                            <div class="text-lg font-semibold mb-3">What did you like?</div>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-green-50 text-green-600 text-xs rounded-full border border-green-100">Tasty Food</span>
                                <span class="px-3 py-1 bg-green-50 text-green-600 text-xs rounded-full border border-green-100">Great Staff</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Feature 3: CUSTOMIZATION -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center mb-16">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Complete Brand Customization</h2>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">Your customers should see <i>your</i> brand, not ours. Customize every pixel of the feedback form.</p>
        </div>

        <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-8 px-6">
            <!-- Brand Color -->
            <div class="group p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-xl transition-all duration-300">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="palette" class="w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Brand Colors</h3>
                <p class="text-slate-500">Pick any HEX code to match your brand identity. The entire form adapts to your color scheme instantly.</p>
            </div>

            <!-- Logo -->
            <div class="group p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-xl transition-all duration-300">
                <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="image" class="w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Custom Logo</h3>
                <p class="text-slate-500">Upload your company logo. It appears centrally on the feedback form, reinforcing brand trust.</p>
            </div>

            <!-- Live Preview -->
            <div class="group p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-xl transition-all duration-300">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="eye" class="w-7 h-7"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Live Preview</h3>
                <p class="text-slate-500">See changes in real-time. Our 'View Live Form' button lets you test the customer experience instantly.</p>
            </div>
        </div>
    </section>

    <!-- Admin & Security -->
    <section class="py-24 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="flex-1">
                    <h2 class="text-3xl font-bold mb-6">Enterprise-Grade Control</h2>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="mt-1 bg-white/10 p-2 rounded-lg"><i data-lucide="shield-check" class="w-6 h-6 text-emerald-400"></i></div>
                            <div>
                                <h3 class="text-xl font-semibold">Superadmin Approval</h3>
                                <p class="text-slate-400 mt-1">Every company registration is vetted. Accounts remain 'Pending' until approved by the Superadmin for security.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="mt-1 bg-white/10 p-2 rounded-lg"><i data-lucide="lock" class="w-6 h-6 text-blue-400"></i></div>
                            <div>
                                <h3 class="text-xl font-semibold">Secure Data Isolation</h3>
                                <p class="text-slate-400 mt-1">Multi-tenant architecture ensures your data is strictly isolated. You only see feedback meant for your company.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-sm">
                    <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-4">
                        <span class="text-sm font-mono text-slate-400">ADMIN PANEL</span>
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="h-12 bg-white/10 rounded-lg w-full"></div>
                        <div class="h-32 bg-white/10 rounded-lg w-full"></div>
                        <div class="flex gap-4">
                            <div class="h-20 bg-white/10 rounded-lg w-1/2"></div>
                            <div class="h-20 bg-white/10 rounded-lg w-1/2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600 text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to upgrade your customer experience?</h2>
            <p class="text-indigo-100 text-lg mb-10">Join hundreds of businesses using our dual-module system today.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="window.location.href='index.php'" class="px-8 py-4 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-colors shadow-lg">
                    Get Started Free
                </button>
                <button onclick="window.location.href='contact.php'" class="px-8 py-4 bg-indigo-700 text-white font-bold rounded-xl hover:bg-indigo-800 transition-colors border border-indigo-500">
                    Contact Sales
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex items-center justify-center mb-4">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center mr-2 text-white font-bold text-xl">F</div>
                <span class="text-xl font-bold text-slate-900">FeedbackSaaS</span>
            </div>
            <p class="text-slate-500 text-sm">© 2024 FeedbackSaaS Platform. All rights reserved.</p>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>