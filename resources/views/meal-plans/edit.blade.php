@extends('layouts.app')

@section('title', 'Edit Meal Plan - ' . $mealPlan->name)

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-header h1 {
        font-size: 28px;
        font-weight: 600;
        color: #333;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        max-width: 720px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 20px;
    }

    label {
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }

    input,
    textarea {
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 14px;
        transition: border-color 0.2s, box-shadow 0.2s;
        resize: vertical;
    }

    textarea {
        min-height: 140px;
    }

    input:focus,
    textarea:focus {
        outline: none;
        border-color: #6b9f5f;
        box-shadow: 0 0 0 3px rgba(107, 159, 95, 0.12);
    }

    .form-actions {
        margin-top: 20px;
        display: flex;
        gap: 15px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1>Edit meal plan</h1>
    <a href="{{ route('meal-plans.show', $mealPlan) }}" class="btn btn-secondary">← Back to plan</a>
</div>

<div class="form-card">
    <form action="{{ route('meal-plans.update', $mealPlan) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Meal plan name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $mealPlan->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description (optional)</label>
            <textarea id="description" name="description">{{ old('description', $mealPlan->description) }}</textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update plan</button>
            <a href="{{ route('meal-plans.show', $mealPlan) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
