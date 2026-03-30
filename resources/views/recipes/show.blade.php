@extends('layouts.app')
@section('title', $recipe->name)
@section('content')

    <h3>{{ $recipe->name }}</h3>
    <p><strong>Description: </strong> <br>
        {{ $recipe->description }}</p>
    <p>
        <span>Category:</span>
        <span>{{ $recipe->category->name }}</span>
    </p>

    <p>
        <span>Tags:</span>
        @foreach ($recipe->tags as $t)
            <span>{{$t->name}}</span>
        @endforeach
    </p>

    <a href="{{ route('recipes.edit', $recipe)}}">Edit</a> |
    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Delete this recipe?')">Delete</button>
    </form>
@endsection