<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Share Your Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            margin: 0;
            overflow-x: hidden;
            background-color: #4c1d95; /* Deep Purple Fallback */
        }

        /* --- 3D FLOATING SPHERES (The Magic) --- */
        .sphere {
            position: absolute;
            border-radius: 50%;
            filter: blur(2px);
            z-index: 0;
            animation: float 8s ease-in-out infinite;
            box-shadow: inset -10px -10px 30px rgba(0,0,0,0.2), 
                        10px 10px 30px rgba(0,0,0,0.2);
        }
        
        .sphere-cyan {
            background: radial-gradient(circle at 30% 30%, #67e8f9, #06b6d4);
            width: 300px; height: 300px;
            top: 10%; left: 10%;
        }

        .sphere-purple {
            background: radial-gradient(circle at 30% 30%, #e9d5ff, #a855f7);
            width: 400px; height: 400px;
            top: -10%; right: -5%;
            animation-delay: 2s;
        }

        .sphere-pink {
            background: radial-gradient(circle at 30% 30%, #fbcfe8, #db2777);
            width: 200px; height: 200px;
            bottom: 10%; left: 20%;
            animation-delay: 4s;
        }

        .sphere-small {
            background: radial-gradient(circle at 30% 30%, #ffffff, #cbd5e1);
            width: 80px; height: 80px;
            bottom: 30%; right: 20%;
            animation-delay: 1s;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        /* --- GLASSMORPHISM CARD --- */
        .glass-panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* --- STARS & EMOJIS --- */
        .star-icon {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            color: rgba(255,255,255,0.4);
            fill: transparent;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }
        
        .star-btn:hover .star-icon { transform: scale(1.3) rotate(12deg); color: #fbbf24; }
        .star-btn.active .star-icon { 
            fill: #fbbf24; color: #fbbf24; 
            transform: scale(1.2); 
            filter: drop-shadow(0 0 15px rgba(251, 191, 36, 0.6)); /* Glowing Effect */
        }

        .emoji-btn { transition: all 0.3s; opacity: 0.6; filter: grayscale(80%); transform: scale(0.9); }
        .emoji-btn:hover { opacity: 1; filter: grayscale(0%); transform: scale(1.2); }
        .emoji-btn.selected { 
            opacity: 1; filter: grayscale(0%); transform: scale(1.4); 
            text-shadow: 0 0 20px rgba(255,255,255,0.8);
        }

        /* --- INPUTS --- */
        .glass-input {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.3s;
        }
        .glass-input::placeholder { color: rgba(255,255,255,0.6); }
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255,255,255,0.6);
            outline: none;
            box-shadow: 0 0 0 4px rgba(255,255,255,0.1);
        }

        /* --- TAGS --- */
        .glass-tag {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.2s;
        }
        .glass-tag:hover { background: rgba(255,255,255,0.2); }
        .glass-tag.active {
            background: white;
            color: #4c1d95;
            font-weight: 600;
            box-shadow: 0 0 15px rgba(255,255,255,0.4);
        }
    </style>
</head>
<body class="min-h-screen relative flex items-center justify-center bg-gradient-to-br from-[#4c1d95] via-[#6d28d9] to-[#8b5cf6]">

    <!-- 3D BACKGROUND ELEMENTS -->
    <div class="sphere sphere-purple"></div>
    <div class="sphere sphere-cyan"></div>
    <div class="sphere sphere-pink"></div>
    <div class="sphere sphere-small"></div>

    <!-- MAIN CONTAINER -->
    <div class="relative z-10 w-full max-w-5xl px-4 py-8">
        
        <div class="glass-panel rounded-[2.5rem] p-8 md:p-16 flex flex-col items-center text-center w-full min-h-[600px] justify-center">
            
            <!-- LOGO / AVATAR AREA -->
            <div class="mb-6 relative">
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-full bg-white/20 border-4 border-white/30 flex items-center justify-center shadow-2xl backdrop-blur-md">
                    <i data-lucide="message-square-heart" class="w-12 h-12 md:w-16 md:h-16 text-white drop-shadow-lg"></i>
                </div>
                <!-- Decorative dots -->
                <div class="absolute -top-2 -right-10 flex gap-2">
                    <div class="w-4 h-4 rounded-full bg-cyan-400 shadow-lg"></div>
                    <div class="w-4 h-4 rounded-full bg-yellow-400 shadow-lg"></div>
                    <div class="w-4 h-4 rounded-full bg-pink-400 shadow-lg"></div>
                </div>
            </div>

            <h1 id="companyName" class="text-3xl md:text-5xl font-bold text-white mb-2 drop-shadow-md">Feedback</h1>
            <p id="dynamicSubtext" class="text-white/80 text-lg md:text-xl font-light mb-10">Your feedback helps us improve.</p>

            <form id="feedbackForm" class="w-full max-w-2xl space-y-8">
                
                <!-- RATING SECTION -->
                <div class="mb-8">
                    <!-- Stars -->
                    <div id="starModule" class="hidden flex justify-center gap-4 md:gap-6">
                        <button type="button" onclick="setRating(1)" class="star-btn p-1"><i data-lucide="star" class="star-icon w-12 h-12 md:w-16 md:h-16"></i></button>
                        <button type="button" onclick="setRating(2)" class="star-btn p-1"><i data-lucide="star" class="star-icon w-12 h-12 md:w-16 md:h-16"></i></button>
                        <button type="button" onclick="setRating(3)" class="star-btn p-1"><i data-lucide="star" class="star-icon w-12 h-12 md:w-16 md:h-16"></i></button>
                        <button type="button" onclick="setRating(4)" class="star-btn p-1"><i data-lucide="star" class="star-icon w-12 h-12 md:w-16 md:h-16"></i></button>
                        <button type="button" onclick="setRating(5)" class="star-btn p-1"><i data-lucide="star" class="star-icon w-12 h-12 md:w-16 md:h-16"></i></button>
                    </div>

                    <!-- Emojis -->
                    <div id="emojiModule" class="hidden flex justify-center gap-4 md:gap-8">
                        <button type="button" onclick="setRating(1)" class="emoji-btn text-5xl md:text-7xl" title="Terrible">😡</button>
                        <button type="button" onclick="setRating(2)" class="emoji-btn text-5xl md:text-7xl" title="Bad">🙁</button>
                        <button type="button" onclick="setRating(3)" class="emoji-btn text-5xl md:text-7xl" title="Okay">😐</button>
                        <button type="button" onclick="setRating(4)" class="emoji-btn text-5xl md:text-7xl" title="Good">🙂</button>
                        <button type="button" onclick="setRating(5)" class="emoji-btn text-5xl md:text-7xl" title="Amazing">🤩</button>
                    </div>

                    <input type="hidden" id="ratingValue">
                    <p id="ratingText" class="text-white font-bold text-xl mt-4 h-8 transition-all opacity-0">Excellent!</p>
                </div>

                <!-- PARAMETERS (TAGS) -->
                <div id="paramsSection" class="hidden animate-fade-in-up">
                    <div id="tagsContainer" class="flex flex-wrap justify-center gap-3 mb-8">
                        <!-- Tags injected here -->
                    </div>
                </div>

                <!-- INPUT FIELDS (Hidden initially, shown after rating) -->
                <div id="detailsSection" class="hidden space-y-5 animate-fade-in-up">
                    <input type="text" id="customerName" placeholder="Your Name (Optional)" 
                        class="glass-input w-full px-6 py-4 rounded-2xl text-lg backdrop-blur-sm">
                    
                    <textarea id="comment" rows="3" placeholder="Tell us about your experience..." 
                        class="glass-input w-full px-6 py-4 rounded-2xl text-lg resize-none backdrop-blur-sm"></textarea>
                    
                    <button type="submit" 
                        class="w-full py-4 rounded-full bg-white text-purple-700 text-lg font-bold shadow-lg hover:bg-opacity-90 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2">
                        <span>Submit Review</span>
                        <i data-lucide="send" class="w-5 h-5"></i>
                    </button>
                </div>

            </form>

            <!-- SUCCESS MESSAGE -->
            <div id="successView" class="hidden text-center py-10">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-white/50 shadow-[0_0_30px_rgba(255,255,255,0.3)]">
                    <i data-lucide="check" class="w-12 h-12 text-white"></i>
                </div>
                <h2 class="text-4xl font-bold text-white mb-4">Thank You!</h2>
                <p class="text-white/80 text-lg">Your feedback helps us grow.</p>
                <button onclick="location.reload()" class="mt-8 text-white underline hover:text-white/80">Submit another</button>
            </div>

        </div>
        
        <div class="text-center mt-6">
             <p class="text-white/40 text-xs uppercase tracking-widest font-medium">Powered by FeedbackSaaS</p>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC (SAME AS BEFORE, JUST UI UPDATES) -->
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const COMPANY_ID = urlParams.get('id');

        if (!COMPANY_ID) {
            document.body.innerHTML = "<div class='min-h-screen flex items-center justify-center text-white font-bold text-2xl'>Error: URL Link Incomplete.</div>";
            throw new Error("No ID");
        }

        const API_FETCH_URL = `admin_api.php?action=fetch_public&company_id=${COMPANY_ID}`;
        const API_SUBMIT_URL = 'submit_feedback.php';
        
        let activeModule = 'star';
        let parametersList = [];
        let selectedTags = new Set();
        
        // Dynamic Text based on rating
        const ratingTexts = ["Terrible", "Could be better", "It was okay", "Good job!", "Absolutely Amazing!"];

        document.addEventListener('DOMContentLoaded', () => {
            loadConfig();
            lucide.createIcons();
        });

        function loadConfig() {
            fetch(API_FETCH_URL)
            .then(res => res.json())
            .then(data => {
                if(data.status === 'error') { alert(data.message); return; }
                const s = data.settings;
                parametersList = data.parameters.map(p => p.param_name);

                // We keep the purple theme as requested, but we can subtly tint it if needed
                // document.body.style.background = s.primary_color; // Optional: Override background
                document.getElementById('companyName').innerText = s.company_name;

                activeModule = s.module_type; 
                if(activeModule === 'emoji') {
                    document.getElementById('emojiModule').classList.remove('hidden');
                    document.getElementById('starModule').classList.add('hidden');
                } else {
                    document.getElementById('starModule').classList.remove('hidden');
                    document.getElementById('emojiModule').classList.add('hidden');
                }
            })
            .catch(e => console.error(e));
        }

        function setRating(val) {
            document.getElementById('ratingValue').value = val;
            
            // Show dynamic text
            const txtEl = document.getElementById('ratingText');
            txtEl.innerText = ratingTexts[val - 1];
            txtEl.style.opacity = '1';

            // Reveal Inputs
            document.getElementById('detailsSection').classList.remove('hidden');

            if(activeModule === 'star') {
                document.querySelectorAll('.star-btn').forEach((btn, i) => {
                    i < val ? btn.classList.add('active') : btn.classList.remove('active');
                });
            } else {
                document.querySelectorAll('.emoji-btn').forEach((btn, i) => {
                    i + 1 === val ? btn.classList.add('selected') : btn.classList.remove('selected');
                });
            }

            if(parametersList.length > 0) {
                document.getElementById('paramsSection').classList.remove('hidden');
                renderTags();
            }
        }

        function renderTags() {
            const container = document.getElementById('tagsContainer');
            if(container.children.length === 0) { 
                container.innerHTML = '';
                parametersList.forEach(param => {
                    const btn = document.createElement('div');
                    btn.className = 'glass-tag px-6 py-3 rounded-full text-sm font-medium cursor-pointer select-none';
                    btn.innerText = param;
                    btn.onclick = () => toggleTag(btn, param);
                    container.appendChild(btn);
                });
            }
        }

        function toggleTag(el, param) {
            if(selectedTags.has(param)) { selectedTags.delete(param); el.classList.remove('active'); } 
            else { selectedTags.add(param); el.classList.add('active'); }
        }

        document.getElementById('feedbackForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const rating = document.getElementById('ratingValue').value;

            if(!rating) {
                alert("Please select a rating first.");
                return;
            }

            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = "Sending...";
            submitBtn.disabled = true;

            const data = {
                company_id: COMPANY_ID,
                name: document.getElementById('customerName').value.trim() || 'Anonymous',
                comment: document.getElementById('comment').value.trim(),
                rating: parseInt(rating),
                type: activeModule,
                tags: Array.from(selectedTags)
            };

            fetch(API_SUBMIT_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(result => {
                if(result.status === 'success') {
                    document.getElementById('feedbackForm').classList.add('hidden');
                    document.getElementById('companyName').classList.add('hidden');
                    document.getElementById('dynamicSubtext').classList.add('hidden');
                    document.getElementById('successView').classList.remove('hidden');
                } else {
                    alert("Error: " + result.message);
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            })
            .catch(() => {
                alert("Connection failed.");
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    </script>
</body>
</html>