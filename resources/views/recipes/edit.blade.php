@extends('layouts.app')
@section("title", 'Edit Recipe')
@section('content')

    <h3>Edit Recipe</h3>
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ route('recipes.update', $recipe) }}" method="POST">
        @csrf
        @method('PUT')
        <p><label for="">Name</label></p>
        <input type="text" name="name" value="{{ old('name', $recipe->name) }}">
        <p><label for="">Ingrd</label></p>
        <input type="text" name="ingredients" value="{{ old('ingredients', $recipe->ingredients) }}">
        <p><label for="">Instructions</label></p>
        <input type="text" name="instructions" value="{{ old('instructions', $recipe->instructions) }}">
        <p><label for="">Description</label></p>
        <input type="text" name="description" value="{{ old('description', $recipe->description) }}">
        <p><label>Category</label></p>
        <select name="category_id">
            <option value="">-- Select Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <p><label>Tags</label></p>
        @foreach ($tags as $t)
            <input type="checkbox" name="tags[]" value="{{ $t->id }}" {{ 
                            in_array(
                    $t->id,
                    old('tags', $recipe->tags->pluck('id')->toArray())

                ) ? 'checked' : ''}}>
            {{ $t->name }}
        @endforeach
        <button type="submit"> Update</button>
        <a href="{{ route('recipes.show', $recipe) }}">Cancel</a>
    </form>
@endsection