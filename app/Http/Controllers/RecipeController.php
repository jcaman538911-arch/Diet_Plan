<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::where('user_id', auth()->id())
            ->latest()
            ->get();
        
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'servings' => 'required|integer|min:1',
            'prep_time' => 'nullable|integer',
            'cook_time' => 'nullable|integer',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'calories' => 'nullable|integer',
            'category' => 'required|in:breakfast,lunch,dinner,snack'
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        Recipe::create($validated);

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
    }

    public function show(Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->id()) {
            abort(403);
        }

        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->id()) {
            abort(403);
        }
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'servings' => 'required|integer|min:1',
            'prep_time' => 'nullable|integer',
            'cook_time' => 'nullable|integer',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'calories' => 'nullable|integer',
            'category' => 'required|in:breakfast,lunch,dinner,snack'
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image && !Str::startsWith($recipe->image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($recipe->image);
            }
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($validated);

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully!');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->id()) {
            abort(403);
        }
        
        if ($recipe->image && !Str::startsWith($recipe->image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($recipe->image);
        }

        if ($recipe->mealItems()->exists()) {
            $recipe->mealItems()->delete();
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }
}
