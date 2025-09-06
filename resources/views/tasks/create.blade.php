@extends('layouts.dashboard')

@section('dashboardContent')
    <div class="container mx-auto">
        <h1 class="text-xl font-bold mb-4">Создание задачи</h1>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block mb-2">Название</label>
                <input type="text" name="name" id="title" class="border w-full px-4 py-2" value="{{ old('name') }}"
                    required>
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            @session('TaskCreated')
                <div class="text-green-500">Задача успешно создана!</div>
            @endsession
            <div class="mb-4">
                <label for="description" class="block mb-2">Описание</label>
                <textarea name="description" id="description" class="border w-full px-4 py-2">
                    {{ old('description') }}
                </textarea>
                @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="due_date" class="block mb-2">Срок</label>
                <input type="date" name="due_date" id="due_date" class="border w-full px-4 py-2"
                    value="{{ old('due_date') }}">
                @error('due_date')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="category_id" class="block mb-2">Категория</label>
                <select name="category_id" id="category_id" class="border w-full px-4 py-2" required>
                    @foreach (Auth::user()->categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Создать задачу</button>
        </form>
    </div>
@endsection
