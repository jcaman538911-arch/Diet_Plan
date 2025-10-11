@extends('layouts.app')

@section('title', 'Help & Support - Diet Plan System')

@section('styles')
<style>
    .help-wrapper {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .help-hero {
        padding: 40px;
        border-radius: 26px;
        background: linear-gradient(135deg, rgba(99, 173, 99, 0.15), rgba(79, 138, 62, 0.4));
        border: 1px solid rgba(79, 138, 62, 0.18);
        box-shadow: 0 28px 44px rgba(79, 138, 62, 0.16);
        color: var(--color-text);
    }

    .help-hero h1 {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .help-hero p {
        max-width: 480px;
        color: rgba(33, 56, 33, 0.78);
        font-size: 15px;
    }

    .help-sections {
        display: grid;
        gap: 24px;
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
</style>
@endsection

@section('content')
<div class="help-wrapper">
    <section class="help-hero">
        <h1>Need a hand?</h1>
        <p>Find quick answers, tips, and ways to reach us so you can keep planning meals without interruption.</p>
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
                <div class="faq-answer">Go to the Recipes page and click the Create Recipe button. Fill in the title, upload an optional photo, add ingredients and instructions, then save. The recipe will immediately appear on your dashboard.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">Can I duplicate a meal plan?</div>
                <div class="faq-answer">Yes. Open an existing meal plan, choose Duplicate, and a copy will be created so you can adjust meals without editing the original plan.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">Why dont I see my new recipes?</div>
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
@endsection
