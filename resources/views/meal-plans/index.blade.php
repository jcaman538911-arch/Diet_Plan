@extends('layouts.app')

@section('title', 'Meal Plans - Diet Plan System')

@section('styles')
<style>
    .page-header {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 16px;
        margin-bottom: 30px;
        text-align: center;
    }

    .page-header h1 {
        font-size: 30px;
        font-weight: 700;
        color: var(--color-text);
    }

    .page-header p {
        color: var(--color-muted);
    }

    .meal-plans-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        justify-items: center;
        width: 100%;
    }

    .meal-plan-card {
        background: var(--color-surface);
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 22px 36px rgba(79, 138, 62, 0.14);
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(79, 138, 62, 0.12);
        width: 100%;
        max-width: 320px;
    }

    .meal-plan-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        gap: 12px;
    }

    .meal-plan-header > div:first-child {
        flex: 1;
        min-width: 0;
    }

    .meal-plan-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 4px;
        line-height: 1.2;
    }

    .meal-plan-actions {
        display: flex;
        gap: 8px;
        flex-shrink: 0;
        align-items: flex-start;
    }

    .tab-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 24px;
    }

    .tab {
        padding: 8px 16px;
        border-radius: 20px;
        background: var(--color-surface-alt);
        color: var(--color-muted);
        font-size: 13px;
    }

    .tab.active {
        background: var(--color-accent);
        color: #fff;
    }

    .meal-group {
        margin-bottom: 24px;
    }

    .meal-group-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .meal-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 12px;
        align-items: start;
    }

    .meal-card {
        background: var(--color-surface-alt);
        border-radius: 16px;
        padding: 16px;
        box-shadow: inset 0 0 0 1px rgba(79, 138, 62, 0.16);
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-height: 140px;
        align-items: stretch;
    }

    .meal-card img {
        width: 100%;
        height: 90px;
        object-fit: cover;
        border-radius: 10px;
        display: block;
    }

    .meal-card-placeholder {
        width: 100%;
        height: 90px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(79, 138, 62, 0.12);
        font-size: 28px;
        color: rgba(79, 138, 62, 0.6);
        flex-shrink: 0;
    }

    .meal-card-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--color-text);
        line-height: 1.3;
        margin: 0;
    }

    .meal-card-meta {
        font-size: 12px;
        color: var(--color-muted);
        line-height: 1.4;
        margin: 0;
    }

    .add-meal-card {
        border: 1px dashed #c6d8b2;
        background: rgba(79, 138, 62, 0.06);
        align-items: center;
        justify-content: center;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        color: var(--color-accent);
        font-weight: 600;
        font-size: 14px;
        min-height: 140px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .add-meal-card:hover {
        background: rgba(79, 138, 62, 0.16);
    }

    .empty-state {
        background: var(--color-surface);
        border-radius: 24px;
        padding: 94px 48px;
        text-align: center;
        box-shadow: inset 0 0 0 1px rgba(79, 138, 62, 0.12), 0 28px 56px rgba(79, 138, 62, 0.14);
        border: 1px dashed rgba(79, 138, 62, 0.2);
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1>Meal plans</h1>
        <p style="color: #666; margin-top: 6px;">Organize your meals for the week</p>
    </div>
    <a href="{{ route('meal-plans.create') }}" class="btn btn-primary">+ New meal plan</a>
</div>

@if($mealPlans->count() > 0)
    <div class="meal-plans-grid">
        @foreach($mealPlans as $mealPlan)
            <div class="meal-plan-card">
                <div class="meal-plan-header">
                    <div>
                        <h3 class="meal-plan-title">{{ $mealPlan->name }}</h3>
                        <p style="color: #777; font-size: 13px; margin: 0; line-height: 1.4;">{{ $mealPlan->description ?: 'No description' }}</p>
                    </div>
                    <div class="meal-plan-actions">
                        <a href="{{ route('meal-plans.show', $mealPlan) }}" class="btn btn-secondary" style="padding: 8px 14px; font-size: 13px;">Open</a>
                        <form action="{{ route('meal-plans.destroy', $mealPlan) }}" method="POST" onsubmit="return confirm('Delete this meal plan?');" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 8px 14px; font-size: 13px;">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="tab-bar">
                    <div class="tab active">Planner</div>
                    <div class="tab">Prep notes</div>
                    <div class="tab">Shopping list</div>
                </div>

                @php
                    $grouped = [
                        'Breakfast' => $mealPlan->mealItems->where('meal_type', 'breakfast'),
                        'Lunches & Dinners' => $mealPlan->mealItems->whereIn('meal_type', ['lunch', 'dinner']),
                        'Snacks' => $mealPlan->mealItems->where('meal_type', 'snack'),
                    ];
                @endphp

                @foreach($grouped as $group => $items)
                    <div class="meal-group">
                        <div class="meal-group-title">{{ $group }}</div>
                        <div class="meal-cards">
                            @forelse($items as $item)
                                <div class="meal-card">
                                    @if($item->recipe && $item->recipe->image_url)
                                        <img src="{{ $item->recipe->image_url }}" alt="{{ $item->recipe->name }}">
                                    @else
                                        <div class="meal-card-placeholder">🥗</div>
                                    @endif
                                    <h4 class="meal-card-title">{{ $item->recipe?->name ?? 'Recipe removed' }}</h4>
                                    <p class="meal-card-meta">{{ $item->servings }} servings</p>
                                </div>
                            @empty
                                <div class="meal-card add-meal-card" onclick="window.location='{{ route('meal-plans.show', $mealPlan) }}'">
                                    <span style="font-size: 24px; line-height: 1;">＋</span>
                                    <span>Add meal</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-icon">📋</div>
        <h2 style="margin-bottom: 10px;">No meal plans yet</h2>
        <p style="color: #666; margin-bottom: 20px;">Create a meal plan to organize your week.</p>
        <a href="{{ route('meal-plans.create') }}" class="btn btn-primary">Create your first meal plan</a>
    </div>
@endif
@endsection
