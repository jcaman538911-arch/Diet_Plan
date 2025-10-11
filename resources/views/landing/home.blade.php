@extends('landing.layout')

@section('title', 'Eat Smart. Live Strong. | Diet Plan Studio')

@section('content')
<section class="hero" style="margin-bottom: 80px;">
    <div class="hero-copy">
        <h1>Eat Smart. Live Strong.</h1>
        <p>Build a custom nutrition roadmap that matches your fitness goals and food preferences. Daily calories, balanced meals, and smart tips—delivered in seconds.</p>
        <div style="display: flex; gap: 16px; flex-wrap: wrap;">
            <a href="{{ route('landing.planner') }}" class="btn-primary">Start Your Plan</a>
            <a href="{{ route('landing.result') }}" class="btn-primary" style="background: rgba(79, 138, 62, 0.12); color: var(--primary); box-shadow: none;">Preview Meal Plan</a>
        </div>
    </div>
    <div class="hero-img"></div>
</section>

<section style="margin-bottom: 80px;">
    <h2 class="section-title">Why Diet Plan Studio?</h2>
    <p class="section-description">We combine smart nutrition guidance with beautiful visuals so planning meals never feels overwhelming. Track progress, personalize macros, and stay motivated.</p>
    <div class="feature-grid">
        <div class="feature-card">
            <h3>Personalized Targets</h3>
            <p>We calculate caloric needs based on body data, activity level, and goals to keep you on the right path.</p>
        </div>
        <div class="feature-card">
            <h3>Chef-Approved Meals</h3>
            <p>Choose from balanced, vegan, keto, or high-protein dishes crafted for nutrition and flavor.</p>
        </div>
        <div class="feature-card">
            <h3>Progress Insights</h3>
            <p>Log weight, meals, and daily calories to see charts that highlight your improvement over time.</p>
        </div>
        <div class="feature-card">
            <h3>Expert Guidance</h3>
            <p>Follow our tips on mindful eating, grocery planning, and portion control to reinforce healthy habits.</p>
        </div>
    </div>
</section>

<section style="margin-bottom: 80px;">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 28px; align-items: center;">
        <div style="background: var(--card); padding: 32px; border-radius: 26px; box-shadow: 0 24px 48px var(--shadow); border: 1px solid rgba(79, 138, 62, 0.12);">
            <h3 style="font-size: 22px; margin-bottom: 16px;">Built for every lifestyle</h3>
            <ul style="list-style: none; display: grid; gap: 12px; color: var(--muted); font-size: 14px;">
                <li>✓ Athletes who need recovery fuel</li>
                <li>✓ Busy professionals looking for quick meal ideas</li>
                <li>✓ Beginners focused on sustainable weight loss</li>
                <li>✓ Families planning balanced weekly menus</li>
            </ul>
        </div>
        <div style="display: flex; flex-direction: column; gap: 18px;">
            <div style="background: linear-gradient(135deg, rgba(79, 138, 62, 0.15), rgba(79, 138, 62, 0.35)); padding: 28px; border-radius: 24px;">
                <p style="font-weight: 600; font-size: 18px;">“I finally have a plan that adapts to my busy schedule. The meals are delicious and I feel better every day.”</p>
                <span style="color: rgba(20, 48, 24, 0.7); font-size: 14px;">— Bianca, marathon runner</span>
            </div>
            <div style="background: var(--card); padding: 28px; border-radius: 24px; box-shadow: 0 18px 36px var(--shadow); border: 1px solid rgba(79, 138, 62, 0.1);">
                <p style="color: var(--muted); font-size: 14px;">Ready to begin? Start with your body stats, pick a goal, and we’ll craft a plan with calorie targets, macros, and recipes.</p>
                <a href="{{ route('landing.planner') }}" class="btn-primary" style="margin-top: 16px; align-self: flex-start;">Start Your Plan</a>
            </div>
        </div>
    </div>
</section>
@endsection
