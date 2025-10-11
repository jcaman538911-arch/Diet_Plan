@extends('landing.layout')

@section('title', 'Build Your Diet Plan | Diet Plan Studio')

@section('styles')
<style>
    .planner-wrapper {
        display: grid;
        gap: 32px;
    }

    .planner-card {
        background: var(--card);
        border-radius: 24px;
        padding: 36px;
        box-shadow: 0 28px 52px var(--shadow);
        border: 1px solid rgba(79, 138, 62, 0.14);
        display: grid;
        gap: 28px;
    }

    .form-grid {
        display: grid;
        gap: 24px;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    label {
        font-weight: 600;
        font-size: 14px;
    }

    input,
    select {
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid rgba(79, 138, 62, 0.25);
        background: #fff;
        font-size: 14px;
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(79, 138, 62, 0.18);
    }

    .sliders {
        display: grid;
        gap: 24px;
    }

    .slider-group {
        display: grid;
        gap: 8px;
    }

    .slider-group input[type="range"] {
        accent-color: var(--primary);
    }

    .cta-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        align-items: center;
        justify-content: space-between;
        background: rgba(79, 138, 62, 0.08);
        padding: 24px;
        border-radius: 18px;
    }

    .cta-bar p {
        color: var(--muted);
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div class="planner-wrapper">
    <section>
        <h1 class="section-title">Tell us about your goals</h1>
        <p class="section-description">Answer a few quick questions so we can calculate your calories, macros, and best-fit meals. You can always tweak your plan later.</p>
    </section>

    <form class="planner-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Full name</label>
                <input type="text" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" min="10" max="100" placeholder="27">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender">
                    <option value="">Select gender</option>
                    <option>Female</option>
                    <option>Male</option>
                    <option>Non-binary</option>
                    <option>Prefer not to say</option>
                </select>
            </div>
            <div class="form-group">
                <label for="height">Height (cm)</label>
                <input type="number" id="height" min="120" max="220" placeholder="168">
            </div>
            <div class="form-group">
                <label for="weight">Weight (kg)</label>
                <input type="number" id="weight" min="35" max="200" placeholder="64">
            </div>
            <div class="form-group">
                <label for="activity">Activity level</label>
                <select id="activity">
                    <option value="">Choose activity</option>
                    <option>Sedentary (desk job)</option>
                    <option>Lightly active (1-2 workouts/week)</option>
                    <option>Moderately active (3-4 workouts/week)</option>
                    <option>Very active (5+ workouts/week)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="goal">Goal</label>
                <select id="goal">
                    <option value="">Choose goal</option>
                    <option>Lose weight</option>
                    <option>Maintain weight</option>
                    <option>Gain muscle</option>
                </select>
            </div>
            <div class="form-group">
                <label for="diet">Diet preference</label>
                <select id="diet">
                    <option value="">Select preference</option>
                    <option>Balanced</option>
                    <option>High-protein</option>
                    <option>Vegan</option>
                    <option>Vegetarian</option>
                    <option>Keto</option>
                </select>
            </div>
        </div>

        <div class="sliders">
            <div class="slider-group">
                <label for="intensity">Workout intensity</label>
                <input type="range" id="intensity" min="1" max="5" value="3">
                <small style="color: var(--muted);">1 = relaxed walks · 5 = daily high-intensity sessions</small>
            </div>
            <div class="slider-group">
                <label for="meal-count">Meals per day</label>
                <input type="range" id="meal-count" min="3" max="6" value="4">
                <small style="color: var(--muted);">Slide to match your routine. We'll split calories accordingly.</small>
            </div>
        </div>

        <div class="cta-bar">
            <p>Ready for personalized calories, macros, and recipes?</p>
            <a href="{{ route('landing.result') }}" class="btn-primary">Generate Plan</a>
        </div>
    </form>
</div>
@endsection
