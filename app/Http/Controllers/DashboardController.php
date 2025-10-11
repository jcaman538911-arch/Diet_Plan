<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\MealPlan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recipesCount = Recipe::where('user_id', $user->id)->count();
        $mealPlansCount = MealPlan::where('user_id', $user->id)->count();
        $recentRecipes = Recipe::where('user_id', $user->id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('dashboard', compact('recipesCount', 'mealPlansCount', 'recentRecipes'));
    }
}
