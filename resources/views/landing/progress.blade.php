@extends('landing.layout')

@section('title', 'Track Your Progress | Diet Plan Studio')

@section('styles')
<style>
    .progress-wrapper {
        display: grid;
        gap: 32px;
    }

    .log-card, .chart-card {
        background: var(--card);
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 26px 48px var(--shadow);
        border: 1px solid rgba(79, 138, 62, 0.12);
    }

    .log-grid {
        display: grid;
        gap: 24px;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    }

    label {
        font-weight: 600;
        font-size: 14px;
    }

    input, select {
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid rgba(79, 138, 62, 0.25);
        background: #fff;
        font-size: 14px;
    }

    .log-actions {
        margin-top: 24px;
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .chart-placeholder {
        height: 320px;
        border-radius: 18px;
        border: 1px dashed rgba(79, 138, 62, 0.25);
        display: grid;
        place-items: center;
        color: var(--muted);
        font-size: 14px;
        background: rgba(79, 138, 62, 0.05);
    }
</style>
@endsection

@section('content')
<div class="progress-wrapper">
    <section>
        <h1 class="section-title">Stay accountable with daily logs</h1>
        <p class="section-description">Record weight, meals, and calories across the week. Visual charts help you spot plateaus and celebrate milestones.</p>
    </section>

    <form class="log-card">
        <h2 style="font-size: 20px; margin-bottom: 24px;">Quick entry</h2>
        <div class="log-grid">
            <div>
                <label for="log-date">Date</label>
                <input type="date" id="log-date">
            </div>
            <div>
                <label for="log-weight">Weight (kg)</label>
                <input type="number" id="log-weight" step="0.1" placeholder="63.5">
            </div>
            <div>
                <label for="log-calories">Calories consumed</label>
                <input type="number" id="log-calories" placeholder="2050">
            </div>
            <div>
                <label for="log-activity">Activity highlight</label>
                <select id="log-activity">
                    <option value="">Select one</option>
                    <option>Strength training</option>
                    <option>Cardio session</option>
                    <option>Recovery day</option>
                    <option>Mixed workout</option>
                </select>
            </div>
        </div>
        <div class="log-actions">
            <a href="#" class="btn-primary">Save log</a>
            <a href="#" class="btn-secondary">View weekly summary</a>
        </div>
    </form>

    <div class="chart-card">
        <h2 style="font-size: 20px; margin-bottom: 18px;">Visualize your progress</h2>
        <p style="color: var(--muted); margin-bottom: 20px;">Connect your data to Chart.js or Recharts to display weight, muscle gain, or calorie trends over time.</p>
        <div class="chart-placeholder">Chart placeholder &mdash; ready for Chart.js integration</div>
    </div>
</div>
@endsection
