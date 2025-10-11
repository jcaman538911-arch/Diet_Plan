@extends('layouts.app')

@section('title', 'Settings - Diet Plan System')

@section('styles')
<style>
    .settings-wrapper {
        max-width: 720px;
        margin: 0 auto;
        display: grid;
        gap: 30px;
    }

    .settings-card {
        background: var(--color-surface);
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 18px 36px rgba(79, 138, 62, 0.12);
        border: 1px solid rgba(79, 138, 62, 0.1);
        display: grid;
        gap: 20px;
    }

    .settings-card h2 {
        font-size: 20px;
        font-weight: 600;
        color: var(--color-text);
    }

    .field-grid {
        display: grid;
        gap: 18px;
    }

    label {
        font-weight: 600;
        font-size: 14px;
        color: var(--color-muted);
    }

    input,
    select,
    textarea {
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid rgba(79, 138, 62, 0.22);
        background: #fff;
        font-size: 14px;
    }

    .toggle {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .toggle input[type="checkbox"] {
        width: 18px;
        height: 18px;
    }

    .settings-actions {
        display: flex;
        gap: 16px;
        justify-content: flex-end;
    }
</style>
@endsection

@section('content')
<div class="settings-wrapper">
    <div class="settings-card">
        <h2>Profile</h2>
        <div class="field-grid">
            <div>
                <label for="settings-name">Name</label>
                <input type="text" id="settings-name" value="{{ auth()->user()->name }}">
            </div>
            <div>
                <label for="settings-email">Email</label>
                <input type="email" id="settings-email" value="{{ auth()->user()->email }}" disabled>
                <small style="color: var(--color-muted);">Email changes require contacting support.</small>
            </div>
        </div>
    </div>

    <div class="settings-card">
        <h2>Preferences</h2>
        <div class="field-grid">
            <div>
                <label for="settings-goal">Primary goal</label>
                <select id="settings-goal">
                    <option>Lose weight</option>
                    <option>Maintain weight</option>
                    <option>Gain muscle</option>
                </select>
            </div>
            <div>
                <label for="settings-diet">Diet preference</label>
                <select id="settings-diet">
                    <option>Balanced</option>
                    <option>High-protein</option>
                    <option>Vegan</option>
                    <option>Vegetarian</option>
                    <option>Keto</option>
                </select>
            </div>
            <div class="toggle">
                <input type="checkbox" id="settings-newsletter" checked>
                <label for="settings-newsletter" style="margin: 0;">Send weekly meal inspiration emails</label>
            </div>
            <div class="toggle">
                <input type="checkbox" id="settings-reminders">
                <label for="settings-reminders" style="margin: 0;">Push reminders for meal logging</label>
            </div>
        </div>
    </div>

    <div class="settings-card">
        <h2>Account security</h2>
        <div class="field-grid">
            <div>
                <label for="settings-password">New password</label>
                <input type="password" id="settings-password" placeholder="••••••••">
            </div>
            <div>
                <label for="settings-confirm">Confirm password</label>
                <input type="password" id="settings-confirm" placeholder="Confirm new password">
            </div>
        </div>
        <div class="settings-actions">
            <button class="btn btn-secondary" type="button">Cancel</button>
            <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
    </div>
</div>
@endsection
