@extends('landing.layout')

@section('title', 'Sample Diet Plan | Diet Plan Studio')

@section('styles')
<style>
    .result-grid {
        display: grid;
        gap: 32px;
    }

    .summary-card {
        background: var(--card);
        border-radius: 22px;
        padding: 32px;
        box-shadow: 0 24px 48px var(--shadow);
        border: 1px solid rgba(79, 138, 62, 0.12);
    }

    .macro-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .macro-pill {
        padding: 16px;
        border-radius: 16px;
        background: rgba(79, 138, 62, 0.1);
    }

    .meal-plan {
        display: grid;
        gap: 22px;
    }

    .meal-card {
        background: var(--card);
        border-radius: 20px;
        padding: 26px;
        box-shadow: 0 20px 40px var(--shadow);
        border: 1px solid rgba(79, 138, 62, 0.1);
    }

    .meal-card h3 {
        font-size: 18px;
        margin-bottom: 12px;
    }

    .cta-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
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
    }

    .btn-secondary:hover {
        border-color: var(--primary);
    }
</style>
@endsection

@section('content')
<section class="result-grid">
    <div class="summary-card">
        <h1 class="section-title">Your personalized nutrition snapshot</h1>
        <p class="section-description">Based on your stats and activity, this sample plan keeps you energized and on track. Adjust meals anytime to fit cravings or schedule.</p>

        <div style="margin-top: 24px;">
            <h2 style="font-size: 28px; font-weight: 700;">2,150 kcal / day</h2>
            <p style="color: var(--muted);">*Goal: Maintain weight — includes a slight deficit for leaner composition.</p>
        </div>

        <div class="macro-grid">
            <div class="macro-pill">
                <strong>45% Carbs</strong>
                <p style="color: var(--muted); font-size: 14px;">~240g per day from whole grains, fruits, and vegetables.</p>
            </div>
            <div class="macro-pill">
                <strong>30% Protein</strong>
                <p style="color: var(--muted); font-size: 14px;">~160g to maintain muscle and support recovery.</p>
            </div>
            <div class="macro-pill">
                <strong>25% Fats</strong>
                <p style="color: var(--muted); font-size: 14px;">~60g from avocado, nuts, seeds, and healthy oils.</p>
            </div>
        </div>
    </div>

    <div class="meal-plan">
        <div class="meal-card">
            <h3>🍳 Breakfast</h3>
            <p>Oatmeal with banana slices, peanut butter swirl, and chia seeds.</p>
        </div>
        <div class="meal-card">
            <h3>🥗 Lunch</h3>
            <p>Grilled chicken breast, brown rice, roasted broccoli, and side salad with olive oil vinaigrette.</p>
        </div>
        <div class="meal-card">
            <h3>🍎 Snack</h3>
            <p>Greek yogurt parfait with apple, walnuts, and cinnamon.</p>
        </div>
        <div class="meal-card">
            <h3>🍝 Dinner</h3>
            <p>Tuna pasta with cherry tomatoes, spinach, and mixed greens salad.</p>
        </div>
    </div>

    <div class="cta-actions">
        <a href="#" class="btn-primary">Save Plan</a>
        <a href="#" class="btn-secondary">Download as PDF</a>
        <a href="{{ route('landing.planner') }}" class="btn-secondary">Recalculate</a>
    </div>
</section>
@endsection
