@extends('layouts.app')

@section('title', $mealPlan->name . ' - Meal Plan')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
    }

    .page-header-left {
        max-width: 520px;
    }

    .page-header h1 {
        font-size: 30px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 8px;
    }

    .page-header p {
        color: var(--color-muted);
        line-height: 1.6;
    }

    .page-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .page-back {
        display: inline-block;
        margin-bottom: 14px;
    }

    .planner-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 24px;
    }

    .planner-tabs {
        display: flex;
        gap: 10px;
    }

    .planner-tab {
        padding: 8px 18px;
        border-radius: 22px;
        background: var(--color-surface-alt);
        color: var(--color-muted);
        font-size: 13px;
        font-weight: 600;
    }

    .planner-tab.active {
        background: var(--color-accent);
        color: #fff;
        box-shadow: 0 12px 22px rgba(79, 138, 62, 0.2);
    }

    .meal-section {
        margin-bottom: 32px;
    }

    .meal-section-title {
        font-size: 19px;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .meal-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 16px;
    }

    .meal-card {
        background: var(--color-surface);
        border-radius: 20px;
        padding: 18px;
        box-shadow: 0 24px 44px rgba(79, 138, 62, 0.16);
        border: 1px solid rgba(79, 138, 62, 0.12);
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
        overflow: hidden;
    }

    .meal-card img,
    .meal-card-placeholder {
        width: 100%;
        height: 120px;
        border-radius: 16px;
        object-fit: cover;
    }

    .meal-card-placeholder {
        background: var(--color-surface-alt);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        color: var(--color-muted);
    }

    .meal-name {
        font-size: 16px;
        font-weight: 600;
        color: var(--color-text);
    }

    .meal-meta {
        font-size: 13px;
        color: var(--color-muted);
    }

    .remove-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(220, 53, 69, 0.14);
        color: var(--color-danger-dark);
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        font-size: 16px;
        cursor: pointer;
    }

    .add-card {
        border: 2px dashed rgba(79, 138, 62, 0.35);
        background: rgba(79, 138, 62, 0.08);
        border-radius: 20px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .add-card h3 {
        font-size: 15px;
        color: var(--color-accent);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-control {
        padding: 10px 14px;
        border: 1px solid rgba(79, 138, 62, 0.24);
        border-radius: 12px;
        font-size: 14px;
        background: #fff;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--color-accent);
        box-shadow: 0 0 0 3px rgba(79, 138, 62, 0.18);
    }

    .add-card button {
        align-self: flex-end;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
        background: var(--color-accent);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }

    .add-card button:hover {
        background: var(--color-accent-dark);
    }

    .description-card {
        background: var(--color-surface);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 24px 46px rgba(79, 138, 62, 0.14);
        border: 1px solid rgba(79, 138, 62, 0.1);
        margin-bottom: 30px;
    }

    .description-card h2 {
        font-size: 22px;
        margin-bottom: 12px;
        color: var(--color-text);
    }

    .description-card p {
        color: var(--color-muted);
        line-height: 1.6;
    }

    .empty-card {
        background: rgba(79, 138, 62, 0.06);
        border: 1px dashed rgba(79, 138, 62, 0.3);
        border-radius: 18px;
        padding: 26px;
        text-align: center;
        color: var(--color-muted);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .empty-card .empty-icon {
        font-size: 36px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <a href="{{ route('meal-plans.index') }}" class="btn btn-secondary page-back">? Back to meal plans</a>
        <h1>{{ $mealPlan->name }}</h1>
        <p>{{ $mealPlan->description ?: 'No description provided.' }}</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('meal-plans.edit', $mealPlan) }}" class="btn btn-secondary">Edit</a>
        <form action="{{ route('meal-plans.destroy', $mealPlan) }}" method="POST" onsubmit="return confirm('Delete this meal plan?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>

<div class="planner-header">
    <div class="planner-tabs">
        <div class="planner-tab active">Planner</div>
        <div class="planner-tab">Prep notes</div>
        <div class="planner-tab">Shopping list</div>
    </div>
</div>

<div class="description-card">
    <h2>Plan overview</h2>
    <p>{{ $mealPlan->description ?: 'No description provided.' }}</p>
</div>

@php
    $mealGroups = [
        'Breakfast' => ['key' => 'breakfast', 'icon' => '??'],
        'Lunches & Dinners' => ['key' => ['lunch', 'dinner'], 'icon' => '???'],
        'Snacks' => ['key' => 'snack', 'icon' => '??'],
    ];
@endphp

@foreach($mealGroups as $label => $group)
    @php
        $items = is_array($group['key'])
            ? $mealPlan->mealItems->whereIn('meal_type', $group['key'])
            : $mealPlan->mealItems->where('meal_type', $group['key']);
        $mealType = is_array($group['key']) ? $group['key'][0] : $group['key'];
    @endphp
    <div class="meal-section">
        <div class="meal-section-title">{{ $group['icon'] }} {{ $label }}</div>
        <div class="meal-cards">
            @forelse($items as $item)
                <div class="meal-card">
                    @if($item->recipe && $item->recipe->image_url)
                        <img src="{{ $item->recipe->image_url }}" alt="{{ $item->recipe->name }}">
                    @else
                        <div class="meal-card-placeholder">???</div>
                    @endif
                    <div class="meal-name">{{ $item->recipe?->name ?? 'Recipe removed' }}</div>
                    <div class="meal-meta">{{ ucfirst($item->meal_type) }} · {{ $item->servings }} servings</div>
                    <form action="{{ route('meal-plans.remove-meal', [$mealPlan, $item]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn" title="Remove">×</button>
                    </form>
                </div>
            @empty
                <div class="empty-card">
                    <div class="empty-icon">??</div>
                    <span>No meals yet</span>
                </div>
            @endforelse

            <div class="add-card">
                <h3>+ Add meal</h3>
                <form action="{{ route('meal-plans.add-meal', $mealPlan) }}" method="POST">
                    @csrf
                    <input type="hidden" name="meal_type" value="{{ $mealType }}">
                    <select name="recipe_id" class="form-control" required>
                        <option value="">Select recipe</option>
                        @foreach($recipes as $recipe)
                            <option value="{{ $recipe->id }}">{{ $recipe->name }} ({{ ucfirst($recipe->category) }})</option>
                        @endforeach
                    </select>
                    <input type="number" name="servings" class="form-control" min="1" value="1" style="margin-top: 10px;" required>
                    <button type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection
