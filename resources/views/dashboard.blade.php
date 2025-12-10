@extends('layouts.app')

@section('title', 'Dashboard - Diet Plan System')

@section('styles')
<style>
    .dashboard-wrapper {
        display: flex;
        flex-direction: column;
        gap: 40px;
        width: 100%;
        max-width: 960px;
        margin: 0 auto;
    }

    .dashboard-hero {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 24px;
        padding: 36px 40px;
        border-radius: 26px;
        background: linear-gradient(135deg, rgba(99, 173, 99, 0.15), rgba(79, 138, 62, 0.45));
        border: 1px solid rgba(79, 138, 62, 0.25);
        box-shadow: 0 32px 54px rgba(79, 138, 62, 0.18);
        text-align: center;
    }

    .hero-text h1 {
        font-size: 32px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 10px;
    }

    .hero-text p {
        color: rgba(33, 56, 33, 0.85);
        font-size: 15px;
        max-width: 460px;
        margin: 0 auto;
    }

    .hero-meta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 14px;
        padding: 8px 14px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.55);
        border: 1px solid rgba(79, 138, 62, 0.25);
        font-size: 13px;
        color: rgba(33, 56, 33, 0.8);
        font-weight: 600;
    }

    .hero-meta .meta-separator {
        opacity: 0.5;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 22px;
        width: 100%;
    }

    .stat-card {
        background: var(--color-surface);
        padding: 28px;
        border-radius: 22px;
        box-shadow: 0 24px 48px rgba(79, 138, 62, 0.14);
        border: 1px solid rgba(79, 138, 62, 0.12);
        position: relative;
        display: flex;
        gap: 18px;
        align-items: center;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        background: rgba(79, 138, 62, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--color-accent);
        flex-shrink: 0;
    }

    .stat-details h3 {
        font-size: 13px;
        color: var(--color-muted);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.45px;
    }

    .stat-details .number {
        font-size: 36px;
    }

    .section-header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--color-text);
    }

    .section-subtitle {
        font-size: 13px;
        color: var(--color-muted);
    }

    .recipe-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        width: 100%;
    }

    .recipe-card {
        background: var(--color-surface);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 22px 36px rgba(79, 138, 62, 0.14);
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(79, 138, 62, 0.12);
    }

    .recipe-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .recipe-placeholder {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        background: var(--color-surface-alt);
    }

    .recipe-card-content {
        padding: 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .recipe-card-content h3 {
        font-size: 18px;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 8px;
    }

    .recipe-meta {
        font-size: 13px;
        color: var(--color-muted);
        margin-bottom: 15px;
    }

    .recipe-description {
        font-size: 14px;
        color: var(--color-muted);
        margin-bottom: 20px;
        flex: 1;
    }

    .card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .action-links {
        display: flex;
        gap: 10px;
    }

    .action-links a {
        color: var(--color-accent);
        font-weight: 600;
        text-decoration: none;
        font-size: 14px;
    }

    .action-links a:hover {
        text-decoration: underline;
    }

    .recipe-card {
        background: var(--color-surface);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 18px 34px rgba(79, 138, 62, 0.14);
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid rgba(79, 138, 62, 0.1);
    }

    .recipe-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 22px 36px rgba(79, 138, 62, 0.22);
    }

    .recipe-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        background: #f0f0f0;
    }

    .recipe-content {
        padding: 22px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .recipe-title {
        font-size: 17px;
        font-weight: 600;
        color: var(--color-text);
        margin: 0;
    }

    .recipe-meta {
        font-size: 13px;
        color: var(--color-muted);
    }

    .recipe-actions {
        display: flex;
        gap: 10px;
        margin-top: 6px;
    }

    .recipe-actions a {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: var(--color-accent);
    }

    .empty-state {
        text-align: center;
        padding: 80px 24px;
        background: var(--color-surface);
        border-radius: 22px;
        border: 1px dashed rgba(79, 138, 62, 0.3);
        box-shadow: inset 0 0 0 1px rgba(79, 138, 62, 0.08), 0 24px 42px rgba(79, 138, 62, 0.08);
    }

    .empty-state-icon {
        font-size: 68px;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 22px;
        color: var(--color-text);
        margin-bottom: 12px;
        font-weight: 700;
    }

    .empty-state p {
        color: var(--color-muted);
        margin-bottom: 22px;
    }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">
    <section class="dashboard-hero">
        <div class="hero-text">
            <h1>Welcome back, {{ auth()->user()->name }}! 👋</h1>
            <p>Keep track of your Filipino recipes and meal plans in one clean view.</p>
            <div class="hero-meta">
                <span id="dashboard-date">Loading date…</span>
                <span class="meta-separator">•</span>
                <span id="dashboard-time">Loading time…</span>
            </div>
        </div>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <h3>Total Recipes</h3>
            <div class="stat-content">
                <p class="stat-number">{{ $recipesCount }}</p>
                <div class="stat-icon">🍲</div>
            </div>
        </div>

        <div class="stat-card">
            <h3>Meal Plans</h3>
            <div class="stat-content">
                <p class="stat-number">{{ $mealPlansCount }}</p>
                <div class="stat-icon">🗂️</div>
            </div>
        </div>

        <div class="stat-card">
            <h3>New This Week</h3>
            <div class="stat-content">
                <p class="stat-number">{{ $recentRecipes->count() }}</p>
                <div class="stat-icon">🕒</div>
            </div>
        </div>
    </section>

    <style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .stat-card {
        background: #fff;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 3px 6px rgba(0,0,0,0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 12px rgba(0,0,0,0.1);
    }

    .stat-card h3 {
        font-size: 1rem;
        color: #666;
        margin: 0 0 1rem 0;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
        padding: 0 1rem;
    }
    
    .stat-icon {
        font-size: 2.2rem;
        color: #4a90e2;
        margin: 0;
        display: flex;
        align-items: flex-end;
        margin-left: auto;
    }

    .stat-number {
        font-size: 2.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        line-height: 1;
        margin-right: auto;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-card {
            padding: 1.5rem 1rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
    }
    </style>

    <section>
        <div class="section-header" style="margin-bottom: 20px;">
            <div>
                <h2 class="section-title">Recent Recipes</h2>
                <div class="section-subtitle">Fresh additions you’ve created or updated lately.</div>
            </div>
            <a href="{{ route('recipes.index') }}" class="btn btn-secondary">View All</a>
        </div>

        @if($recentRecipes->count() > 0)
            <div class="recipe-grid">
                @foreach($recentRecipes as $recipe)
                    <div class="recipe-card">
                        @if($recipe->image_url)
                            <img src="{{ $recipe->image_url }}" alt="{{ $recipe->name }}" class="recipe-image">
                        @else
                            <div class="recipe-image" style="display: flex; align-items: center; justify-content: center; font-size: 48px; color: rgba(79, 138, 62, 0.6);">
                                🍽️
                            </div>
                        @endif
                        <div class="recipe-content">
                            <div class="recipe-title">{{ $recipe->name }}</div>
                            <div class="recipe-meta">
                                {{ $recipe->servings }} servings • {{ ucfirst($recipe->category) }} • {{ $recipe->calories }} kcal
                            </div>
                            @if($recipe->description)
                                <div class="recipe-description">{{ \Illuminate\Support\Str::limit($recipe->description, 90) }}</div>
                            @endif
                            <div class="recipe-meta">
                                Added {{ optional($recipe->created_at)->diffForHumans() ?? 'recently' }}
                            </div>
                            <div class="recipe-actions">
                                <a href="{{ route('recipes.show', $recipe) }}">View</a>
                                <a href="{{ route('recipes.edit', $recipe) }}">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">🍳</div>
                <h3>No recipes yet</h3>
                <p>Start by creating your first recipe and build a flavorful meal plan.</p>
                <a href="{{ route('recipes.create') }}" class="btn btn-primary">Create Recipe</a>
            </div>
        @endif
    </section>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateEl = document.getElementById('dashboard-date');
        const timeEl = document.getElementById('dashboard-time');

        function updateDateTime() {
            const now = new Date();
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };

            if (dateEl) {
                dateEl.textContent = now.toLocaleDateString(undefined, dateOptions);
            }

            if (timeEl) {
                timeEl.textContent = now.toLocaleTimeString(undefined, timeOptions);
            }
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    });
</script>
@endsection
