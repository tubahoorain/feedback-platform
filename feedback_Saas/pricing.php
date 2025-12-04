<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedbackSaaS - Pricing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-white text-gray-900 flex flex-col min-h-screen">

    <!-- Nav -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="index.php" class="flex items-center cursor-pointer">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center mr-2 text-white font-bold text-xl">F</div>
                    <span class="text-xl font-bold text-gray-900 tracking-tight">Feedback<span class="text-indigo-600">SaaS</span></span>
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Home</a>
                    <a href="features.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Features</a>
                    <a href="pricing.php" class="text-sm font-medium text-indigo-600 transition-colors">Pricing</a>
                    <a href="contact.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Contact</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                     <a href="index.php" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium">Login</a>
                     <a href="index.php" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Get Started</a>
                </div>
                 <div class="md:hidden flex items-center">
                    <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="text-gray-600 hover:text-gray-900 p-2"><i data-lucide="menu"></i></button>
                </div>
            </div>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100 py-4 px-4 space-y-4 shadow-lg absolute w-full">
            <a href="index.php" class="block w-full text-left py-2 font-medium text-gray-600">Home</a>
            <a href="features.php" class="block w-full text-left py-2 font-medium text-gray-600">Features</a>
            <a href="pricing.php" class="block w-full text-left py-2 font-medium text-gray-600">Pricing</a>
            <a href="contact.php" class="block w-full text-left py-2 font-medium text-gray-600">Contact</a>
        </div>
    </nav>

    <main class="flex-1">
        <div class="bg-indigo-900 text-white py-20 px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Simple, Transparent Pricing</h1>
            <p class="text-indigo-200 text-xl max-w-2xl mx-auto">Choose the plan that fits your business size. No hidden fees.</p>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-24">
            <div class="grid md:grid-cols-3 gap-8 mb-24">
                <!-- Basic -->
                <div class="bg-white p-8 rounded-2xl shadow-lg flex flex-col border border-gray-100">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Startup Starter</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-extrabold text-gray-900">PKR 2,000</span>
                            <span class="text-gray-500">/mo</span>
                        </div>
                        <p class="text-gray-500 mt-4 text-sm">Perfect for startups.</p>
                    </div>
                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> 100 Responses/mo</li>
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> Star Rating Only</li>
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> Basic Analytics</li>
                    </ul>
                    <a href="index.php" class="w-full py-3 text-center border border-indigo-600 text-indigo-600 rounded-lg font-medium hover:bg-indigo-50">Select Starter</a>
                </div>

                <!-- Pro -->
                <div class="bg-white p-8 rounded-2xl shadow-lg flex flex-col border-2 border-indigo-500 ring-8 ring-indigo-500/10 relative transform md:-translate-y-4">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-indigo-500 text-white px-4 py-1 rounded-full text-sm font-bold tracking-wide">MOST POPULAR</div>
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Business Growth</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-extrabold text-gray-900">PKR 5,000</span>
                            <span class="text-gray-500">/mo</span>
                        </div>
                        <p class="text-gray-500 mt-4 text-sm">Perfect for growing businesses.</p>
                    </div>
                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> Unlimited Responses</li>
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> Stars & Emojis</li>
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> Custom Branding</li>
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> Export to PDF/CSV</li>
                    </ul>
                    <a href="index.php" class="w-full py-3 text-center bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700">Select Growth</a>
                </div>

                <!-- Enterprise -->
                <div class="bg-white p-8 rounded-2xl shadow-lg flex flex-col border border-gray-100">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Institution</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl font-extrabold text-gray-900">PKR 12,000</span>
                            <span class="text-gray-500">/mo</span>
                        </div>
                        <p class="text-gray-500 mt-4 text-sm">Perfect for large organizations.</p>
                    </div>
                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> Dedicated Support</li>
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> Multiple Locations</li>
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> API Access</li>
                        <li class="flex items-start gap-3 text-gray-600"><i data-lucide="check" class="w-5 h-5 text-green-500"></i> White Label</li>
                    </ul>
                    <a href="index.php" class="w-full py-3 text-center border border-indigo-600 text-indigo-600 rounded-lg font-medium hover:bg-indigo-50">Select Institution</a>
                </div>
            </div>

            <!-- FAQ -->
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Frequently Asked Questions</h2>
                <div class="space-y-6">
                    <div class="border border-gray-200 rounded-xl overflow-hidden faq-item">
                        <button class="w-full flex justify-between items-center p-5 text-left bg-white hover:bg-gray-50 transition-colors" onclick="toggleFaq(this)">
                            <span class="font-medium text-gray-900">Can I cancel my subscription anytime?</span>
                            <span>▼</span>
                        </button>
                        <div class="p-5 bg-gray-50 text-gray-600 border-t border-gray-200 text-sm leading-relaxed hidden">
                            Yes, you can cancel your subscription at any time from your company dashboard. Your access will remain active until the end of the billing period.
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-xl overflow-hidden faq-item">
                        <button class="w-full flex justify-between items-center p-5 text-left bg-white hover:bg-gray-50 transition-colors" onclick="toggleFaq(this)">
                            <span class="font-medium text-gray-900">Do you support custom payment methods?</span>
                            <span>▼</span>
                        </button>
                        <div class="p-5 bg-gray-50 text-gray-600 border-t border-gray-200 text-sm leading-relaxed hidden">
                            We currently support Easypaisa, JazzCash, and Direct Bank Transfer. For Enterprise clients, we can arrange invoice-based billing.
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-xl overflow-hidden faq-item">
                        <button class="w-full flex justify-between items-center p-5 text-left bg-white hover:bg-gray-50 transition-colors" onclick="toggleFaq(this)">
                            <span class="font-medium text-gray-900">Is my data secure?</span>
                            <span>▼</span>
                        </button>
                        <div class="p-5 bg-gray-50 text-gray-600 border-t border-gray-200 text-sm leading-relaxed hidden">
                            Absolutely. We use industry-standard encryption for all data in transit and at rest. Your customer data is yours alone.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-6 text-center text-sm">
            <p>© 2024 FeedbackSaaS Platform. All rights reserved.</p>
        </div>
    </footer>

    <script>
        lucide.createIcons();
        function toggleFaq(btn) {
            const content = btn.nextElementSibling;
            content.classList.toggle('hidden');
            const arrow = btn.querySelector('span:last-child');
            arrow.style.transform = content.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    </script>
</body>
</html>
