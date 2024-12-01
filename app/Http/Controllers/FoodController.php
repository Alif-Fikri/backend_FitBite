<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;


class FoodController extends Controller
{
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image_url' => 'nullable|url',
        'total_calorie' => 'nullable|numeric',
        'carbs' => 'nullable|numeric',
        'protein' => 'nullable|numeric',
        'fats' => 'nullable|numeric',
        'sugar' => 'nullable|numeric',
    ]);

    // Simpan data makanan
    $foodItem = FoodItem::create($request->all());

    return response()->json($foodItem, 201);
}
public function update(Request $request, $id)
{
    // Temukan data makanan berdasarkan ID
    $foodItem = FoodItem::findOrFail($id);

    // Validasi input
    $request->validate([
        'name' => 'sometimes|string|max:255',
        'description' => 'nullable|string',
        'price' => 'sometimes|numeric',
        'image_url' => 'nullable|url',
        'total_calorie' => 'nullable|numeric',
        'carbs' => 'nullable|numeric',
        'protein' => 'nullable|numeric',
        'fats' => 'nullable|numeric',
        'sugar' => 'nullable|numeric',
    ]);

    // Perbarui data makanan
    $foodItem->update($request->all());

    return response()->json($foodItem);
}
public function index()
{
    return response()->json(FoodItem::all());
}
public function show($id)
{
    $foodItem = FoodItem::findOrFail($id);
    return response()->json($foodItem);
}
public function destroy($id)
{
    $foodItem = FoodItem::findOrFail($id);
    $foodItem->delete();

    return response()->json(['message' => 'Deleted successfully']);
}

}
