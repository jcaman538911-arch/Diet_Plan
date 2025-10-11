@extends('landing.layout')

@section('title', 'Nutrition Guides & Tips | Diet Plan Studio')

@section('styles')
<style>
    .tips-wrapper {
        display: grid;
        gap: 40px;
    }

    .tips-section {
        background: var(--card);
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 24px 48px var(--shadow);
        border: 1px solid rgba(79, 138, 62, 0.12);
        display: grid;
        gap: 20px;
    }

    .tips-section h2 {
        font-size: 22px;
    }

    .tips-list {
        list-style: none;
        display: grid;
        gap: 14px;
        color: var(--muted);
        font-size: 14px;
    }

    .tips-list li {
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    .tips-list span {
        color: var(--primary);
        font-weight: 700;
    }

    .label-card {
        background: rgba(79, 138, 62, 0.08);
        border-radius: 20px;
        padding: 24px;
        display: grid;
        gap: 12px;
    }

    .idea-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 18px;
    }

    .idea-card {
        background: rgba(79, 138, 62, 0.12);
        padding: 20px;
        border-radius: 18px;
        font-size: 14px;
        color: rgba(20, 48, 24, 0.8);
    }
</style>
@endsection

@section('content')
<div class="tips-wrapper">
    <section class="tips-section">
        <h2>10 Tips for a Balanced Diet</h2>
        <ul class="tips-list">
            <li><span>01</span> Fill half your plate with colorful vegetables and fruits.</li>
            <li><span>02</span> Choose whole grains—brown rice, quinoa, and oats—for steady energy.</li>
            <li><span>03</span> Include lean proteins at each meal to support muscle and satiety.</li>
            <li><span>04</span> Hydrate consistently; aim for at least 8 glasses of water daily.</li>
            <li><span>05</span> Plan healthy snacks (nuts, yogurt, fruit) to avoid impulse cravings.</li>
            <li><span>06</span> Listen to hunger cues: eat when hungry, stop when satisfied.</li>
            <li><span>07</span> Limit added sugar and heavily processed foods.</li>
            <li><span>08</span> Add healthy fats (avocado, olive oil, salmon) for heart health.</li>
            <li><span>09</span> Prioritize good sleep—your appetite hormones depend on it.</li>
            <li><span>10</span> Celebrate progress; small, consistent habits matter most.</li>
        </ul>
    </section>

    <section class="tips-section">
        <h2>How to Read Nutrition Labels</h2>
        <div class="label-card">
            <p>Nutrition labels are the quickest way to understand what’s in your food.</p>
            <ul class="tips-list" style="gap: 10px;">
                <li><span>Serving size:</span> Check the serving size first—it affects all the numbers.</li>
                <li><span>Calories:</span> Note calories per serving, not per package.</li>
                <li><span>Macros:</span> Balance carbs, protein, and fat to match your goals.</li>
                <li><span>Ingredients:</span> Shorter lists with recognizable ingredients are typically better.</li>
            </ul>
        </div>
    </section>

    <section class="tips-section">
        <h2>Meal Prep Ideas</h2>
        <p class="section-description" style="margin-bottom: 12px;">Pick a combo from each column to build a week of balanced meals.</p>
        <div class="idea-grid">
            <div class="idea-card">
                <strong>Proteins</strong>
                <p>Chicken breast, tofu, lentils, salmon, turkey meatballs</p>
            </div>
            <div class="idea-card">
                <strong>Carbs</strong>
                <p>Quinoa, brown rice, sweet potatoes, whole wheat pasta</p>
            </div>
            <div class="idea-card">
                <strong>Veggies</strong>
                <p>Broccoli, bell peppers, spinach, cauliflower, zucchini</p>
            </div>
            <div class="idea-card">
                <strong>Extras</strong>
                <p>Homemade vinaigrette, hummus, nuts, seeds, herb blends</p>
            </div>
        </div>
    </section>
</div>
@endsection
