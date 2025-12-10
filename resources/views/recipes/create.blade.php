@extends('layouts.app')

@section('title', 'Create Recipe - Diet Plan System')

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

    .inline-group {
        display: flex;
        gap: 16px;
    }

    .inline-group .form-group {
        flex: 1;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1>Create Recipe</h1>
    <a href="{{ route('recipes.index') }}" class="btn btn-secondary">← Back to recipes</a>
</div>

<div class="form-card">
    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Recipe name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select category</option>
                    <option value="breakfast" {{ old('category') === 'breakfast' ? 'selected' : '' }}>Breakfast</option>
                    <option value="lunch" {{ old('category') === 'lunch' ? 'selected' : '' }}>Lunch</option>
                    <option value="dinner" {{ old('category') === 'dinner' ? 'selected' : '' }}>Dinner</option>
                    <option value="snack" {{ old('category') === 'snack' ? 'selected' : '' }}>Snack</option>
                </select>
            </div>

            <div class="form-group">
                <label for="servings">Servings</label>
                <input type="number" id="servings" name="servings" min="1" value="{{ old('servings', 1) }}" required>
            </div>

            <div class="form-group">
                <label for="calories">Calories (optional)</label>
                <input type="number" id="calories" name="calories" min="0" value="{{ old('calories') }}">
            </div>

            <div class="form-group">
                <label for="prep_time">Prep time (minutes)</label>
                <input type="number" id="prep_time" name="prep_time" min="0" value="{{ old('prep_time') }}">
            </div>

            <div class="form-group">
                <label for="cook_time">Cook time (minutes)</label>
                <input type="number" id="cook_time" name="cook_time" min="0" value="{{ old('cook_time') }}">
            </div>

            <div class="form-group">
                <label for="image">Recipe image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <small style="color: var(--color-muted); font-size: 12px;">Upload JPG/PNG/GIF/WebP up to 10&nbsp;MB. Images are automatically resized to fit.</small>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Short description</label>
            <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients (one per line)</label>
            <textarea id="ingredients" name="ingredients" class="large">{{ old('ingredients') }}</textarea>
        </div>

        <div class="form-group">
            <label for="instructions">Instructions</label>
            <textarea id="instructions" name="instructions" class="large">{{ old('instructions') }}</textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save recipe</button>
            <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
