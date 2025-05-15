<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        return response()->json(Foods::all());
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'price' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imagePath = $request->file('image')->store('foods', 'public');

            $food = Foods::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $imagePath,
            ]);

            return response()->json(['message' => 'Food created', 'data' => $food], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating food',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
