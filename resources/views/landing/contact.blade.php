@extends('landing.layout')

@section('title', 'Get in Touch | Diet Plan Studio')

@section('styles')
<style>
    .contact-wrapper {
        display: grid;
        gap: 32px;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        align-items: start;
    }

    .contact-card {
        background: var(--card);
        border-radius: 24px;
        padding: 36px;
        box-shadow: 0 28px 48px var(--shadow);
        border: 1px solid rgba(79, 138, 62, 0.12);
        display: grid;
        gap: 20px;
    }

    label {
        font-weight: 600;
        font-size: 14px;
    }

    input,
    textarea {
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid rgba(79, 138, 62, 0.25);
        background: #fff;
        font-size: 14px;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .contact-info {
        display: grid;
        gap: 18px;
    }

    .info-item {
        background: rgba(79, 138, 62, 0.08);
        padding: 18px;
        border-radius: 18px;
        font-size: 14px;
        color: rgba(20, 48, 24, 0.8);
    }

    .login-card {
        display: grid;
        gap: 16px;
        background: linear-gradient(135deg, rgba(79, 138, 62, 0.12), rgba(79, 138, 62, 0.32));
        border-radius: 24px;
        padding: 32px;
    }

    .btn-secondary {
        padding: 10px 24px;
        background: transparent;
        color: var(--primary);
        border: 1px solid rgba(79, 138, 62, 0.4);
        border-radius: 999px;
        font-weight: 600;
        text-decoration: none;
        transition: border-color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-secondary:hover {
        border-color: var(--primary);
    }
</style>
@endsection

@section('content')
<section style="margin-bottom: 50px;">
    <h1 class="section-title">Let’s build your healthiest routine</h1>
    <p class="section-description">Reach out for support, partnership opportunities, or to share success stories. Prefer to manage your plans? Log in and keep progressing.</p>
</section>

<div class="contact-wrapper">
    <form class="contact-card">
        <h2 style="font-size: 20px;">Drop us a message</h2>
        <div style="display: grid; gap: 18px;">
            <div>
                <label for="contact-name">Name</label>
                <input type="text" id="contact-name" placeholder="Your full name">
            </div>
            <div>
                <label for="contact-email">Email</label>
                <input type="email" id="contact-email" placeholder="you@example.com">
            </div>
            <div>
                <label for="contact-message">Message</label>
                <textarea id="contact-message" placeholder="How can we help?"></textarea>
            </div>
        </div>
        <button type="submit" class="btn-primary" style="justify-self: flex-start;">Send message</button>
    </form>

    <div class="contact-card" style="gap: 24px;">
        <div class="contact-info">
            <div class="info-item">📧 support@dietplanstudio.com</div>
            <div class="info-item">📍 San Francisco, CA</div>
            <div class="info-item">🕒 Mon–Fri, 9:00 AM - 5:00 PM PST</div>
        </div>
        <div class="login-card">
            <h3 style="font-size: 18px;">Already tracking your plan?</h3>
            <p style="color: rgba(20, 48, 24, 0.75); font-size: 14px;">Log in to sync your latest meals, adjust goals, and download updated meal plans.</p>
            <a href="{{ route('login') }}" class="btn-primary">Sign In</a>
            <span style="font-size: 13px; color: rgba(20, 48, 24, 0.7);">New to Diet Plan Studio? <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Create an account</a>.</span>
        </div>
    </div>
</div>
@endsection
