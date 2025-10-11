@extends('layouts.app')

@section('title', $recipe->name . ' - Recipe')

@section('styles')
<style>
    .recipe-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .recipe-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: var(--color-text);
    }

    .recipe-actions {
        display: flex;
        gap: 10px;
    }

    .recipe-hero {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .recipe-image {
        width: 100%;
        height: 320px;
        border-radius: 20px;
        object-fit: cover;
        background: var(--color-surface-alt);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
    }

    .recipe-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
    }

    .info-card {
        background: var(--color-surface);
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 18px 28px rgba(79, 138, 62, 0.12);
        border: 1px solid rgba(79, 138, 62, 0.1);
    }

    .info-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--color-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 20px;
        font-weight: 600;
        color: #333;
    }

    .section {
        margin-bottom: 40px;
    }

    .section h2 {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--color-text);
    }

    .ingredients-list,
    .instructions-list {
        background: var(--color-surface);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 22px 40px rgba(79, 138, 62, 0.12);
        border: 1px solid rgba(79, 138, 62, 0.1);
        line-height: 1.7;
    }

    .ingredients-list ul {
        list-style: none;
    }

    .ingredients-list li {
        padding: 10px 0;
        border-bottom: 1px solid rgba(79, 138, 62, 0.12);
        font-size: 15px;
        color: var(--color-muted);
    }

    .ingredients-list li:last-child {
        border-bottom: none;
    }

    .instructions-list ol {
        padding-left: 20px;
    }

    .instructions-list li {
        margin-bottom: 15px;
        font-size: 15px;
        color: var(--color-muted);
    }
</style>
@endsection

@section('content')
<div class="recipe-header">
    <div>
        <a href="{{ route('recipes.index') }}" class="btn btn-secondary" style="margin-bottom: 15px;">← Back to recipes</a>
        <h1>{{ $recipe->name }}</h1>
        <p style="color: #666; margin-top: 6px;">{{ $recipe->description }}</p>
    </div>
    <div class="recipe-actions">
        <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-secondary">Edit</a>
        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Delete this recipe?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>

<div class="recipe-hero">
    @if($recipe->image)
        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="recipe-image">
    @else
        <div class="recipe-image">🥗</div>
    @endif

    <div class="recipe-info">
        <div class="info-card">
            <div class="info-label">Servings</div>
            <div class="info-value">{{ $recipe->servings }}</div>
        </div>
        <div class="info-card">
            <div class="info-label">Prep Time</div>
            <div class="info-value">{{ $recipe->prep_time ? $recipe->prep_time . ' mins' : '—' }}</div>
        </div>
        <div class="info-card">
            <div class="info-label">Cook Time</div>
            <div class="info-value">{{ $recipe->cook_time ? $recipe->cook_time . ' mins' : '—' }}</div>
        </div>
        <div class="info-card">
            <div class="info-label">Total Time</div>
            @php
                $total = ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0);
            @endphp
            <div class="info-value">{{ $total > 0 ? $total . ' mins' : '—' }}</div>
        </div>
        <div class="info-card">
            <div class="info-label">Calories</div>
            <div class="info-value">{{ $recipe->calories ?? '—' }}</div>
        </div>
        <div class="info-card">
            <div class="info-label">Category</div>
            <div class="info-value">{{ ucfirst($recipe->category) }}</div>
        </div>
    </div>
</div>

<div class="section">
    <h2>Ingredients</h2>
    <div class="ingredients-list">
        @if($recipe->ingredients)
            <ul>
                @foreach(preg_split('/\r\n|\r|\n/', $recipe->ingredients) as $ingredient)
                    @if(trim($ingredient))
                        <li>{{ $ingredient }}</li>
                    @endif
                @endforeach
            </ul>
        @else
            <p style="color: #666;">No ingredients listed.</p>
        @endif
    </div>
</div>

<div class="section">
    <h2>Instructions</h2>
    <div class="instructions-list">
        @if($recipe->instructions)
            @php
                $steps = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $recipe->instructions)));
            @endphp
            @if(count($steps))
                <ol>
                    @foreach($steps as $step)
                        <li>{{ $step }}</li>
                    @endforeach
                </ol>
            @else
                <p style="color: #666;">No instructions listed.</p>
            @endif
        @else
            <p style="color: #666;">No instructions listed.</p>
        @endif
    </div>
</div>
@endsection
