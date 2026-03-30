@extends('layouts.app')
@section('title', 'Add Recipe')
@section('content')

    <h3>Add new Recipe</h3>
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf

        <p><label for="">Name</label></p>
        <input type="text" name="name" value="{{ old('name') }}">
        <p><label for="">Ingrd</label></p>
        <input type="text" name="ingredients" value="{{ old('ingredients') }}">
        <p><label for="">Instructions</label></p>
        <input type="text" name="instructions" value="{{ old('instructions') }}">
        <p><label for="">Description</label></p>
        <input type="text" name="description" value="{{ old('description') }}">
        <p><label>Category</label></p>
        <select name="category_id">
            <option value="">-- Select Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <p><label>Tags</label></p>
        @foreach ($tags as $t)
            <input type="checkbox" name="tags[]" value="{{ $t->id }}">
            {{ $t->name }}
        @endforeach
        <button type="submit"> Save</button>
        <a href="{{ route('recipes.index') }}">Cancel</a>
    </form>
@endsection