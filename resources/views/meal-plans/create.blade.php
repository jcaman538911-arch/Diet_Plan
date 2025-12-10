@extends('layouts.app')

@section('title', 'Create Meal Plan - Diet Plan System')

@section('styles')
<style>
    .page-header {
        margin-bottom: 40px;
        text-align: center;
    }

    .page-header h1 {
        font-size: 36px;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #3f7dff, #6fe3a1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        color: #6c757d;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #3f7dff;
    }

    .back-link svg {
        margin-right: 8px;
        width: 16px;
        height: 16px;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        max-width: 700px;
        margin: 0 auto;
        border: 1px solid rgba(0,0,0,0.03);
    }

    .form-group {
        margin-bottom: 28px;
    }

    label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 10px;
        letter-spacing: 0.3px;
    }

    input,
    textarea {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background-color: #f8fafc;
        color: #2d3748;
    }

    input::placeholder,
    textarea::placeholder {
        color: #a0aec0;
        opacity: 1;
    }

    textarea {
        min-height: 140px;
        line-height: 1.6;
    }

    input:focus,
    textarea:focus {
        outline: none;
        border-color: #3f7dff;
        background-color: white;
        box-shadow: 0 0 0 4px rgba(63, 125, 255, 0.1);
    }

    .form-actions {
        margin-top: 40px;
        display: flex;
        gap: 16px;
        justify-content: flex-end;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3f7dff, #6fe3a1);
        color: white;
        box-shadow: 0 4px 15px rgba(63, 125, 255, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(63, 125, 255, 0.3);
    }

    .btn-secondary {
        background: white;
        color: #4a5568;
        border: 2px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e0;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 28px;
            border-radius: 16px;
        }
        
        .form-actions {
            flex-direction: column;
            gap: 12px;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1>Create New Meal Plan</h1>
    <a href="{{ route('meal-plans.index') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to meal plans
    </a>
</div>

<div class="form-card">
    <form action="{{ route('meal-plans.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Meal Plan Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                placeholder="e.g., Keto Diet Plan, Weight Loss Program" 
                required
                autofocus
            >
        </div>

        <div class="form-group">
            <label for="description">Description <span class="text-gray-500">(optional)</span></label>
            <textarea 
                id="description" 
                name="description" 
                placeholder="Tell us about this meal plan. What's the goal? Any specific dietary requirements or preferences?"
                rows="4"
            >{{ old('description') }}</textarea>
        </div>

        <div class="form-actions">
            <a href="{{ route('meal-plans.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
                <span>Create Meal Plan</span>
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection
