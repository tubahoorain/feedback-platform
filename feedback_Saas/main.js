import { GoogleGenAI } from "@google/genai";

// --- STATE & MOCK DATA ---
const state = {
    view: 'landing',
    user: null,
    currentCompany: null, // For feedback view
    pfData: { rating: null, category: null, comment: '' }, // Public feedback form state
    
    // Mock Database
    companies: [
        {
            id: 'comp_1',
            name: 'City General Hospital',
            email: 'admin@cityhospital.com',
            status: 'ACTIVE',
            plan: 'ENTERPRISE',
            config: {
                logoUrl: 'https://picsum.photos/100/100?random=1',
                primaryColor: '#0ea5e9',
                welcomeText: 'We value your patient experience.',
                modules: { stars: true, emojis: true, comments: true },
                categories: ['Doctor', 'Nursing Staff', 'Cleanliness', 'Wait Time']
            }
        },
        {
            id: 'comp_2',
            name: 'Gourmet Burger Spot',
            email: 'manager@burgerspot.com',
            status: 'ACTIVE',
            plan: 'PRO',
            config: {
                logoUrl: 'https://picsum.photos/100/100?random=2',
                primaryColor: '#ef4444',
                welcomeText: 'How was your meal today?',
                modules: { stars: false, emojis: true, comments: true },
                categories: ['Food Quality', 'Service', 'Ambiance']
            }
        }
    ],
    feedbacks: [
        { id: 'fb_1', companyId: 'comp_1', rating: 5, type: 'STARS', category: 'Doctor', comment: 'Dr. Smith was very kind.', sentiment: 'POSITIVE', createdAt: '2023-12-01' },
        { id: 'fb_2', companyId: 'comp_1', rating: 2, type: 'STARS', category: 'Wait Time', comment: 'Waited for 2 hours.', sentiment: 'NEGATIVE', createdAt: '2023-12-02' },
        { id: 'fb_3', companyId: 'comp_2', rating: 3, type: 'EMOJIS', category: 'Food Quality', comment: 'Burger was cold.', sentiment: 'NEGATIVE', createdAt: '2023-12-03' },
        { id: 'fb_4', companyId: 'comp_2', rating: 1, type: 'EMOJIS', category: 'Service', comment: 'Excellent service!', sentiment: 'POSITIVE', createdAt: '2023-12-03' },
        { id: 'fb_5', companyId: 'comp_1', rating: 4, type: 'STARS', category: 'Cleanliness', comment: '', sentiment: 'POSITIVE', createdAt: '2023-12-04' },
    ],
    payments: [
        { id: 'pay_1', companyId: 'comp_1', amount: 5000, method: 'BANK_TRANSFER', status: 'VERIFIED', date: '2023-10-01' },
        { id: 'pay_2', companyId: 'comp_2', amount: 2000, method: 'JAZZCASH', status: 'VERIFIED', date: '2023-11-15' },
    ]
};

const PLANS = [
    { name: 'Starter', price: 'Rs. 2,000/mo', features: ['100 Feedback/mo', 'Basic Analytics', 'Email Support'] },
    { name: 'Business', price: 'Rs. 5,000/mo', features: ['Unlimited Feedback', 'Advanced Analytics', 'Custom Branding', 'Export Reports'], popular: true },
    { name: 'Enterprise', price: 'Custom', features: ['Dedicated Account Manager', 'API Access', 'SSO', 'Multi-branch Support'] },
];

let chartInstance = null;

// --- ROUTER ---
const app = {
    init: function() {
        this.router('landing');
        this.renderPricing();
        this.renderDemoLinks();
    },

    router: function(viewName, param = null) {
        state.view = viewName;
        
        // Hide all views
        $('.view-section').aAddClass('d-none');
        
        // Common UI elements
        $('#mainNavbar, #mainFooter').removeClass('d-none');
        $('body').removeClass('bg-light').css('background-color', '#f8fafc');

        switch(viewName) {
            case 'landing':
                $('#view-landing').removeClass('d-none');
                break;
            case 'features':
                $('#view-features').removeClass('d-none');
                break;
            case 'pricing':
                $('#view-pricing').removeClass('d-none');
                break;
            case 'contact':
                $('#view-contact').removeClass('d-none');
                break;
            case 'login':
                $('#view-auth').removeClass('d-none');
                $('#auth-title').text('Welcome Back');
                $('#auth-btn').text('Login');
                $('#auth-name-group').addClass('d-none');
                $('#auth-toggle').text('Need an account? Register');
                $('#auth-form').off('submit').on('submit', (e) => this.handleLogin(e));
                break;
            case 'register':
                $('#view-auth').removeClass('d-none');
                $('#auth-title').text('Create Account');
                $('#auth-btn').text('Continue to Payment');
                $('#auth-name-group').removeClass('d-none');
                $('#auth-toggle').text('Already have an account? Login');
                $('#auth-form').off('submit').on('submit', (e) => this.handleRegister(e));
                break;
            case 'company-dashboard':
                if (!state.user) return this.router('login');
                $('#mainNavbar, #mainFooter').addClass('d-none');
                $('#view-company-dashboard').removeClass('d-none');
                this.renderCompanyDashboard();
                break;
            case 'super-admin':
                if (!state.user) return this.router('login');
                $('#mainNavbar, #mainFooter').addClass('d-none');
                $('#view-super-admin').removeClass('d-none');
                this.renderSuperAdmin();
                break;
            case 'payment':
                $('#view-payment').removeClass('d-none');
                state.tempRegisterData = param; 
                break;
            case 'public-feedback':
                $('#mainNavbar, #mainFooter').addClass('d-none');
                $('#view-public-feedback').removeClass('d-none');
                this.initPublicFeedback(param);
                break;
        }
        
        // Scroll top
        window.scrollTo(0, 0);
    },

    // --- AUTH HANDLERS ---
    handleLogin: function(e) {
        e.preventDefault();
        const email = $('#auth-email-input').val();
        
        if (email.includes('super')) {
            state.user = { role: 'SUPER_ADMIN', email };
            this.router('super-admin');
        } else {
            const comp = state.companies.find(c => c.email === email);
            if (comp) {
                state.user = { role: 'COMPANY_ADMIN', ...comp };
                this.router('company-dashboard');
            } else {
                alert('User not found. Try one of the demo accounts (e.g. admin@cityhospital.com)');
            }
        }
    },

    handleRegister: function(e) {
        e.preventDefault();
        const name = $('#auth-name-input').val();
        const email = $('#auth-email-input').val();
        if(name && email) {
            const newComp = {
                id: `comp_${Date.now()}`,
                name, email, 
                status: 'ACTIVE', 
                plan: 'PRO',
                config: {
                    logoUrl: `https://picsum.photos/100/100?random=${Date.now()}`,
                    primaryColor: '#0d6efd',
                    welcomeText: `Welcome to ${name}`,
                    modules: { stars: true, emojis: true, comments: true },
                    categories: ['General']
                }
            };
            this.router('payment', newComp);
        }
    },

    processPayment: function(method) {
        if (state.tempRegisterData) {
            const comp = state.tempRegisterData;
            state.companies.push(comp);
            state.payments.push({
                id: `pay_${Date.now()}`,
                companyId: comp.id,
                amount: 5000,
                method: method,
                status: 'VERIFIED',
                date: new Date().toISOString().split('T')[0]
            });
            state.user = { role: 'COMPANY_ADMIN', ...comp };
            this.router('company-dashboard');
        }
    },

    logout: function() {
        state.user = null;
        this.router('landing');
    },

    // --- RENDERING ---
    renderPricing: function() {
        const container = $('#pricing-container');
        container.empty();
        PLANS.forEach(plan => {
            const card = `
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border ${plan.popular ? 'border-primary' : 'border-light'}">
                        ${plan.popular ? '<div class="bg-primary text-white text-center small fw-bold py-1">MOST POPULAR</div>' : ''}
                        <div class="card-body p-4 d-flex flex-col">
                            <h5 class="fw-bold text-muted">${plan.name}</h5>
                            <h2 class="fw-bold mb-4">${plan.price}</h2>
                            <ul class="list-unstyled mb-4">
                                ${plan.features.map(f => `<li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>${f}</li>`).join('')}
                            </ul>
                            <button class="btn ${plan.popular ? 'btn-primary' : 'btn-outline-dark'} w-100 fw-bold py-2 mt-auto" onclick="app.router('register')">Choose Plan</button>
                        </div>
                    </div>
                </div>
            `;
            container.append(card);
        });
    },

    renderDemoLinks: function() {
        const list = $('#demo-company-list');
        state.companies.forEach(c => {
            list.append(`<li><a class="dropdown-item" href="#" onclick="app.router('public-feedback', '${c.id}')">${c.name}</a></li>`);
        });
    },

    // --- COMPANY DASHBOARD ---
    renderCompanyDashboard: function() {
        const comp = state.companies.find(c => c.id === state.user.id);
        const myFeedbacks = state.feedbacks.filter(f => f.companyId === comp.id);
        
        $('#dash-company-name').text(comp.name);
        $('#dash-plan-badge').text(comp.plan + ' PLAN');
        
        // Stats
        $('#stat-total').text(myFeedbacks.length);
        const avg = myFeedbacks.length ? (myFeedbacks.reduce((acc,c) => acc + c.rating, 0) / myFeedbacks.length).toFixed(1) : '0.0';
        $('#stat-rating').html(`${avg} <span class="text-warning fs-4">★</span>`);
        const positive = myFeedbacks.filter(f => f.rating >= 4 || f.rating === 1).length; // logic adaptation
        $('#stat-sentiment').text(Math.round((positive/myFeedbacks.length)*100 || 0) + '%');

        // Chart
        this.renderChart(myFeedbacks);
        
        // List
        const list = $('#recent-comments-list');
        list.empty();
        myFeedbacks.slice(0, 10).forEach(f => {
            list.append(`
                <div class="p-3 bg-light rounded border mb-2">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="badge bg-secondary">${f.category}</span>
                        <small class="text-muted">${f.createdAt}</small>
                    </div>
                    <p class="small mb-0 text-dark">${f.comment || 'No comment'}</p>
                </div>
            `);
        });

        // Settings Form Population
        $('#conf-color').val(comp.config.primaryColor);
        $('#conf-welcome').val(comp.config.welcomeText);
        $('#conf-cats').val(comp.config.categories.join(', '));
        $('#conf-stars').prop('checked', comp.config.modules.stars);
        $('#conf-emojis').prop('checked', comp.config.modules.emojis);
        
        $('#config-form').off('submit').on('submit', (e) => {
            e.preventDefault();
            comp.config.primaryColor = $('#conf-color').val();
            comp.config.welcomeText = $('#conf-welcome').val();
            comp.config.categories = $('#conf-cats').val().split(',').map(s => s.trim());
            comp.config.modules.stars = $('#conf-stars').is(':checked');
            comp.config.modules.emojis = $('#conf-emojis').is(':checked');
            alert('Settings saved!');
        });

        // QR
        $('#qrcode-container').empty();
        new QRCode(document.getElementById("qrcode-container"), {
            text: `https://insightflow.app/feedback/${comp.id}`,
            width: 128, height: 128
        });
        $('#qr-link-input').val(`https://insightflow.app/feedback/${comp.id}`);

        // AI Listener
        $('#btn-analyze-ai').off('click').on('click', () => this.runAI(myFeedbacks));
    },

    renderChart: function(feedbacks) {
        const ctx = document.getElementById('categoryChart');
        if(chartInstance) chartInstance.destroy();
        
        const dataMap = {};
        feedbacks.forEach(f => dataMap[f.category] = (dataMap[f.category] || 0) + 1);
        
        chartInstance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(dataMap),
                datasets: [{
                    data: Object.values(dataMap),
                    backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6610f2']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    },

    switchDashTab: function(tab) {
        $('.dash-tab').addClass('d-none');
        $(`#dash-tab-${tab}`).removeClass('d-none');
        $('.list-group-item').removeClass('active');
        event.currentTarget.classList.add('active');
    },

    // --- SUPER ADMIN ---
    renderSuperAdmin: function() {
        const totalRev = state.payments.reduce((acc,p) => acc + p.amount, 0);
        $('#sa-rev').text(`Rs. ${totalRev.toLocaleString()}`);
        $('#sa-tenants').text(`${state.companies.filter(c => c.status === 'ACTIVE').length} / ${state.companies.length}`);
        
        const table = $('#sa-companies-table');
        table.empty();
        state.companies.forEach(c => {
            table.append(`
                <tr>
                    <td>
                        <div class="fw-bold text-white">${c.name}</div>
                        <small class="text-secondary">${c.email}</small>
                    </td>
                    <td><span class="badge bg-primary">${c.plan}</span></td>
                    <td><span class="badge ${c.status === 'ACTIVE' ? 'bg-success' : 'bg-danger'}">${c.status}</span></td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-light" onclick="app.toggleCompanyStatus('${c.id}')">
                            <i class="bi ${c.status === 'ACTIVE' ? 'bi-x-lg' : 'bi-check-lg'}"></i>
                        </button>
                    </td>
                </tr>
            `);
        });

        const plist = $('#sa-payments-list');
        plist.empty();
        state.payments.forEach(p => {
            plist.append(`
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom border-secondary">
                    <div>
                        <div class="fw-bold text-success">Rs. ${p.amount}</div>
                        <small class="text-secondary">${p.method}</small>
                    </div>
                    <span class="badge bg-secondary">${p.date}</span>
                </div>
            `);
        });
    },

    toggleCompanyStatus: function(id) {
        const c = state.companies.find(x => x.id === id);
        if(c) {
            c.status = c.status === 'ACTIVE' ? 'SUSPENDED' : 'ACTIVE';
            this.renderSuperAdmin();
        }
    },

    // --- GEMINI AI ---
    runAI: async function(feedbacks) {
        const apiKey = process.env.API_KEY; // Injected
        if (!apiKey) {
            $('#ai-result-box').text('API Key missing from env.');
            return;
        }
        
        $('#btn-analyze-ai').text('Thinking...').prop('disabled', true);
        const textData = feedbacks.filter(f => f.comment).map(f => `- [${f.category}] ${f.rating}/5: ${f.comment}`).join('\n');
        
        if(textData.length < 10) {
             $('#ai-result-box').text('Not enough text data to analyze.');
             $('#btn-analyze-ai').text('Analyze Feedback').prop('disabled', false);
             return;
        }

        try {
            const ai = new GoogleGenAI({ apiKey });
            const prompt = `Analyze these customer feedbacks. Identify 2 strengths and 2 weaknesses. Summarize in 50 words max.\n\n${textData}`;
            
            const response = await ai.models.generateContent({
                model: 'gemini-2.5-flash',
                contents: prompt,
            });
            
            $('#ai-result-box').html(response.text.replace(/\n/g, '<br>'));
        } catch (err) {
            console.error(err);
            $('#ai-result-box').text('Error analyzing data.');
        }
        $('#btn-analyze-ai').text('Analyze Feedback').prop('disabled', false);
    },

    // --- PUBLIC FEEDBACK WIZARD ---
    initPublicFeedback: function(compId) {
        const comp = state.companies.find(c => c.id === compId);
        state.currentCompany = comp;
        state.pfData = { rating: null, category: null, comment: '' };
        
        // Style & Branding
        $('#pf-header').css('background-color', comp.config.primaryColor);
        $('#pf-submit-btn').css('background-color', comp.config.primaryColor).css('border-color', comp.config.primaryColor);
        $('#pf-company-name').text(comp.name);
        $('#pf-welcome').text(comp.config.welcomeText);
        $('#pf-logo').attr('src', comp.config.logoUrl);

        // Reset steps
        $('#pf-step-rating, #pf-step-category, #pf-step-comment, #pf-step-success').addClass('d-none');
        $('#pf-step-rating').removeClass('d-none');

        // Toggle Modules
        if(comp.config.modules.stars) $('#pf-stars-container').removeClass('d-none');
        else $('#pf-stars-container').addClass('d-none');

        if(comp.config.modules.emojis) $('#pf-emojis-container').removeClass('d-none');
        else $('#pf-emojis-container').addClass('d-none');

        // Stars Event
        $('.star-btn').off('click').on('click', function() {
            const val = parseInt($(this).data('val'));
            state.pfData.rating = val;
            
            // Highlight logic
            $('.star-btn i').removeClass('star-active text-warning').addClass('text-secondary');
            $('.star-btn').each(function() {
                if ($(this).data('val') <= val) $(this).find('i').removeClass('text-secondary').addClass('star-active');
            });
            
            setTimeout(() => app.pfNext('category'), 300);
        });

        // Emoji Event
        $('.emoji-btn').off('click').on('click', function() {
            state.pfData.rating = parseInt($(this).data('val')); // 3=bad, 2=ok, 1=good map
            app.pfNext('category');
        });

        // Populate Categories
        const catGrid = $('#pf-cat-grid');
        catGrid.empty();
        comp.config.categories.forEach(cat => {
            catGrid.append(`
                <div class="col-6">
                    <button class="btn cat-btn w-100 py-3 fw-medium text-secondary" onclick="app.pfSelectCategory('${cat}')">${cat}</button>
                </div>
            `);
        });

        // Submit Event
        $('#pf-submit-btn').off('click').on('click', () => {
            state.pfData.comment = $('#pf-comment-input').val();
            // Save to "DB"
            state.feedbacks.push({
                id: `fb_${Date.now()}`,
                companyId: comp.id,
                rating: state.pfData.rating,
                type: comp.config.modules.stars ? 'STARS' : 'EMOJIS',
                category: state.pfData.category,
                comment: state.pfData.comment,
                sentiment: 'NEUTRAL',
                createdAt: new Date().toISOString().split('T')[0]
            });
            $('#pf-step-comment').addClass('d-none');
            $('#pf-step-success').removeClass('d-none');
        });
    },

    pfSelectCategory: function(cat) {
        state.pfData.category = cat;
        if (state.currentCompany.config.modules.comments) {
            this.pfNext('comment');
        } else {
            // Skip comment
             $('#pf-submit-btn').click();
        }
    },

    pfNext: function(step) {
        if(step === 'category') {
            $('#pf-step-rating').addClass('d-none');
            $('#pf-step-category').removeClass('d-none');
        } else if (step === 'comment') {
            $('#pf-step-category').addClass('d-none');
            $('#pf-step-comment').removeClass('d-none');
        }
    },

    pfBack: function(step) {
        if(step === 'rating') {
            $('#pf-step-category').addClass('d-none');
            $('#pf-step-rating').removeClass('d-none');
        } else if (step === 'category') {
            $('#pf-step-comment').addClass('d-none');
            $('#pf-step-category').removeClass('d-none');
        }
    }
};

// Export to global scope for HTML onclick events
window.app = app;

// Init
$(document).ready(() => app.init());