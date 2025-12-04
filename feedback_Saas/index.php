<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedbackSaaS - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .animate-fadeIn { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        /* Selected Payment Style */
        .payment-selected { border-color: #4F46E5 !important; background-color: #EEF2FF !important; ring: 2px solid #4F46E5; }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body class="bg-white text-gray-900">

    <!-- Navigation (No Changes) -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="index.php" class="flex items-center cursor-pointer">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center mr-2 text-white font-bold text-xl">F</div>
                    <span class="text-xl font-bold text-gray-900 tracking-tight">Feedback<span class="text-indigo-600">SaaS</span></span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-sm font-medium text-indigo-600 transition-colors">Home</a>
                    <a href="features.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Features</a>
                    <a href="pricing.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Pricing</a>
                    <a href="contact.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Contact</a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <button onclick="openModal('loginModal')" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium">Login</button>
                    <button onclick="openModal('registerModal')" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Get Started</button>
                </div>

                <div class="md:hidden flex items-center">
                    <button onclick="toggleMobileMenu()" class="text-gray-600 hover:text-gray-900 p-2">
                        <i data-lucide="menu"></i>
                    </button>
                </div>
            </div>
        </div>

        


        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100 py-4 px-4 space-y-4 shadow-lg absolute w-full">
            <a href="index.php" class="block w-full text-left py-2 font-medium text-gray-600">Home</a>
            <button onclick="openModal('loginModal')" class="w-full py-2 border rounded-lg">Login</button>
            <button onclick="openModal('registerModal')" class="w-full py-2 bg-indigo-600 text-white rounded-lg">Get Started</button>
        </div>
    </nav>

    <!-- Content (Hero etc - No Changes) -->
    <header class="relative overflow-hidden bg-white pt-16 pb-32 lg:pt-32 lg:pb-40">
        <div class="absolute top-0 right-0 -z-10 translate-x-1/3 -translate-y-1/4 transform opacity-10">
            <div class="h-[600px] w-[600px] rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 text-center animate-fadeIn">
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 mb-8 leading-tight tracking-tight">
                Feedback that drives <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Real Growth.</span>
            </h1>
            <p class="text-xl text-gray-600 mb-10 max-w-3xl mx-auto leading-relaxed">
                The all-in-one SaaS platform for companies to collect feedback.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="openModal('registerModal')" class="px-8 py-4 bg-indigo-600 text-white text-lg font-medium rounded-lg shadow-xl shadow-indigo-200 hover:bg-indigo-700 flex items-center justify-center gap-2">
                    Start Free Trial <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
                  <a href="features.php" class="px-8 py-4 bg-white text-gray-700 border border-gray-300 text-lg font-medium rounded-lg hover:bg-gray-50 flex items-center justify-center">
                    Explore Features
                </a>
            </div>
        </div>
    </header>

    <!-- Quick Features -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose FeedbackSaaS?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We provide everything you need to listen to your customers and make data-driven decisions.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="flex flex-col items-center text-center group p-6 rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100">
                    <div class="mb-6 p-4 bg-white shadow-sm rounded-2xl group-hover:scale-110 transition-transform duration-300 text-indigo-600 border border-gray-100">
                        <i data-lucide="smartphone" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Mobile-First Feedback</h3>
                    <p class="text-gray-600 leading-relaxed">Customers can submit feedback instantly via QR codes on any device, no app installation required.</p>
                </div>
                <!-- Feature 2 -->
                <div class="flex flex-col items-center text-center group p-6 rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100">
                    <div class="mb-6 p-4 bg-white shadow-sm rounded-2xl group-hover:scale-110 transition-transform duration-300 text-pink-500 border border-gray-100">
                        <i data-lucide="smile" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Expressive Modules</h3>
                    <p class="text-gray-600 leading-relaxed">Capture emotions accurately with our flexible Star ratings and Emoji reaction modules.</p>
                </div>
                <!-- Feature 3 -->
                <div class="flex flex-col items-center text-center group p-6 rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-transparent hover:border-gray-100">
                    <div class="mb-6 p-4 bg-white shadow-sm rounded-2xl group-hover:scale-110 transition-transform duration-300 text-green-600 border border-gray-100">
                        <i data-lucide="bar-chart-3" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Actionable Analytics</h3>
                    <p class="text-gray-600 leading-relaxed">Transform raw feedback into trends, heatmaps, and reports automatically on your dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-indigo-900 text-white text-center px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to transform your customer experience?</h2>
            <p class="text-indigo-200 mb-10 text-lg">Join 500+ companies using FeedbackSaaS to improve their services daily.</p>
            <button onclick="openModal('registerModal')" class="px-8 py-4 bg-white text-indigo-900 text-lg font-medium rounded-lg hover:bg-gray-100">
                Create Your Account
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-1 md:col-span-2">
                <div class="text-2xl font-bold text-white mb-4">FeedbackSaaS</div>
                <p class="text-gray-400 max-w-sm leading-relaxed">Empowering businesses to build better relationships with their customers through honest, real-time feedback.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Platform</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="index.php" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="features.php" class="hover:text-white transition-colors">Features</a></li>
                    <li><a href="pricing.php" class="hover:text-white transition-colors">Pricing</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Support</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="contact.php" class="hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-gray-800 text-center text-sm">
            <p>© 2024 FeedbackSaaS Platform. All rights reserved.</p>
        </div>
    </footer>


    <!-- Login Modal -->
    <div id="loginModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md relative animate-fadeIn">
            <button onclick="closeModal('loginModal')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><i data-lucide="x"></i></button>
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Welcome Back</h2>
            <form id="loginForm" class="space-y-5">
                <input type="hidden" name="action" value="login">
                <div id="loginMessage" class="hidden p-2 text-sm rounded text-center"></div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <button type="submit"  class="w-full py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700">Login</button>
            </form>
        </div>
    </div>

    <!-- Register Modal (UPDATED) -->
    <div id="registerModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md relative max-h-[90vh] overflow-y-auto animate-fadeIn">
            <button onclick="closeModal('registerModal')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"><i data-lucide="x"></i></button>
            <h2 class="text-2xl font-bold mb-2 text-gray-900">Create Account</h2>
            <p class="text-gray-500 mb-6">Start your subscription</p>
            
            <form id="registerForm" class="space-y-5" method="post">
                <input type="hidden" name="action" value="register">
                <div id="registerMessage" class="hidden p-2 text-sm rounded text-center"></div>

                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="company_name" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Company Name">
                    <input type="text" name="full_name" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Full Name">
                </div>
                <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Email Address">
                <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Create Password">
                
                <!-- Payment Section Updated -->
                <div class="border-t border-gray-100 pt-6 mt-2">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Select Payment Method</label>
                    <input type="hidden" name="payment_method" id="selectedPaymentMethod">
                    
                    <div class="grid grid-cols-3 gap-2">
                        <!-- Easypaisa -->
                        <div onclick="selectPayment('Easypaisa', this)" class="payment-option border rounded-xl p-3 flex flex-col items-center justify-center cursor-pointer hover:border-green-500 hover:bg-green-50 transition-all group">
                            <div class="font-bold text-green-600 text-sm">Easypaisa</div>
                        </div>
                        <!-- JazzCash -->
                        <div onclick="selectPayment('JazzCash', this)" class="payment-option border rounded-xl p-3 flex flex-col items-center justify-center cursor-pointer hover:border-red-500 hover:bg-red-50 transition-all group">
                            <div class="font-bold text-red-600 text-sm">JazzCash</div>
                        </div>
                        <!-- Bank Transfer -->
                        <div onclick="selectPayment('Bank Transfer', this)" class="payment-option border rounded-xl p-3 flex flex-col items-center justify-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all group">
                            <div class="font-bold text-blue-600 text-sm">Bank</div>
                        </div>
                    </div>

                    <!-- Hidden Bank Details Fields -->
                    <div id="bankDetailsFields" class="hidden mt-4 space-y-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-xs text-blue-600 font-semibold mb-2">Enter Your Bank Details</p>
                        <input type="text" name="bank_name" id="bankNameInput" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Bank Name (e.g. HBL)">
                        <input type="text" name="iban" id="ibanInput" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="IBAN Number">
                    </div>
                </div>
                
                <button type="submit" class="w-full mt-2 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700">Complete Registration</button>
            </form>
        </div>
    </div>

    <script>

        lucide.createIcons();

        function toggleMobileMenu() { document.getElementById('mobileMenu').classList.toggle('hidden'); }
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

        // Updated Payment Selection Logic
        function selectPayment(method, element) {
            // Remove highlight from all
            document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('payment-selected'));
            // Highlight selected
            element.classList.add('payment-selected');
            // Set value
            document.getElementById('selectedPaymentMethod').value = method;

            // Show/Hide Bank Fields
            const bankFields = document.getElementById('bankDetailsFields');
            const bankName = document.getElementById('bankNameInput');
            const iban = document.getElementById('ibanInput');

            if (method === 'Bank Transfer') {
                bankFields.classList.remove('hidden');
                bankName.setAttribute('required', 'required');
                iban.setAttribute('required', 'required');
            } else {
                bankFields.classList.add('hidden');
                bankName.removeAttribute('required');
                iban.removeAttribute('required');
                bankName.value = ''; // Clear value
                iban.value = '';
            }
        }

        // Login Script
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('auth.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') window.location.href = data.redirect;
                else alert(data.message);
            });
        });

        // Register Script
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if(!document.getElementById('selectedPaymentMethod').value) {
                alert("Please select a payment method.");
                return;
            }

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerText = "Processing...";
            submitBtn.disabled = true;

            fetch('auth.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'payment_required') window.location.href = data.redirect;
                else {
                    alert(data.message);
                    submitBtn.innerText = "Complete Registration";
                    submitBtn.disabled = false;
                }
            });
        });

// Apki Script section mai:
const stripe = Stripe('pk_test_51SXhqWR4uP8bAEurmxAEIXWOWexAEtak6wW6E1M0jy2ExFpjHQSyjy0ZLtgH7QzltXOHukMurRMMl4I1DD8FMUnm00NQaHvJgd'); // Apki Publishable Key

document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const paymentMethod = document.getElementById('selectedPaymentMethod').value;
    
    // Agar Payment Method Stripe hai
    if (paymentMethod === 'Stripe') {
        // Yahan ap Stripe Checkout session redirect laga sakti hain 
        // Lakin simple rakhne ke liye maan letay hain ap sirf register kr rahi hain
        // Aur backend pe payment verify karengi.
        
        // Best Approach: Backend pe Stripe Session create kr k redirect krna.
        // Quick Fix: User ko batana ke payment ho rahi hai.
        alert("Redirecting to Stripe Payment..."); 
        // (Iske liye backend code complex hoga, filhal simple form submit logic rakhein)
    }
    
    const formData = new FormData(this);
    
    fetch('auth.php', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            alert(data.message); // "Wait for approval" message
            closeModal('registerModal');
        } else {
            alert(data.message);
        }
    });
});

    </script>
</body>
</html>