@extends('layouts.app')

@section('title', 'Edit Recipe - ' . $recipe->name)

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-header h1 {
        font-size: 30px;
        font-weight: 700;
        color: var(--color-text);
    }

    .form-card {
        background: var(--color-surface);
        border-radius: 22px;
        padding: 34px;
        box-shadow: 0 26px 48px rgba(79, 138, 62, 0.14);
        max-width: 840px;
        border: 1px solid rgba(79, 138, 62, 0.12);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    label {
        font-size: 14px;
        font-weight: 600;
        color: var(--color-muted);
    }

    input,
    select,
    textarea {
        padding: 12px 16px;
        border: 1px solid rgba(79, 138, 62, 0.25);
        border-radius: 12px;
        font-size: 14px;
        transition: border-color 0.2s, box-shadow 0.2s;
        resize: vertical;
        min-height: 46px;
        background: #fff;
    }

    textarea.large {
        min-height: 160px;
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: var(--color-accent);
        box-shadow: 0 0 0 3px rgba(79, 138, 62, 0.16);
    }

    .form-actions {
        margin-top: 30px;
        display: flex;
        gap: 15px;
    }

    .current-image {
        margin-top: 10px;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .current-image img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 14px;
        border: 1px solid rgba(79, 138, 62, 0.18);
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1>Edit Recipe</h1>
    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-secondary">← Back to recipe</a>
</div>

<div class="form-card">
    <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Recipe name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $recipe->name) }}" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select category</option>
                    <option value="breakfast" {{ old('category', $recipe->category) === 'breakfast' ? 'selected' : '' }}>Breakfast</option>
                    <option value="lunch" {{ old('category', $recipe->category) === 'lunch' ? 'selected' : '' }}>Lunch</option>
                    <option value="dinner" {{ old('category', $recipe->category) === 'dinner' ? 'selected' : '' }}>Dinner</option>
                    <option value="snack" {{ old('category', $recipe->category) === 'snack' ? 'selected' : '' }}>Snack</option>
                </select>
            </div>

            <div class="form-group">
                <label for="servings">Servings</label>
                <input type="number" id="servings" name="servings" min="1" value="{{ old('servings', $recipe->servings) }}" required>
            </div>

            <div class="form-group">
                <label for="calories">Calories (optional)</label>
                <input type="number" id="calories" name="calories" min="0" value="{{ old('calories', $recipe->calories) }}">
            </div>

            <div class="form-group">
                <label for="prep_time">Prep time (minutes)</label>
                <input type="number" id="prep_time" name="prep_time" min="0" value="{{ old('prep_time', $recipe->prep_time) }}">
            </div>

            <div class="form-group">
                <label for="cook_time">Cook time (minutes)</label>
                <input type="number" id="cook_time" name="cook_time" min="0" value="{{ old('cook_time', $recipe->cook_time) }}">
            </div>

            <div class="form-group">
                <label for="image">Recipe image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <small style="color: var(--color-muted); font-size: 12px;">Upload JPG/PNG/GIF up to 2&nbsp;MB with minimum 2000×1296 resolution for best results.</small>
                @if($recipe->image)
                    <div class="current-image">
                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}">
                        <span style="color: #666; font-size: 13px;">Current image</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="description">Short description</label>
            <textarea id="description" name="description" rows="3">{{ old('description', $recipe->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients (one per line)</label>
            <textarea id="ingredients" name="ingredients" class="large">{{ old('ingredients', $recipe->ingredients) }}</textarea>
        </div>

        <div class="form-group">
            <label for="instructions">Instructions</label>
            <textarea id="instructions" name="instructions" class="large">{{ old('instructions', $recipe->instructions) }}</textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update recipe</button>
            <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
