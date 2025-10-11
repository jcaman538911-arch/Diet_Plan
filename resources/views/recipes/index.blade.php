@extends('layouts.app')

@section('title', 'Recipes - Diet Plan System')

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

    .filters {
        display: flex;
        gap: 15px;
        align-items: center;
        justify-content: center;
    }

    .search-input {
        padding: 10px 16px;
        border: 1px solid rgba(79, 138, 62, 0.22);
        border-radius: 12px;
        min-width: 240px;
        background: #fff;
    }

    .category-filter {
        padding: 10px 16px;
        border: 1px solid rgba(79, 138, 62, 0.22);
        border-radius: 12px;
        background: #fff;
    }

    .recipes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        justify-items: center;
    }

    .recipe-card {
        background: var(--color-surface);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 22px 36px rgba(79, 138, 62, 0.14);
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(79, 138, 62, 0.12);
    }

    .recipe-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .recipe-placeholder {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        background: var(--color-surface-alt);
    }

    .recipe-card-content {
        padding: 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .recipe-card-content h3 {
        font-size: 18px;
        font-weight: 600;
        color: var(--color-text);
        margin-bottom: 8px;
    }

    .recipe-meta {
        font-size: 13px;
        color: var(--color-muted);
        margin-bottom: 15px;
    }

    .recipe-description {
        font-size: 14px;
        color: var(--color-muted);
        margin-bottom: 20px;
        flex: 1;
    }

    .card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .action-links {
        display: flex;
        gap: 10px;
    }

    .action-links a {
        color: var(--color-accent);
        font-weight: 600;
        text-decoration: none;
        font-size: 14px;
    }

    .action-links a:hover {
        text-decoration: underline;
    }

    .empty-state {
        background: var(--color-surface);
        border-radius: 22px;
        padding: 88px 44px;
        text-align: center;
        box-shadow: inset 0 0 0 1px rgba(79, 138, 62, 0.12), 0 24px 46px rgba(79, 138, 62, 0.12);
        border: 1px dashed rgba(79, 138, 62, 0.18);
        max-width: 640px;
        margin: 0 auto;
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }

    form {
        margin: 0;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1>Recipes</h1>
        <p style="color: #666; margin-top: 6px;">Keep track of all your nutritious meals</p>
    </div>
    <a href="{{ route('recipes.create') }}" class="btn btn-primary">+ Add Recipe</a>
</div>

@if($recipes->count() > 0)
    <div class="recipes-grid">
        @foreach($recipes as $recipe)
            <div class="recipe-card">
                @if($recipe->image_url)
                    <img src="{{ $recipe->image_url }}" alt="{{ $recipe->name }}">
                @else
                    <div class="recipe-placeholder">🥗</div>
                @endif
                <div class="recipe-card-content">
                    <h3>{{ $recipe->name }}</h3>
                    @php
                        $totalTime = ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0);
                    @endphp
                    <div class="recipe-meta">
                        {{ $recipe->servings }} servings · {{ $totalTime > 0 ? $totalTime . ' mins' : '—' }} · {{ ucfirst($recipe->category) }}
                    </div>
                    <p class="recipe-description">{{ \Illuminate\Support\Str::limit($recipe->description ?? '', 80) }}</p>
                    <div class="card-actions">
                        <div class="action-links">
                            <a href="{{ route('recipes.show', $recipe) }}">View</a>
                            <a href="{{ route('recipes.edit', $recipe) }}">Edit</a>
                        </div>
                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Delete this recipe?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 8px 16px; font-size: 13px;">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-icon">🍽️</div>
        <h2 style="margin-bottom: 10px;">No recipes yet</h2>
        <p style="color: #666; margin-bottom: 20px;">Create recipes to build your personalized meal plans.</p>
        <a href="{{ route('recipes.create') }}" class="btn btn-primary">Create your first recipe</a>
    </div>
@endif
@endsection
