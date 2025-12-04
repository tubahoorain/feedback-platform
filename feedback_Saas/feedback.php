<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col items-center pt-8 md:pt-16 p-4">

    <!-- Form Container -->
    <div id="feedback-container" class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
        
        <!-- Brand Header -->
        <div class="h-32 w-full relative flex items-center justify-center bg-sky-500">
            <div class="absolute -bottom-10 h-24 w-24 rounded-full border-4 border-white overflow-hidden bg-white shadow-md flex items-center justify-center">
                 <span class="text-2xl font-bold text-sky-500">CH</span>
            </div>
        </div>

        <div class="pt-12 pb-8 px-8 text-center">
            <h1 class="text-xl font-bold text-gray-900 mb-2">City General Hospital</h1>
            <p class="text-gray-500 mb-6">We value your patient experience.</p>

            <!-- Step 1: Rating -->
            <div id="step-1" class="space-y-8">
                <div class="space-y-3">
                   <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Rate Us</p>
                   <div class="flex justify-center gap-2">
                     <button onclick="handleRating(1)" class="hover:scale-110 transition-transform"><i data-lucide="star" class="w-10 h-10 text-gray-300 hover:text-yellow-400 hover:fill-yellow-400"></i></button>
                     <button onclick="handleRating(2)" class="hover:scale-110 transition-transform"><i data-lucide="star" class="w-10 h-10 text-gray-300 hover:text-yellow-400 hover:fill-yellow-400"></i></button>
                     <button onclick="handleRating(3)" class="hover:scale-110 transition-transform"><i data-lucide="star" class="w-10 h-10 text-gray-300 hover:text-yellow-400 hover:fill-yellow-400"></i></button>
                     <button onclick="handleRating(4)" class="hover:scale-110 transition-transform"><i data-lucide="star" class="w-10 h-10 text-gray-300 hover:text-yellow-400 hover:fill-yellow-400"></i></button>
                     <button onclick="handleRating(5)" class="hover:scale-110 transition-transform"><i data-lucide="star" class="w-10 h-10 text-gray-300 hover:text-yellow-400 hover:fill-yellow-400"></i></button>
                   </div>
                </div>
            </div>

            <!-- Step 2: Details (Hidden initially) -->
            <div id="step-2" class="hidden text-left space-y-6 animate-fade-in mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">What is this about?</label>
                    <div class="grid grid-cols-2 gap-2">
                        <button onclick="selectCategory(this)" class="cat-btn px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:bg-gray-50">Doctor</button>
                        <button onclick="selectCategory(this)" class="cat-btn px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:bg-gray-50">Nurse</button>
                        <button onclick="selectCategory(this)" class="cat-btn px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:bg-gray-50">Cleanliness</button>
                        <button onclick="selectCategory(this)" class="cat-btn px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:bg-gray-50">Other</button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Any comments? (Optional)</label>
                    <textarea class="w-full border-gray-300 border rounded-lg p-3 focus:ring-2 focus:ring-sky-500 focus:outline-none shadow-sm" rows="4" placeholder="Tell us more..."></textarea>
                </div>

                <button onclick="submitFeedback()" class="w-full py-3 bg-sky-500 text-white rounded-lg font-medium hover:bg-sky-600 flex justify-center items-center gap-2">
                    Submit Feedback <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- Success State (Hidden) -->
    <div id="success-state" class="hidden bg-white w-full max-w-md rounded-2xl shadow-xl p-8 text-center">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
            <i data-lucide="check-circle" class="w-10 h-10 text-green-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Thank You!</h2>
        <p class="text-gray-600 mb-8">We appreciate your feedback.</p>
        <a href="index.html" class="block w-full py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Close</a>
    </div>

    <div class="mt-8 text-gray-400 text-xs">Powered by FeedbackSaaS</div>

    <script>
        lucide.createIcons();

        function handleRating(val) {
            // Visually fill stars up to val
            const stars = document.querySelectorAll('[data-lucide="star"]');
            stars.forEach((star, index) => {
                if (index < val) {
                    star.classList.add('fill-sky-500', 'text-sky-500');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.remove('fill-sky-500', 'text-sky-500');
                    star.classList.add('text-gray-300');
                }
            });
            
            // Show next step
            document.getElementById('step-1').classList.add('hidden');
            document.getElementById('step-2').classList.remove('hidden');
        }

        function selectCategory(btn) {
            document.querySelectorAll('.cat-btn').forEach(b => {
                b.classList.remove('bg-sky-500', 'text-white', 'border-transparent');
                b.classList.add('border-gray-200', 'text-gray-600');
            });
            btn.classList.remove('border-gray-200', 'text-gray-600');
            btn.classList.add('bg-sky-500', 'text-white', 'border-transparent');
        }

        function submitFeedback() {
            document.getElementById('feedback-container').classList.add('hidden');
            document.getElementById('success-state').classList.remove('hidden');
        }
    </script>
</body>
</html>
