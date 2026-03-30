<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Tag;
class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $recipes = Recipe::with(['category', 'tags'])->get();
        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('recipes.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'ingredients' => ['required', 'string'],
            'instructions' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['nullable', 'array'],
        ]);
        $recipe = Recipe::create($data);
        $recipe->tags()->attach($request->tags);
        return redirect()->route('recipes.index')->with('success', "Recipe created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
        return view('recipes.show', compact('recipe'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('recipes.edit', compact('recipe','categories','tags'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'ingredients' => ['required', 'string'],
            'instructions' => ['required', 'string'],
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);
        $recipe->update($data);
        $recipe->tags()->sync($request->tags ?? []);
        return redirect()->route('recipes.show', $recipe)->with('success', "Recipe Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', "Recipe deleted");

    }
}
