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
        border: none;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
    }

    .planner-tab.active {
        background: var(--color-accent);
        color: #fff;
        box-shadow: 0 12px 22px rgba(79, 138, 62, 0.2);
    }

    .planner-panels {
        display: grid;
        gap: 24px;
    }

    .tab-panel {
        display: none;
    }

    .tab-panel.is-active {
        display: block;
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

    .meal-card-actions {
        position: absolute;
        top: 8px;
        right: 8px;
        display: flex;
        gap: 6px;
        z-index: 10;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .meal-card:hover .meal-card-actions {
        opacity: 1;
    }

    .meal-card.editing .meal-card-actions {
        opacity: 1;
    }

    .remove-btn {
        background: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 8px;
        width: 36px;
        height: 36px;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .remove-btn:hover {
        background: rgba(220, 53, 69, 1);
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(220, 53, 69, 0.4);
    }

    .edit-btn {
        background: linear-gradient(135deg, var(--color-accent), #5fa84d);
        color: white;
        border: none;
        border-radius: 8px;
        width: 36px;
        height: 36px;
        font-size: 16px;
        cursor: pointer;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(79, 138, 62, 0.3);
        font-weight: 600;
    }

    .edit-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(79, 138, 62, 0.4);
        background: linear-gradient(135deg, var(--color-accent-dark), #4f8a3e);
    }

    .edit-btn:active {
        transform: scale(0.95);
    }

    .meal-card.editing {
        border: 2px solid var(--color-accent);
        box-shadow: 0 8px 24px rgba(79, 138, 62, 0.25);
        transform: translateY(-2px);
    }

    .meal-card-edit-form {
        display: none;
        padding: 16px;
        background: linear-gradient(135deg, rgba(79, 138, 62, 0.08), rgba(79, 138, 62, 0.12));
        border-radius: 14px;
        margin-top: 12px;
        border: 1px solid rgba(79, 138, 62, 0.2);
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .meal-card.editing .meal-card-edit-form {
        display: block;
    }

    .meal-card.editing .meal-name,
    .meal-card.editing .meal-meta {
        display: none;
    }

    .meal-card-edit-form label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .meal-card-edit-form .form-control {
        width: 100%;
        margin-bottom: 12px;
        padding: 10px 14px;
        border: 2px solid rgba(79, 138, 62, 0.2);
        border-radius: 10px;
        font-size: 14px;
        background: #fff;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .meal-card-edit-form .form-control:focus {
        outline: none;
        border-color: var(--color-accent);
        box-shadow: 0 0 0 4px rgba(79, 138, 62, 0.15), 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }

    .meal-card-edit-form .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 12px;
    }

    .meal-card-edit-form .btn-save {
        flex: 1;
        padding: 10px 16px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(135deg, var(--color-accent), #5fa84d);
        color: white;
        font-weight: 600;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(79, 138, 62, 0.3);
    }

    .meal-card-edit-form .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(79, 138, 62, 0.4);
        background: linear-gradient(135deg, var(--color-accent-dark), #4f8a3e);
    }

    .meal-card-edit-form .btn-save:active {
        transform: translateY(0);
    }

    .meal-card-edit-form .btn-cancel {
        flex: 1;
        padding: 10px 16px;
        border-radius: 10px;
        border: 2px solid rgba(79, 138, 62, 0.3);
        background: rgba(255, 255, 255, 0.9);
        color: var(--color-text);
        font-weight: 600;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .meal-card-edit-form .btn-cancel:hover {
        background: #fff;
        border-color: var(--color-accent);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .add-card {
        border: 2px dashed rgba(79, 138, 62, 0.35);
        background: rgba(79, 138, 62, 0.08);
        border-radius: 20px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        min-width: 200px;
    }

    .add-card h3 {
        font-size: 15px;
        color: var(--color-accent);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 4px 0;
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
        align-self: flex-start;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
        background: var(--color-accent);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
        width: 100%;
        margin-top: 4px;
    }

    .add-card button:hover {
        background: var(--color-accent-dark);
        transform: translateY(-1px);
    }

    .add-card button:active {
        transform: translateY(0);
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

    .bmi-calculator {
        display: grid;
        gap: 24px;
        background: radial-gradient(circle at top, rgba(60, 96, 80, 0.4), rgba(21, 36, 24, 0.85));
        border-radius: 26px;
        padding: 30px;
        color: #f3fbf1;
        box-shadow: 0 28px 48px rgba(16, 32, 24, 0.4);
        border: 1px solid rgba(79, 138, 62, 0.24);
    }

    .bmi-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 16px;
        align-items: center;
    }

    .bmi-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .bmi-header p {
        color: rgba(241, 255, 237, 0.75);
        max-width: 420px;
    }

    .bmi-unit-toggle {
        display: inline-flex;
        background: rgba(8, 14, 10, 0.45);
        border-radius: 18px;
        padding: 4px;
    }

    .unit-toggle {
        border: none;
        padding: 8px 18px;
        border-radius: 14px;
        background: transparent;
        color: rgba(243, 251, 241, 0.7);
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .unit-toggle.active {
        background: linear-gradient(135deg, #6fe3a1, #3f7dff);
        color: #09120c;
        box-shadow: 0 12px 24px rgba(111, 227, 161, 0.35);
    }

    .bmi-body {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
    }

    .bmi-form {
        display: grid;
        gap: 16px;
        background: rgba(12, 24, 16, 0.55);
        border-radius: 22px;
        padding: 22px;
    }

    .bmi-field {
        display: grid;
        gap: 8px;
    }

    .bmi-field label {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(243, 251, 241, 0.7);
    }

    .bmi-input,
    .bmi-select {
        background: rgba(5, 10, 7, 0.55);
        border: 1px solid rgba(111, 227, 161, 0.25);
        border-radius: 12px;
        padding: 10px 14px;
        color: #f3fbf1;
        font-size: 15px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .bmi-input:focus,
    .bmi-select:focus {
        outline: none;
        border-color: #6fe3a1;
        box-shadow: 0 0 0 3px rgba(111, 227, 161, 0.25);
    }

    .bmi-gender {
        display: inline-flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .bmi-gender label {
        padding: 8px 14px;
        border-radius: 12px;
        background: rgba(5, 10, 7, 0.45);
        border: 1px solid transparent;
        cursor: pointer;
        font-weight: 600;
        color: rgba(243, 251, 241, 0.75);
        transition: background 0.2s ease, border-color 0.2s ease;
    }

    .bmi-gender input {
        display: none;
    }

    .bmi-gender input:checked + span {
        color: #09120c;
        background: linear-gradient(135deg, #6fe3a1, #3f7dff);
        border-color: rgba(111, 227, 161, 0.5);
        box-shadow: 0 12px 18px rgba(111, 227, 161, 0.3);
    }

    .bmi-range-input {
        display: grid;
        gap: 8px;
    }

    .bmi-range-input input[type="range"] {
        accent-color: #6fe3a1;
        width: 100%;
    }

    .bmi-submit {
        margin-top: 10px;
        padding: 12px 18px;
        border-radius: 12px;
        border: none;
        background: linear-gradient(135deg, #3f7dff, #6fe3a1);
        color: #09120c;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .bmi-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 18px 26px rgba(63, 125, 255, 0.35);
    }

    .bmi-results {
        background: rgba(12, 24, 16, 0.55);
        border-radius: 22px;
        padding: 22px;
        display: grid;
        gap: 20px;
    }

    .bmi-score {
        text-align: center;
        display: grid;
        gap: 8px;
    }

    .bmi-score h3 {
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(243, 251, 241, 0.65);
    }

    .bmi-value {
        font-size: 48px;
        font-weight: 700;
    }

    .bmi-status {
        font-weight: 600;
        font-size: 16px;
    }

    .bmi-status.normal {
        color: #6fe3a1;
    }

    .bmi-status.underweight {
        color: #6bc4ff;
    }

    .bmi-status.overweight {
        color: #f7c948;
    }

    .bmi-status.obese {
        color: #ff7b7b;
    }

    .bmi-scale {
        position: relative;
        height: 12px;
        border-radius: 999px;
        background: linear-gradient(90deg, #6bc4ff, #6fe3a1, #f7c948, #ff7b7b);
        margin-top: 10px;
    }

    .bmi-indicator {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.35);
    }

    .bmi-meta {
        display: grid;
        gap: 12px;
        font-size: 13px;
        color: rgba(243, 251, 241, 0.78);
    }

    .bmi-meta-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
    }

    .bmi-meta-label {
        color: rgba(243, 251, 241, 0.6);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 11px;
    }

    .shopping-card {
        background: var(--color-surface);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 24px 46px rgba(79, 138, 62, 0.14);
        border: 1px solid rgba(79, 138, 62, 0.1);
        color: var(--color-text);
    }

    @media (max-width: 768px) {
        .bmi-body {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <a href="{{ route('meal-plans.index') }}" class="btn btn-secondary page-back">← Back to meal plans</a>
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
        <button type="button" class="planner-tab active" data-tab="planner">Planner</button>
        <button type="button" class="planner-tab" data-tab="shopping">Shopping list</button>
    </div>
</div>

<div class="planner-panels">
    <div class="tab-panel is-active" data-panel="planner">
        <div class="description-card">
            <h2>Plan overview</h2>
            <p>{{ $mealPlan->description ?: 'No description provided.' }}</p>
        </div>

        @php
            $mealGroups = [
                'Breakfast' => ['key' => 'breakfast', 'icon' => '🥞'],
                'Lunches & Dinners' => ['key' => ['lunch', 'dinner'], 'icon' => '🍽️'],
                'Snacks' => ['key' => 'snack', 'icon' => '🍎'],
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
                        <div class="meal-card" id="meal-card-{{ $item->id }}">
                            @if($item->recipe && $item->recipe->image_url)
                                <img src="{{ $item->recipe->image_url }}" alt="{{ $item->recipe->name }}">
                            @else
                                <div class="meal-card-placeholder">🍳</div>
                            @endif
                            <div class="meal-name">{{ $item->recipe?->name ?? 'Recipe removed' }}</div>
                            <div class="meal-meta">{{ ucfirst($item->meal_type) }} • {{ $item->servings }} servings</div>
                            
                            <div class="meal-card-actions">
                                <button type="button" class="edit-btn" onclick="editMeal({{ $item->id }})" title="Edit meal">
                                    <span style="font-size: 18px;">✏️</span>
                                </button>
                                <form action="{{ route('meal-plans.remove-meal', [$mealPlan, $item]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn" title="Remove meal" onclick="return confirm('Remove this meal from the plan?')">×</button>
                                </form>
                            </div>

                            <div class="meal-card-edit-form">
                                <form action="{{ route('meal-plans.update-meal', [$mealPlan, $item]) }}" method="POST" id="edit-form-{{ $item->id }}">
                                    @csrf
                                    @method('PUT')
                                    <label for="edit-recipe-{{ $item->id }}">Select Recipe</label>
                                    <select name="recipe_id" id="edit-recipe-{{ $item->id }}" class="form-control" required>
                                        <option value="">Choose a recipe...</option>
                                        @foreach($recipes as $recipe)
                                            <option value="{{ $recipe->id }}" {{ $item->recipe_id == $recipe->id ? 'selected' : '' }}>
                                                {{ $recipe->name }} ({{ ucfirst($recipe->category) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="edit-servings-{{ $item->id }}">Servings</label>
                                    <input type="number" name="servings" id="edit-servings-{{ $item->id }}" class="form-control" min="1" value="{{ $item->servings }}" placeholder="Number of servings" required>
                                    <div class="form-actions">
                                        <button type="submit" class="btn-save">💾 Save Changes</button>
                                        <button type="button" class="btn-cancel" onclick="cancelEdit({{ $item->id }})">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-card">
                            <div class="empty-icon">🗓️</div>
                            <span>No meals yet</span>
                        </div>
                    @endforelse

                    <div class="add-card">
                        <h3>+ Add meal</h3>
                        <form action="{{ route('meal-plans.add-meal', $mealPlan) }}" method="POST" id="addMealForm-{{ $mealType }}">
                            @csrf
                            <input type="hidden" name="meal_type" value="{{ $mealType }}">
                            <select name="recipe_id" class="form-control" required style="width: 100%; margin-bottom: 10px;">
                                <option value="">Select recipe</option>
                                @foreach($recipes as $recipe)
                                    <option value="{{ $recipe->id }}">{{ $recipe->name }} ({{ ucfirst($recipe->category) }})</option>
                                @endforeach
                            </select>
                            <input type="number" name="servings" class="form-control" min="1" value="1" placeholder="Servings" required style="width: 100%; margin-bottom: 10px;">
                            <button type="submit" class="btn-add-meal">Add to Plan</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="tab-panel" data-panel="shopping">
        <div class="shopping-card">
            <h2>Shopping list</h2>
            <p>Coming soon! You&apos;ll be able to generate a smart shopping list based on this meal plan.</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = Array.from(document.querySelectorAll('.planner-tab'));
        const panels = Array.from(document.querySelectorAll('.tab-panel'));

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.tab;
                tabs.forEach((button) => button.classList.toggle('active', button === tab));
                panels.forEach((panel) => panel.classList.toggle('is-active', panel.dataset.panel === target));
            });
        });

        // Handle add meal form submissions with validation
        const addMealForms = document.querySelectorAll('[id^="addMealForm-"]');
        addMealForms.forEach((form) => {
            form.addEventListener('submit', function(e) {
                const recipeSelect = this.querySelector('select[name="recipe_id"]');
                const servingsInput = this.querySelector('input[name="servings"]');
                
                if (!recipeSelect.value) {
                    e.preventDefault();
                    alert('Please select a recipe');
                    recipeSelect.focus();
                    return false;
                }
                
                if (!servingsInput.value || parseInt(servingsInput.value) < 1) {
                    e.preventDefault();
                    alert('Please enter a valid number of servings (at least 1)');
                    servingsInput.focus();
                    return false;
                }
            });
        });
    });

    function editMeal(mealItemId) {
        // Close any other open edit forms
        document.querySelectorAll('.meal-card.editing').forEach(card => {
            card.classList.remove('editing');
        });
        
        const mealCard = document.getElementById('meal-card-' + mealItemId);
        if (mealCard) {
            mealCard.classList.add('editing');
            // Focus on the recipe select
            const select = mealCard.querySelector('select[name="recipe_id"]');
            if (select) {
                setTimeout(() => select.focus(), 100);
            }
        }
    }

    function cancelEdit(mealItemId) {
        const mealCard = document.getElementById('meal-card-' + mealItemId);
        if (mealCard) {
            mealCard.classList.remove('editing');
            // Reset form to original values
            const form = document.getElementById('edit-form-' + mealItemId);
            if (form) {
                form.reset();
            }
        }
    }

    // Auto-close edit form after successful submission
    document.querySelectorAll('[id^="edit-form-"]').forEach(form => {
        form.addEventListener('submit', function() {
            const mealItemId = this.id.replace('edit-form-', '');
            setTimeout(() => {
                cancelEdit(mealItemId);
            }, 100);
        });
    });
</script>
@endsection
