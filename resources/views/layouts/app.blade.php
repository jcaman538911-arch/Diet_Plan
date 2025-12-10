<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Diet Plan System')</title>
    <style>
        :root {
            --color-background: #e8f4e6;
            --color-background-hero: linear-gradient(180deg, #f4fbf2 0%, #e5f2e1 100%);
            --color-sidebar: #ffffff;
            --color-border: #d2e3cd;
            --color-text: #2f3f2f;
            --color-muted: #6c806c;
            --color-accent: #4f8a3e;
            --color-accent-dark: #3c6c2f;
            --color-accent-soft: rgba(79, 138, 62, 0.12);
            --color-surface: #ffffff;
            --color-surface-alt: #f1f7ef;
            --color-shadow: rgba(73, 112, 63, 0.08);
            --color-danger: #dc3545;
            --color-danger-dark: #bf2535;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: var(--color-background-hero);
            color: var(--color-text);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 90px;
            background-color: var(--color-sidebar);
            border-right: 1px solid var(--color-border);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 0;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            box-shadow: 6px 0 20px rgba(56, 96, 49, 0.06);
        }

        .logo {
            width: 52px;
            height: 52px;
            margin-bottom: 42px;
            border-radius: 14px;
            background: var(--color-accent-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .nav-menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 28px;
            width: 100%;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--color-muted);
            font-size: 11px;
            padding: 12px 10px;
            transition: all 0.3s;
            position: relative;
            border-radius: 14px 0 0 14px;
            margin-left: 6px;
        }

        .nav-item:hover {
            color: var(--color-accent);
            background: rgba(79, 138, 62, 0.08);
        }

        .nav-item.active {
            color: var(--color-accent);
            background: rgba(79, 138, 62, 0.12);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 36px;
            border-radius: 12px;
            background-color: var(--color-accent);
        }

        .nav-icon {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .logout-btn {
            margin-top: auto;
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 90px;
            padding: 36px 40px;
            width: calc(100% - 90px);
            display: flex;
            justify-content: center;
        }

        .content-wrapper {
            width: 100%;
            max-width: 1080px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .header {
            margin-bottom: 28px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 10px;
        }

        .header p {
            color: var(--color-muted);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--color-accent);
            color: #fff;
            box-shadow: 0 6px 16px rgba(79, 138, 62, 0.25);
        }

        .btn-primary:hover {
            background: var(--color-accent-dark);
        }

        .btn-secondary {
            background: var(--color-surface-alt);
            color: var(--color-accent-dark);
            border: 1px solid rgba(79, 138, 62, 0.18);
        }

        .btn-secondary:hover {
            background: rgba(79, 138, 62, 0.18);
            color: var(--color-text);
        }

        .btn-danger {
            background-color: var(--color-danger);
            color: #fff;
        }

        .btn-danger:hover {
            background-color: var(--color-danger-dark);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            border: 1px solid transparent;
        }

        .alert-success {
            background-color: rgba(79, 138, 62, 0.12);
            color: var(--color-accent-dark);
            border-color: rgba(79, 138, 62, 0.2);
        }

        .alert-error {
            background-color: rgba(220, 53, 69, 0.12);
            color: var(--color-danger-dark);
            border-color: rgba(220, 53, 69, 0.28);
        }

        /* Help Button */
        .help-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            padding: 0;
            border-radius: 50%;
            background: var(--color-accent);
            color: white;
            border: none;
            font-size: 28px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 12px 30px rgba(79, 138, 62, 0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .help-btn:hover {
            background: var(--color-accent-dark);
            transform: scale(1.05);
        }

        .help-btn-icon {
            color: white;
            font-size: 32px;
            line-height: 1;
            display: inline-block;
        }

        .is-sending .help-btn {
            pointer-events: none;
        }

        /* Help Modal */
        .help-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            overflow-y: auto;
        }

        .help-modal.active {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 20px;
        }

        .help-modal-content {
            background: var(--color-background);
            border-radius: 24px;
            width: 100%;
            max-width: 900px;
            max-height: 90vh;
            margin: 20px auto;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .help-modal-header {
            position: sticky;
            top: 0;
            background: var(--color-background);
            padding: 24px 30px;
            border-bottom: 1px solid rgba(79, 138, 62, 0.12);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
            border-radius: 24px 24px 0 0;
        }

        .help-modal-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--color-text);
            margin: 0;
        }

        .help-modal-close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: var(--color-muted);
            padding: 0;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .help-modal-close:hover {
            background: rgba(79, 138, 62, 0.1);
            color: var(--color-accent);
        }

        .help-modal-body {
            padding: 30px;
        }

        /* Help Content Styles */
        .help-wrapper {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .help-section {
            background: var(--color-surface);
            border-radius: 22px;
            border: 1px solid rgba(79, 138, 62, 0.12);
            box-shadow: 0 18px 32px rgba(79, 138, 62, 0.12);
            padding: 28px 30px;
        }

        .help-section h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--color-text);
        }

        .help-section p {
            color: var(--color-muted);
            font-size: 14px;
            margin-bottom: 16px;
        }

        .faq-list {
            display: grid;
            gap: 18px;
        }

        .faq-item {
            border-radius: 16px;
            border: 1px solid rgba(79, 138, 62, 0.1);
            padding: 18px 20px;
            background: rgba(255, 255, 255, 0.85);
        }

        .faq-question {
            font-size: 15px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 6px;
        }

        .faq-answer {
            font-size: 13px;
            color: var(--color-muted);
            line-height: 1.6;
        }

        .support-grid {
            display: grid;
            gap: 18px;
        }

        .support-card {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            padding: 18px 20px;
            border-radius: 18px;
            border: 1px solid rgba(79, 138, 62, 0.12);
            background: var(--color-surface-alt);
        }

        .support-icon {
            width: 40px;
            height: 40px;
            border-radius: 14px;
            background: rgba(79, 138, 62, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .support-card h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 4px;
        }

        .support-card p {
            font-size: 13px;
            color: var(--color-muted);
            margin: 0;
        }

        .shortcut-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .shortcut-card {
            border-radius: 18px;
            padding: 18px 20px;
            border: 1px solid rgba(79, 138, 62, 0.12);
            background: var(--color-surface);
            transition: transform 0.2s ease;
        }

        .shortcut-card:hover {
            transform: translateY(-4px);
        }

        .shortcut-card span {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: rgba(33, 56, 33, 0.6);
            margin-bottom: 8px;
        }

        .shortcut-card strong {
            font-size: 15px;
            color: var(--color-text);
        }

        .shortcut-card p {
            font-size: 13px;
            color: var(--color-muted);
            margin-top: 8px;
        }

        .chat-assistant {
            display: grid;
            gap: 20px;
        }

        .chat-window {
            border-radius: 20px;
            border: 1px solid rgba(79, 138, 62, 0.16);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 20px 40px rgba(79, 138, 62, 0.14);
            padding: 22px;
            display: grid;
            gap: 16px;
        }

        .chat-messages {
            display: grid;
            gap: 14px;
            max-height: 380px;
            overflow-y: auto;
            padding-right: 8px;
        }

        .chat-message {
            display: grid;
            gap: 8px;
            align-items: flex-start;
        }

        .chat-message.user {
            justify-items: end;
        }

        .chat-bubble {
            padding: 12px 14px;
            border-radius: 16px;
            font-size: 14px;
            line-height: 1.6;
            white-space: pre-wrap;
            box-shadow: 0 12px 24px rgba(79, 138, 62, 0.12);
            background: rgba(79, 138, 62, 0.08);
            color: var(--color-text);
            width: fit-content;
        }

        .chat-message.assistant .chat-bubble {
            background: var(--color-surface-alt);
            box-shadow: 0 12px 32px rgba(79, 138, 62, 0.1);
        }

        .chat-message.user .chat-bubble {
            background: var(--color-accent);
            color: #ffffff;
            box-shadow: 0 12px 30px rgba(79, 138, 62, 0.24);
        }

        .chat-message.pending .chat-bubble {
            opacity: 0.7;
        }

        .chat-message.error .chat-bubble {
            background: rgba(220, 53, 69, 0.14);
            color: var(--color-danger-dark);
            box-shadow: 0 12px 30px rgba(220, 53, 69, 0.18);
        }

        .chat-status {
            font-size: 12px;
            color: var(--color-muted);
        }

        .chat-form {
            display: grid;
            gap: 12px;
        }

        .chat-input-group {
            display: grid;
            gap: 10px;
        }

        .chat-textarea {
            width: 100%;
            min-height: 80px;
            border-radius: 14px;
            border: 1px solid rgba(79, 138, 62, 0.18);
            padding: 12px 14px;
            font-size: 14px;
            resize: vertical;
            font-family: inherit;
            background: rgba(255, 255, 255, 0.92);
        }

        .chat-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            align-items: center;
        }

        .chat-suggestions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chat-suggestion {
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid rgba(79, 138, 62, 0.2);
            background: rgba(79, 138, 62, 0.08);
            color: var(--color-accent-dark);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .chat-suggestion:hover {
            background: rgba(79, 138, 62, 0.14);
        }

        .chat-submit {
            padding: 10px 16px;
            border-radius: 14px;
            border: none;
            background: var(--color-accent);
            color: white;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 18px 28px rgba(79, 138, 62, 0.22);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .chat-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 20px 32px rgba(79, 138, 62, 0.26);
        }

        .chat-submit:disabled {
            cursor: not-allowed;
            opacity: 0.7;
            box-shadow: none;
            transform: none;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>
            
            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">🏠</span>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('recipes.index') }}" class="nav-item {{ request()->routeIs('recipes.*') ? 'active' : '' }}">
                    <span class="nav-icon">🍳</span>
                    <span>Recipes</span>
                </a>
                
                <a href="{{ route('meal-plans.index') }}" class="nav-item {{ request()->routeIs('meal-plans.*') ? 'active' : '' }}">
                    <span class="nav-icon">📋</span>
                    <span>Meal plans</span>
                </a>

                <a href="{{ route('bmi') }}" class="nav-item {{ request()->routeIs('bmi') ? 'active' : '' }}">
                    <span class="nav-icon">⚖️</span>
                    <span>BMI</span>
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="logout-btn">
                @csrf
                <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer;">
                    <span class="nav-icon">🚪</span>
                    <span>Log out</span>
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Help Button -->
        <button class="help-btn" id="helpBtn">
            <span class="help-btn-icon" style="color: white; font-size: 32px; font-weight: bold;">?</span>
        </button>
    </div>

    <!-- Help Modal -->
    <div class="help-modal" id="helpModal">
        <div class="help-modal-content">
            <div class="help-modal-header">
                <h2>Help & Support</h2>
                <button class="help-modal-close" id="helpModalClose">×</button>
            </div>
            <div class="help-modal-body" id="helpModalBody">
                <div class="help-wrapper">
                    <section class="help-section chat-assistant">
                        <div>
                            <h2>AI guidance</h2>
                            <p>Ask the Diet Plan assistant anything about recipes, meal plans, troubleshooting, or how to use the system.</p>
                        </div>
                        <div class="chat-window">
                            <div id="chatMessages" class="chat-messages"></div>
                            <div id="chatStatus" class="chat-status">Assistant typically replies within a few seconds.</div>
                            <form id="chatForm" class="chat-form" autocomplete="off">
                                <div class="chat-input-group">
                                    <textarea id="chatInput" class="chat-textarea" placeholder="Type your question..." required></textarea>
                                    <div class="chat-actions">
                                        <button type="submit" class="chat-submit">Send</button>
                                    </div>
                                </div>
                                <div class="chat-suggestions">
                                    <button type="button" class="chat-suggestion" data-chat-suggestion="How can I troubleshoot missing recipes on my dashboard?">Troubleshoot missing recipes</button>
                                    <button type="button" class="chat-suggestion" data-chat-suggestion="Guide me through creating a weekly meal plan.">Create a weekly plan</button>
                                    <button type="button" class="chat-suggestion" data-chat-suggestion="What should I do if I run into a seeding error?">Fix seeding errors</button>
                                    <button type="button" class="chat-suggestion" data-chat-suggestion="Show me how to duplicate an existing meal plan.">Duplicate meal plan</button>
                                </div>
                            </form>
                        </div>
                    </section>

                    <section class="help-section">
                        <h2>Quick shortcuts</h2>
                        <p>Jump directly to the most common areas when you manage your recipes and meal plans.</p>
                        <div class="shortcut-grid">
                            <div class="shortcut-card">
                                <span>Recipes</span>
                                <strong>View or edit a recipe</strong>
                                <p>Head to your recipe list to update ingredients, instructions, or add a new Filipino dish.</p>
                            </div>
                            <div class="shortcut-card">
                                <span>Meal plans</span>
                                <strong>Adjust this weeks plan</strong>
                                <p>Review the meals scheduled for the week and tweak serving sizes to fit your goals.</p>
                            </div>
                            <div class="shortcut-card">
                                <span>Support</span>
                                <strong>Contact our team</strong>
                                <p>Need more help? Reach us using the channels below so we can guide you personally.</p>
                            </div>
                        </div>
                    </section>

                    <section class="help-section">
                        <h2>Frequently asked questions</h2>
                        <p>Browse quick answers to the topics we get asked about the most.</p>
                        <div class="faq-list">
                            <div class="faq-item">
                                <div class="faq-question">How do I add a new recipe?</div>
                                <div class="faq-answer">Go to the Recipes page and click the Create Recipe button. Fill in the title, upload an optional photo, add ingredients and instructions, then save. The recipe will immediately appear on your dashboard.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Can I duplicate a meal plan?</div>
                                <div class="faq-answer">Yes. Open an existing meal plan, choose Duplicate, and a copy will be created so you can adjust meals without editing the original plan.</div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">Why don't I see my new recipes?</div>
                                <div class="faq-answer">If you recently seeded the database, make sure you ran the `php artisan db:seed --class=RecipeSeeder` command and refresh the Recipes page. Still missing? Re-run the seeder or check your database connection.</div>
                            </div>
                        </div>
                    </section>

                    <section class="help-section">
                        <h2>Contact support</h2>
                        <p>Get in touch with us if you need deeper assistance or want to request a new feature.</p>
                        <div class="support-grid">
                            <div class="support-card">
                                <div class="support-icon">💬</div>
                                <div>
                                    <h3>Live chat</h3>
                                    <p>Chat with us weekdays from 9AM to 6PM PST for quick troubleshooting.</p>
                                </div>
                            </div>
                            <div class="support-card">
                                <div class="support-icon">✉️</div>
                                <div>
                                    <h3>Email support</h3>
                                    <p>Send questions to loquinariojepoy7@gmail.com and well get back within 24 hours.</p>
                                </div>
                            </div>
                            <div class="support-card">
                                <div class="support-icon">📘</div>
                                <div>
                                    <h3>Documentation</h3>
                                    <p>Visit our knowledge base for step-by-step guides on recipes, meal plans, and more.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @yield('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const helpBtn = document.getElementById('helpBtn');
            const helpModal = document.getElementById('helpModal');
            const helpModalClose = document.getElementById('helpModalClose');

            // Initialize help chat when modal opens
            let chatInitialized = false;

            // Initialize help chat functionality
            function initializeHelpChat() {
                const chatMessages = document.getElementById('chatMessages');
                const chatForm = document.getElementById('chatForm');
                const chatInput = document.getElementById('chatInput');
                const chatStatus = document.getElementById('chatStatus');
                const suggestionButtons = document.querySelectorAll('[data-chat-suggestion]');

                if (!chatMessages || !chatForm || !chatInput) {
                    return;
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const conversation = [
                    {
                        role: 'assistant',
                        content: 'Hey there! I\'m your Diet Plan assistant. Ask me anything about using the system, troubleshooting issues, or planning meals, and I\'ll guide you step-by-step.'
                    }
                ];

                let isSending = false;

                function renderMessages() {
                    chatMessages.innerHTML = '';
                    conversation.forEach((message) => {
                        const wrapper = document.createElement('div');
                        wrapper.classList.add('chat-message', message.role);
                        if (message.pending) {
                            wrapper.classList.add('pending');
                        }
                        if (message.error) {
                            wrapper.classList.add('error');
                        }

                        const bubble = document.createElement('div');
                        bubble.classList.add('chat-bubble');
                        bubble.textContent = message.content;

                        wrapper.appendChild(bubble);
                        chatMessages.appendChild(wrapper);
                    });

                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }

                async function sendMessage(prompt) {
                    if (isSending) {
                        return;
                    }

                    const trimmedPrompt = prompt.trim();
                    if (!trimmedPrompt) {
                        return;
                    }

                    const userEntry = {
                        role: 'user',
                        content: trimmedPrompt
                    };
                    conversation.push(userEntry);
                    renderMessages();

                    const payloadHistory = conversation.filter((message) => message !== userEntry && !message.pending);

                    const pendingEntry = {
                        role: 'assistant',
                        content: 'Thinking through the best answer for you…',
                        pending: true
                    };
                    conversation.push(pendingEntry);
                    renderMessages();

                    chatStatus.textContent = 'Assistant is typing…';
                    chatInput.value = '';
                    chatInput.focus();
                    isSending = true;
                    chatForm.classList.add('is-sending');

                    try {
                        const response = await fetch('{{ route('help.chat') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            credentials: 'same-origin',
                            body: JSON.stringify({
                                message: trimmedPrompt,
                                history: payloadHistory,
                            }),
                        });

                        let data = null;
                        try {
                            data = await response.json();
                        } catch (parseError) {
                            // If the backend did not return JSON, fall back to a generic message
                        }

                        if (!response.ok) {
                            const backendMessage = data && data.reply ? data.reply : 'The AI service returned an unexpected error.';
                            pendingEntry.content = backendMessage;
                            pendingEntry.pending = false;
                            pendingEntry.error = true;
                            return;
                        }

                        pendingEntry.content = (data && data.reply) || 'I could not determine a helpful answer right now.';
                        pendingEntry.pending = false;
                        pendingEntry.error = false;
                    } catch (error) {
                        pendingEntry.content = 'I ran into an issue reaching the AI service. Please try again in a moment or contact support.';
                        pendingEntry.pending = false;
                        pendingEntry.error = true;
                    } finally {
                        renderMessages();
                        chatStatus.textContent = 'Need anything else? I\'m here to help.';
                        isSending = false;
                        chatForm.classList.remove('is-sending');
                    }
                }

                chatForm.addEventListener('submit', (event) => {
                    event.preventDefault();
                    if (!chatInput.value.trim()) {
                        return;
                    }
                    sendMessage(chatInput.value);
                });

                suggestionButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        if (isSending) {
                            return;
                        }
                        const prompt = button.getAttribute('data-chat-suggestion');
                        sendMessage(prompt);
                    });
                });

                renderMessages();
            }

            // Open modal
            helpBtn.addEventListener('click', () => {
                helpModal.classList.add('active');
                if (!chatInitialized) {
                    setTimeout(() => {
                        initializeHelpChat();
                        chatInitialized = true;
                    }, 100);
                }
            });

            // Close modal
            helpModalClose.addEventListener('click', () => {
                helpModal.classList.remove('active');
            });

            // Close modal when clicking outside
            helpModal.addEventListener('click', (e) => {
                if (e.target === helpModal) {
                    helpModal.classList.remove('active');
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && helpModal.classList.contains('active')) {
                    helpModal.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
