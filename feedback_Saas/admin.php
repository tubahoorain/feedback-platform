<?php
session_start();
// Agar user login nahi hai to login page par bhej dein
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}
$my_id = $_SESSION['user_id']; // Current Company ID
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | FeedbackSaaS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #4c1d95; 
            color: white;
            overflow: hidden; /* Hide scrollbars for full immersion */
        }

        /* --- 3D FLOATING SPHERES --- */
        .sphere {
            position: absolute; border-radius: 50%; filter: blur(30px); z-index: 0;
            animation: float 10s ease-in-out infinite; opacity: 0.6;
        }
        .s1 { background: #06b6d4; width: 400px; height: 400px; top: -10%; left: -10%; }
        .s2 { background: #db2777; width: 300px; height: 300px; bottom: -5%; right: -5%; animation-delay: 2s; }
        .s3 { background: #8b5cf6; width: 200px; height: 200px; top: 40%; left: 40%; animation-delay: 4s; filter: blur(50px); }

        @keyframes float { 0% { transform: translateY(0); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0); } }

        /* --- GLASSMORPHISM UTILS --- */
        .glass-sidebar {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            border-radius: 1.5rem;
        }

        .glass-input {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }
        .glass-input:focus { outline: none; border-color: rgba(255, 255, 255, 0.6); background: rgba(0, 0, 0, 0.4); }

        /* --- NAVIGATION --- */
        .nav-item {
            transition: all 0.3s;
            color: rgba(255, 255, 255, 0.7);
            border-radius: 0.75rem;
        }
        .nav-item:hover { background: rgba(255, 255, 255, 0.1); color: white; }
        .nav-item.active { 
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.05));
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        /* --- SCROLLBAR --- */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.4); }

        /* --- TABLE --- */
        .glass-table th { color: rgba(255,255,255,0.6); border-bottom: 1px solid rgba(255,255,255,0.1); }
        .glass-table td { border-bottom: 1px solid rgba(255,255,255,0.05); color: rgba(255,255,255,0.9); }
        .glass-table tr:hover td { background: rgba(255,255,255,0.05); }

        .fade-in { animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="relative flex h-screen w-full">

    <!-- 3D BACKGROUND -->
    <div class="sphere s1"></div>
    <div class="sphere s2"></div>
    <div class="sphere s3"></div>

    <!-- SIDEBAR -->
    <aside class="w-72 glass-sidebar flex flex-col z-20 hidden md:flex h-full shadow-2xl">
        
        <!-- LOGO AREA -->
        <div class="h-24 flex items-center px-8 gap-4 border-b border-white/10">
            <div id="defaultSidebarIcon" class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">F</div>
            <img id="sidebarLogo" src="" alt="Logo" class="w-10 h-10 object-contain hidden rounded-lg">
            
            <div class="flex flex-col overflow-hidden">
                <span class="font-bold text-lg tracking-wide truncate" id="brandNameText">Loading...</span>
                <span class="text-xs text-white/50">Admin Panel</span>
            </div>
        </div>

        <!-- NAVIGATION -->
        <nav class="flex-1 p-6 space-y-3 overflow-y-auto">
            <button onclick="switchTab('dashboard')" id="btn-dashboard" class="nav-item active w-full flex items-center px-4 py-3.5 text-sm font-medium">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i> Dashboard
            </button>
            <button onclick="switchTab('feedbacks')" id="btn-feedbacks" class="nav-item w-full flex items-center px-4 py-3.5 text-sm font-medium">
                <i data-lucide="message-square" class="w-5 h-5 mr-3"></i> Feedbacks
            </button>
            <button onclick="switchTab('customization')" id="btn-customization" class="nav-item w-full flex items-center px-4 py-3.5 text-sm font-medium">
                <i data-lucide="palette" class="w-5 h-5 mr-3"></i> Customization
            </button>

            <div class="pt-8 mt-4 border-t border-white/10">
                <p class="px-4 text-xs font-bold text-white/40 uppercase tracking-widest mb-2">Actions</p>
                <a href="customer.php?id=<?php echo $my_id; ?>" target="_blank" class="nav-item w-full flex items-center px-4 py-3 text-sm font-medium text-cyan-300 hover:text-cyan-200">
                    <i data-lucide="external-link" class="w-5 h-5 mr-3"></i> View Live Form
                </a>
                <button onclick="resetData()" class="nav-item w-full flex items-center px-4 py-3 text-sm font-medium text-red-300 hover:text-red-200">
    <i data-lucide="trash-2" class="w-5 h-5 mr-3"></i> Reset Data
</button>
            </div>
        </nav>
        
        <!-- FOOTER -->
        <div class="p-6 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                    <i data-lucide="user" class="w-4 h-4 text-white"></i>
                </div>
                <div>
                    <p class="text-sm font-medium">Admin</p>
                    <a href="logout.php" class="text-xs text-white/50 hover:text-white">Logout</a>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col relative z-10 overflow-hidden h-full">
        
        <!-- TOP BAR (Mobile Only) -->
        <div class="md:hidden h-16 glass-sidebar flex items-center px-4 justify-between">
            <span class="font-bold">FeedbackSaaS</span>
            <button class="p-2"><i data-lucide="menu"></i></button>
        </div>

        <main class="flex-1 overflow-y-auto p-6 md:p-10 space-y-8">
            
            <!-- Toast -->
            <div id="toast" class="fixed top-6 right-6 bg-emerald-500 text-white px-6 py-3 rounded-xl shadow-2xl transform translate-x-full transition-transform duration-300 z-50 flex items-center gap-3 border border-emerald-400">
                <i data-lucide="check-circle"></i> <span id="toastMsg">Saved successfully!</span>
            </div>

            <!-- 1. DASHBOARD TAB -->
            <div id="tab-dashboard" class="fade-in max-w-6xl mx-auto w-full">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold">Dashboard</h1>
                        <p class="text-white/60">Overview of your customer sentiment.</p>
                    </div>
                    <div class="bg-white/10 px-4 py-2 rounded-lg text-sm border border-white/10">
                        Live Data
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Stat Card 1 -->
                    <div class="glass-card p-6 relative overflow-hidden group">
                        <div class="absolute right-0 top-0 p-6 opacity-10 group-hover:scale-110 transition-transform">
                            <i data-lucide="message-square" class="w-24 h-24"></i>
                        </div>
                        <p class="text-white/60 text-sm font-medium uppercase tracking-wider">Total Feedbacks</p>
                        <h3 class="text-4xl font-bold mt-2" id="statTotal">0</h3>
                        <div class="mt-4 text-sm text-cyan-300">Lifetime responses</div>
                    </div>
                    
                    <!-- Stat Card 2 -->
                    <div class="glass-card p-6 relative overflow-hidden group">
                        <div class="absolute right-0 top-0 p-6 opacity-10 group-hover:scale-110 transition-transform">
                            <i data-lucide="star" class="w-24 h-24"></i>
                        </div>
                        <p class="text-white/60 text-sm font-medium uppercase tracking-wider">Average Rating</p>
                        <h3 class="text-4xl font-bold mt-2 flex items-center gap-2">
                            <span id="statAvg">0.0</span> 
                            <i data-lucide="star" class="w-6 h-6 text-yellow-400 fill-current"></i>
                        </h3>
                        <div class="mt-4 text-sm text-yellow-300">Out of 5.0</div>
                    </div>
                    
                    <!-- Stat Card 3 -->
                    <div class="glass-card p-6 relative overflow-hidden group">
                        <div class="absolute right-0 top-0 p-6 opacity-10 group-hover:scale-110 transition-transform">
                            <i data-lucide="layers" class="w-24 h-24"></i>
                        </div>
                        <p class="text-white/60 text-sm font-medium uppercase tracking-wider">Active Module</p>
                        <h3 class="text-3xl font-bold mt-2 uppercase" id="statModule">...</h3>
                        <div class="mt-4 text-sm text-pink-300">Currently live</div>
                    </div>
                </div>
            </div>

            <!-- 2. FEEDBACKS TAB -->
            <div id="tab-feedbacks" class="hidden fade-in max-w-6xl mx-auto w-full">
                <h1 class="text-3xl font-bold mb-6">Inbox</h1>
                <div class="glass-card overflow-hidden">
                    <table class="w-full text-left glass-table">
                        <thead class="bg-white/10 uppercase text-xs font-semibold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Customer</th>
                                <th class="px-6 py-4">Rating</th>
                                <th class="px-6 py-4">Tags</th>
                                <th class="px-6 py-4">Comment</th>
                                <th class="px-6 py-4">Date</th>
                            </tr>
                        </thead>
                        <tbody id="feedbackList">
                            <!-- JS will inject rows here -->
                        </tbody>
                    </table>
                    <div id="emptyState" class="hidden p-12 text-center text-white/40">
                        <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
                        <p>No feedback received yet.</p>
                    </div>
                </div>
            </div>

            <!-- 3. CUSTOMIZATION TAB -->
            <div id="tab-customization" class="hidden fade-in max-w-4xl mx-auto w-full">
                <h1 class="text-3xl font-bold mb-2">Design Your Page</h1>
                <p class="text-white/60 mb-8">Customize how your customers see the feedback form.</p>

                <form id="customForm" class="glass-card p-8 space-y-8">
                    
                    <!-- Brand Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">Company Name</label>
                            <input type="text" id="inputCompany" class="glass-input w-full px-4 py-3 rounded-xl placeholder-white/30" placeholder="e.g. Acme Corp">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white/80 mb-2">Brand Theme Color</label>
                            <div class="flex items-center gap-4">
                                <input type="color" id="inputColor" class="h-12 w-20 rounded cursor-pointer bg-transparent border-0 p-0">
                                <span id="hexCode" class="font-mono text-white/60">#4F46E5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Logo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Logo</label>
                        <div class="relative">
                            <input type="file" id="inputLogo" accept="image/*" class="glass-input w-full px-4 py-3 rounded-xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-white/20 file:text-white file:font-semibold hover:file:bg-white/30 transition">
                        </div>
                    </div>

                    <div class="border-t border-white/10"></div>

                    <!-- Module Selection -->
                    <div>
                         <label class="block text-sm font-medium text-white/80 mb-4">Select Rating Style</label>
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                             <label class="relative flex items-center justify-center gap-3 p-4 rounded-xl border border-white/20 cursor-pointer hover:bg-white/5 transition has-[:checked]:bg-white/20 has-[:checked]:border-white/50">
                                 <input type="radio" name="feedback_module" value="star" class="hidden"> 
                                 <span class="font-medium flex items-center gap-2">Star Rating <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i></span>
                             </label>
                             <label class="relative flex items-center justify-center gap-3 p-4 rounded-xl border border-white/20 cursor-pointer hover:bg-white/5 transition has-[:checked]:bg-white/20 has-[:checked]:border-white/50">
                                 <input type="radio" name="feedback_module" value="emoji" class="hidden"> 
                                 <span class="font-medium flex items-center gap-2">Emoji Reaction <i data-lucide="smile" class="w-4 h-4 text-yellow-400"></i></span>
                             </label>
                         </div>
                    </div>

                    <!-- Parameters -->
                    <div>
                        <label class="block text-sm font-medium text-white/80 mb-2">Feedback Tags</label>
                        <div class="flex gap-2 mb-4">
                            <input type="text" id="newParamInput" placeholder="Add new tag (e.g. Service)" class="glass-input flex-1 px-4 py-2 rounded-lg text-sm placeholder-white/30">
                            <button type="button" onclick="addParameterFromInput()" class="bg-white text-purple-900 px-6 py-2 rounded-lg text-sm font-bold hover:bg-gray-200 transition">Add</button>
                        </div>
                        <div id="paramsContainer" class="flex flex-wrap gap-2 min-h-[50px] p-4 rounded-xl border border-white/10 bg-black/20">
                            <span class="text-white/30 text-sm italic w-full text-center py-2 hidden" id="noParamsMsg">No tags added yet.</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/10 flex justify-end">
                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-10 py-3 rounded-xl font-bold shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 transform hover:-translate-y-1 transition-all">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <!-- JAVASCRIPT LOGIC (SAME FUNCTIONALITY, UPDATED STYLES) -->
    <script>
       const API_URL = 'admin_api.php';

        document.addEventListener('DOMContentLoaded', () => {
            loadData();
            if(typeof lucide !== 'undefined') lucide.createIcons();
        });

        function loadData() {
            fetch(`${API_URL}?action=fetch_all`)
                .then(response => response.json())
                .then(data => {
                    if(data.settings) applySettingsUI(data.settings);
                    
                    const params = data.parameters || [];
                    const feedbacks = data.feedbacks || [];

                    renderAdminParameters(params);
                    renderFeedbacks(feedbacks);
                    renderStats(feedbacks);
                })
                .catch(err => console.error('Error fetching data:', err));
        }
        // --- RESET DATA FUNCTION ---
        function resetData() {
            // Confirm box
            if (confirm("⚠️ ARE YOU SURE?\n\nThis will delete ALL customer feedbacks permanently.\nYou cannot undo this action.")) {
                
                // Button text change for feedback
                const btn = document.querySelector('button[onclick="resetData()"]');
                const originalText = btn.innerHTML;
                btn.innerHTML = "Deleting...";

                fetch(`${API_URL}?action=reset_data`, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showToast("All data has been reset!");
                        loadData(); // Table refresh karein
                    } else {
                        alert("Error: " + data.message);
                    }
                    btn.innerHTML = originalText;
                })
                .catch(err => {
                    console.error(err);
                    alert("Connection failed");
                    btn.innerHTML = originalText;
                });
            }
        }

        // --- RENDER FEEDBACKS (Dark Mode Optimized) ---
        function renderFeedbacks(list) {
            const tbody = document.getElementById('feedbackList');
            const empty = document.getElementById('emptyState');
            tbody.innerHTML = '';

            if(!list || list.length === 0) {
                if(empty) empty.classList.remove('hidden');
                return;
            }
            if(empty) empty.classList.add('hidden');

            list.forEach(f => {
                let ratingDisplay = '';
                const score = parseInt(f.rating); 

                if(f.feedback_type === 'emoji') {
                     const emojis = ['😡','🙁','😐','🙂','🤩']; 
                     const index = Math.min(Math.max(score - 1, 0), 4);
                     ratingDisplay = `<span class="text-2xl drop-shadow-md">${emojis[index]}</span>`;
                } else {
                    for(let i=0; i<5; i++) {
                        const colorClass = i < score ? 'text-yellow-400 fill-current' : 'text-white/20';
                        ratingDisplay += `<i data-lucide="star" class="w-4 h-4 ${colorClass}"></i>`;
                    }
                }

                let paramHtml = '<span class="text-white/30 text-xs">-</span>';
                if(f.selected_tags && f.selected_tags.trim() !== "") {
                    const tagsArr = f.selected_tags.split(',');
                    paramHtml = tagsArr.map(t => 
                        `<span class="inline-block bg-white/10 text-white/90 text-[10px] px-2 py-0.5 rounded-full border border-white/20 mr-1">${t}</span>`
                    ).join('');
                }

                tbody.innerHTML += `
                    <tr class="transition">
                        <td class="px-6 py-4 text-sm font-bold text-white">${f.customer_name || 'Anonymous'}</td>
                        <td class="px-6 py-4 flex gap-1 items-center">${ratingDisplay}</td>
                        <td class="px-6 py-4 align-middle"><div class="flex flex-wrap gap-1 max-w-[200px]">${paramHtml}</div></td>
                        <td class="px-6 py-4 text-sm text-white/70 max-w-xs truncate" title="${f.comment}">${f.comment || '-'}</td>
                        <td class="px-6 py-4 text-sm text-white/50 whitespace-nowrap">${f.created_at}</td>
                    </tr>
                `;
            });
            lucide.createIcons();
        }

        function renderStats(list) {
            document.getElementById('statTotal').innerText = list.length;
            if(list.length > 0) {
                const sum = list.reduce((acc, curr) => acc + parseInt(curr.rating), 0);
                const avg = (sum / list.length).toFixed(1);
                document.getElementById('statAvg').innerText = avg;
            } else {
                document.getElementById('statAvg').innerText = '0.0';
            }
        }

        function applySettingsUI(s) {
            // We don't change admin theme based on settings, but we update inputs
            document.documentElement.style.setProperty('--brand', s.primary_color);
            const nameInput = document.getElementById('inputCompany');
            
            if (document.activeElement !== nameInput) {
                nameInput.value = s.company_name;
                document.getElementById('brandNameText').innerText = s.company_name || "Admin Panel";
            }
            
            const colorInput = document.getElementById('inputColor');
            if (document.activeElement !== colorInput) {
                colorInput.value = s.primary_color;
                document.getElementById('hexCode').innerText = s.primary_color;
            }

            document.getElementById('statModule').innerText = s.module_type;

            const logoImg = document.getElementById('sidebarLogo');
            const defaultIcon = document.getElementById('defaultSidebarIcon');
            
            if(s.logo_base64 && s.logo_base64.trim() !== "") {
                logoImg.src = s.logo_base64; logoImg.classList.remove('hidden'); defaultIcon.classList.add('hidden');
            } else {
                logoImg.classList.add('hidden'); defaultIcon.classList.remove('hidden');
            }

            // Radio Logic Fix
            const radios = document.getElementsByName('feedback_module');
            radios.forEach(r => {
                if(r.value === s.module_type) {
                    r.checked = true;
                    // Trigger visual update for Tailwind 'has-checked'
                    r.parentElement.click(); 
                }
            });
        }

        function renderAdminParameters(list) {
            const container = document.getElementById('paramsContainer');
            const msg = document.getElementById('noParamsMsg');
            container.innerHTML = '';
            
            if(list.length === 0) {
                container.appendChild(msg);
                msg.classList.remove('hidden');
            } else {
                if(msg) msg.classList.add('hidden');
                list.forEach((param) => {
                    const tag = document.createElement('div');
                    tag.className = "flex items-center gap-2 bg-white/10 border border-white/20 text-white px-3 py-1.5 rounded-lg text-sm group hover:bg-white/20 transition";
                    tag.innerHTML = `
                        <span>${param.param_name}</span>
                        <div class="flex gap-1 ml-2 border-l pl-2 border-white/20">
                             <button type="button" onclick="deleteParameter(${param.id})" class="text-red-400 hover:text-red-300"><i data-lucide="x" class="w-3 h-3"></i></button>
                        </div>
                    `;
                    container.appendChild(tag);
                });
                lucide.createIcons();
            }
        }

        function addParameterFromInput() {
            const input = document.getElementById('newParamInput');
            const val = input.value.trim();
            if(val) fetch(`${API_URL}?action=manage_params`, {method: 'POST', body: JSON.stringify({ type: 'add', name: val })}).then(() => { input.value = ''; loadData(); });
        }
        function deleteParameter(id) {
            if(confirm('Delete?')) fetch(`${API_URL}?action=manage_params`, {method: 'POST', body: JSON.stringify({ type: 'delete', id: id })}).then(() => loadData());
        }

        document.getElementById('customForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            btn.innerText = "Saving...";
            
            const payload = {
                company_name: document.getElementById('inputCompany').value,
                primary_color: document.getElementById('inputColor').value,
                module: document.querySelector('input[name="feedback_module"]:checked').value,
                logo_base64: null
            };
            const fileInput = document.getElementById('inputLogo');
            if(fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    payload.logo_base64 = event.target.result;
                    sendSettings(payload);
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else { sendSettings(payload); }
            
            setTimeout(() => { btn.innerText = originalText; }, 1000);
        });

        function sendSettings(data) {
            fetch(`${API_URL}?action=update_settings`, {method: 'POST', body: JSON.stringify(data)})
            .then(res => res.json()).then(result => {
                if(result.status === 'success') { showToast('Changes Saved!'); loadData(); }
            });
        }

        document.getElementById('inputCompany').addEventListener('input', (e) => document.getElementById('brandNameText').innerText = e.target.value || "Admin Panel");
        document.getElementById('inputColor').addEventListener('input', (e) => { document.getElementById('hexCode').innerText = e.target.value; });
        
        function switchTab(id) { 
            document.querySelectorAll('[id^="tab-"]').forEach(el => el.classList.add('hidden')); 
            document.getElementById('tab-' + id).classList.remove('hidden'); 
            document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active')); 
            document.getElementById('btn-' + id).classList.add('active'); 
        }
        
        function showToast(msg) { 
            const t = document.getElementById('toast'); 
            document.getElementById('toastMsg').innerText = msg; 
            t.classList.remove('translate-x-full'); 
            setTimeout(() => t.classList.add('translate-x-full'), 3000); 
        }
        
        setInterval(() => { loadData(); }, 10000);
    </script>
</body>
</html>