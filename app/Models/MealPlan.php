<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mealItems()
    {
        return $this->hasMany(MealItem::class);
    }

    public function getBreakfastItems()
    {
        return $this->mealItems()->where('meal_type', 'breakfast')->with('recipe')->get();
    }

    public function getLunchDinnerItems()
    {
        return $this->mealItems()->whereIn('meal_type', ['lunch', 'dinner'])->with('recipe')->get();
    }

    public function getSnackItems()
    {
        return $this->mealItems()->where('meal_type', 'snack')->with('recipe')->get();
    }
}
