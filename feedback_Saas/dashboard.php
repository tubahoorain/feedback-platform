<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback SaaS | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        :root { --brand: #4F46E5; }
        .bg-brand { background-color: var(--brand); }
        .text-brand { color: var(--brand); }
        .border-brand { border-color: var(--brand); }
        .nav-item.active { background-color: #eff6ff; color: var(--brand); border-right: 3px solid var(--brand); }
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex z-20 shadow-lg">
        <div class="h-16 flex items-center px-6 border-b border-gray-100 gap-3">
            <!-- Sidebar Logo (Updated Logic) -->
            <img id="sidebarLogo" src="" class="w-8 h-8 object-contain hidden">
            <div id="defaultSidebarIcon" class="w-8 h-8 bg-brand rounded-lg flex items-center justify-center text-white font-bold">F</div>
            <span class="font-bold text-lg text-gray-800">Feedback<span class="text-brand">SaaS</span></span>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <button onclick="switchTab('dashboard')" id="btn-dashboard" class="nav-item active w-full flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-50 transition-colors">
                <i data-lucide="layout-grid" class="w-5 h-5 mr-3"></i> Dashboard
            </button>
            <button onclick="switchTab('feedbacks')" id="btn-feedbacks" class="nav-item w-full flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-50 transition-colors">
                <i data-lucide="inbox" class="w-5 h-5 mr-3"></i> Feedbacks
            </button>
            <button onclick="switchTab('parameters')" id="btn-parameters" class="nav-item w-full flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-50 transition-colors">
                <i data-lucide="sliders" class="w-5 h-5 mr-3"></i> Parameters
            </button>
            <button onclick="switchTab('customization')" id="btn-customization" class="nav-item w-full flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-md hover:bg-gray-50 transition-colors">
                <i data-lucide="palette" class="w-5 h-5 mr-3"></i> Customization
            </button>
        </nav>
        
        <div class="p-4 border-t">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center"><i data-lucide="user" class="w-4 h-4"></i></div>
                <div>
                    <p class="text-sm font-bold" id="sidebarCompanyName">My Company</p>
                    <p class="text-xs text-gray-500">Admin</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col overflow-hidden relative">
        <main class="flex-1 overflow-y-auto p-6 md:p-8">
            
            <!-- Success Toast -->
            <div id="toast" class="fixed top-5 right-5 bg-gray-900 text-white px-6 py-3 rounded-lg shadow-xl transform translate-x-full transition-transform duration-300 z-50 flex items-center gap-3">
                <i data-lucide="check-circle" class="text-green-400"></i> <span id="toastMsg">Success!</span>
            </div>

            <!-- 1. DASHBOARD -->
            <div id="tab-dashboard" class="fade-in">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Dashboard Overview</h1>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-gray-500">Total Feedbacks</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2" id="statTotal">0</h3>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-gray-500">Average Rating</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2 flex items-center gap-2">
                            <span id="statAvg">0.0</span> <i data-lucide="star" class="w-6 h-6 text-yellow-400 fill-current"></i>
                        </h3>
                    </div>
                </div>
            </div>

            <!-- 2. FEEDBACKS LIST -->
            <div id="tab-feedbacks" class="hidden fade-in">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Feedback Inbox</h1>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Rating</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Comment</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="feedbackList">
                            <!-- Data loaded via JS -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 3. PARAMETERS (CRUD ADDED) -->
            <div id="tab-parameters" class="hidden fade-in">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">Manage Parameters</h1>
                    
                    <!-- Add Form -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <form id="addParamForm" class="flex gap-4">
                            <input type="text" id="paramInput" required placeholder="Enter parameter (e.g. Cleaning)" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-brand">
                            <button type="submit" class="bg-brand text-white px-6 py-2 rounded-lg hover:opacity-90 font-medium">Add New</button>
                        </form>
                    </div>

                    <!-- Active List -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 font-semibold text-gray-700">Active Parameters</div>
                        <div id="paramsList" class="divide-y divide-gray-100">
                            <!-- Loaded via JS -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. CUSTOMIZATION -->
            <div id="tab-customization" class="hidden fade-in">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">Customization</h1>
                    <form id="customForm" class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                                <input type="text" name="company_name" id="inputCompany" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-brand outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Primary Color</label>
                                <div class="flex items-center gap-3">
                                    <input type="color" name="primary_color" id="inputColor" class="h-10 w-16 p-0 border rounded cursor-pointer">
                                    <span id="hexCode" class="text-sm font-mono text-gray-500"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Logo Upload (Updates Sidebar)</label>
                            <input type="file" name="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>

                        <div>
                             <label class="block text-sm font-medium text-gray-700 mb-2">Feedback Module</label>
                             <div class="flex gap-4">
                                 <label class="flex items-center gap-2 border p-3 rounded-lg cursor-pointer">
                                     <input type="radio" name="feedback_module" value="star" checked> <span>Star Rating</span>
                                 </label>
                                 <label class="flex items-center gap-2 border p-3 rounded-lg cursor-pointer">
                                     <input type="radio" name="feedback_module" value="emoji"> <span>Emoji Reaction</span>
                                 </label>
                             </div>
                        </div>

                        <div class="pt-4 border-t text-right">
                            <button type="submit" class="bg-brand text-white px-8 py-3 rounded-lg hover:opacity-90">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <!-- EDIT MODAL (Hidden by default) -->
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-md animate-fadeIn">
            <h3 class="text-lg font-bold mb-4">Edit Parameter</h3>
            <input type="hidden" id="editParamId">
            <input type="text" id="editParamName" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4 outline-none focus:ring-2 focus:ring-brand">
            <div class="flex justify-end gap-3">
                <button onclick="closeEditModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">Cancel</button>
                <button onclick="saveEditParam()" class="px-4 py-2 bg-brand text-white rounded-lg hover:opacity-90">Save Changes</button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        const API_URL = 'dashboard_api.php';

        document.addEventListener('DOMContentLoaded', fetchData);

        // --- MAIN FETCH FUNCTION ---
        function fetchData() {
            const formData = new FormData();
            formData.append('action', 'get_dashboard_data');
            fetch(API_URL, { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    applySettings(data.settings);
                    renderParameters(data.parameters);
                    renderFeedbacks(data.feedbacks);
                    renderStats(data.stats);
                }
            });
        }

        // 1. SETTINGS & LOGO LOGIC
        function applySettings(s) {
            if(!s) return;
            const color = s.primary_color || '#4F46E5';
            document.documentElement.style.setProperty('--brand', color);
            document.getElementById('inputCompany').value = s.company_name;
            document.getElementById('inputColor').value = color;
            document.getElementById('hexCode').innerText = color;
            document.getElementById('sidebarCompanyName').innerText = s.company_name;

            // Logo Sidebar Fix
            const logoImg = document.getElementById('sidebarLogo');
            const defaultIcon = document.getElementById('defaultSidebarIcon');
            if(s.logo_path) {
                // "?t=..." lagane se browser cache nahi karega aur foran update hoga
                logoImg.src = s.logo_path + '?t=' + new Date().getTime();
                logoImg.classList.remove('hidden');
                defaultIcon.classList.add('hidden');
            } else {
                logoImg.classList.add('hidden');
                defaultIcon.classList.remove('hidden');
            }
        }

        // 2. PARAMETERS (Add, Edit, Delete)
        function renderParameters(params) {
            const list = document.getElementById('paramsList');
            list.innerHTML = '';
            params.forEach(p => {
                list.innerHTML += `
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50 group transition">
                        <span class="text-gray-700 font-medium">${p.name}</span>
                        <div class="flex gap-2 opacity-50 group-hover:opacity-100 transition">
                            <!-- Edit Button -->
                            <button onclick="openEditModal(${p.id}, '${p.name}')" class="p-2 text-blue-600 hover:bg-blue-50 rounded">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </button>
                            <!-- Delete Button -->
                            <button onclick="deleteParam(${p.id})" class="p-2 text-red-600 hover:bg-red-50 rounded">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                `;
            });
            lucide.createIcons();
        }

        // Add Logic
        document.getElementById('addParamForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('paramInput').value;
            const formData = new FormData();
            formData.append('action', 'add_parameter');
            formData.append('name', name);
            fetch(API_URL, { method: 'POST', body: formData }).then(() => {
                document.getElementById('paramInput').value = '';
                showToast('Parameter Added');
                fetchData(); // Refresh List Immediately
            });
        });

        // Delete Logic
        function deleteParam(id) {
            if(confirm('Are you sure you want to delete this?')) {
                const formData = new FormData();
                formData.append('action', 'delete_parameter');
                formData.append('id', id);
                fetch(API_URL, { method: 'POST', body: formData }).then(() => {
                    showToast('Deleted Successfully');
                    fetchData();
                });
            }
        }

        // Edit Modal Logic
        function openEditModal(id, name) {
            document.getElementById('editParamId').value = id;
            document.getElementById('editParamName').value = name;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }
        function saveEditParam() {
            const id = document.getElementById('editParamId').value;
            const name = document.getElementById('editParamName').value;
            const formData = new FormData();
            formData.append('action', 'edit_parameter');
            formData.append('id', id);
            formData.append('name', name);
            fetch(API_URL, { method: 'POST', body: formData }).then(() => {
                closeEditModal();
                showToast('Updated Successfully');
                fetchData();
            });
        }

        // 3. FEEDBACKS LIST LOGIC
        function renderFeedbacks(list) {
            const tbody = document.getElementById('feedbackList');
            tbody.innerHTML = '';
            list.forEach(f => {
                let stars = '';
                for(let i=0; i<5; i++) stars += `<i data-lucide="star" class="w-4 h-4 ${i<f.rating ? 'text-yellow-400 fill-current' : 'text-gray-300'}"></i>`;
                
                tbody.innerHTML += `
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">${f.customer_name || 'Anonymous'}</td>
                        <td class="px-6 py-4 flex gap-1">${stars}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${f.comment || '-'}</td>
                        <td class="px-6 py-4 text-sm text-gray-400">${f.created_at.split(' ')[0]}</td>
                    </tr>
                `;
            });
            lucide.createIcons();
        }

        // 4. STATS
        function renderStats(stats) {
            document.getElementById('statTotal').innerText = stats.total;
            document.getElementById('statAvg').innerText = stats.avg;
        }

        // 5. SAVE CUSTOMIZATION
        document.getElementById('customForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            btn.innerText = 'Saving...';
            
            const formData = new FormData(this);
            formData.append('action', 'save_customization');
            
            fetch(API_URL, { method: 'POST', body: formData }).then(() => {
                btn.innerText = originalText;
                showToast('Settings Saved');
                fetchData(); // Refresh to update Sidebar Logo
            });
        });

        // UI Helpers
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
        document.getElementById('inputColor').addEventListener('input', (e) => document.getElementById('hexCode').innerText = e.target.value);
    </script>
</body>
</html>