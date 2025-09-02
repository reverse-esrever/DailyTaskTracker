@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-xl font-bold mb-4">Создание задачи</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block mb-2">Название</label>
            <input type="text" name="title" id="title" class="border w-full px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block mb-2">Описание</label>
            <textarea name="description" id="description" class="border w-full px-4 py-2"></textarea>
        </div>
        <div class="mb-4">
            <label for="due_date" class="block mb-2">Срок</label>
            <input type="datetime-local" name="due_date" id="due_date" class="border w-full px-4 py-2">
        </div>
        <div class="mb-4">
            <label for="category_id" class="block mb-2">Категория</label>
            <select name="category_id" id="category_id" class="border w-full px-4 py-2" required>
                @foreach(Auth::user()->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Создать задачу</button>
    </form>
</div>
@endsection