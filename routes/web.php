<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpChatController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SettingsController;

// Public landing pages
Route::view('/', 'landing.home')->name('landing.home');
Route::view('/planner', 'landing.planner')->name('landing.planner');
Route::view('/plan-result', 'landing.result')->name('landing.result');
Route::view('/progress', 'landing.progress')->name('landing.progress');
Route::view('/tips', 'landing.tips')->name('landing.tips');
Route::view('/contact', 'landing.contact')->name('landing.contact');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('recipes', RecipeController::class);
    
    Route::resource('meal-plans', MealPlanController::class);
    
    // Tools
    Route::view('/bmi', 'tools.bmi')->name('bmi');
    Route::post('/meal-plans/{mealPlan}/add-meal', [MealPlanController::class, 'addMeal'])->name('meal-plans.add-meal');
    Route::put('/meal-plans/{mealPlan}/meal-items/{mealItem}', [MealPlanController::class, 'updateMeal'])->name('meal-plans.update-meal');
    Route::delete('/meal-plans/{mealPlan}/meal-items/{mealItem}', [MealPlanController::class, 'removeMeal'])->name('meal-plans.remove-meal');

    Route::view('/help', 'help')->name('help');
    Route::post('/help/chat', HelpChatController::class)->name('help.chat');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
});
