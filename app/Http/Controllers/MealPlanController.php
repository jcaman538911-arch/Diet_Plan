<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\Recipe;
use App\Models\MealItem;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function index()
    {
        $mealPlans = MealPlan::where('user_id', auth()->id())
            ->with('mealItems.recipe')
            ->latest()
            ->get();
        
        return view('meal-plans.index', compact('mealPlans'));
    }

    public function create()
    {
        $recipes = Recipe::where('user_id', auth()->id())->get();
        return view('meal-plans.create', compact('recipes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $mealPlan = MealPlan::create($validated);

        return redirect()->route('meal-plans.show', $mealPlan)->with('success', 'Meal plan created successfully!');
    }

    public function show(MealPlan $mealPlan)
    {
        if ($mealPlan->user_id !== auth()->id()) {
            abort(403);
        }
        
        $mealPlan->load('mealItems.recipe');
        $recipes = Recipe::where('user_id', auth()->id())->get();
        
        return view('meal-plans.show', compact('mealPlan', 'recipes'));
    }

    public function edit(MealPlan $mealPlan)
    {
        if ($mealPlan->user_id !== auth()->id()) {
            abort(403);
        }
        return view('meal-plans.edit', compact('mealPlan'));
    }

    public function update(Request $request, MealPlan $mealPlan)
    {
        if ($mealPlan->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $mealPlan->update($validated);

        return redirect()->route('meal-plans.show', $mealPlan)->with('success', 'Meal plan updated successfully!');
    }

    public function destroy(MealPlan $mealPlan)
    {
        if ($mealPlan->user_id !== auth()->id()) {
            abort(403);
        }
        $mealPlan->delete();

        return redirect()->route('meal-plans.index')->with('success', 'Meal plan deleted successfully!');
    }

    public function addMeal(Request $request, MealPlan $mealPlan)
    {
        if ($mealPlan->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
            'servings' => 'required|integer|min:1'
        ]);

        $validated['meal_plan_id'] = $mealPlan->id;
        MealItem::create($validated);

        return back()->with('success', 'Meal added to plan!');
    }

    public function removeMeal(MealPlan $mealPlan, MealItem $mealItem)
    {
        if ($mealPlan->user_id !== auth()->id()) {
            abort(403);
        }
        
        if ($mealItem->meal_plan_id !== $mealPlan->id) {
            abort(403);
        }

        $mealItem->delete();

        return back()->with('success', 'Meal removed from plan!');
    }
}
