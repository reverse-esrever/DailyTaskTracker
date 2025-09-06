@extends('layouts.dashboard')

@section('dashboardContent')
    <div class="container mx-auto">
        @session('TaskUpdated')
            <div class="text-green-500">Задача успешно обновлена!</div>
        @endsession
        <h1 class="text-xl font-bold mb-4">Редактирование задачи</h1>
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label for="name" class="block mb-2">Название</label>
                <input type="text" name="name" id="name" class="border w-full px-4 py-2"
                    value="{{ old('name') ? old('name') : $task->name }}" required>
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block mb-2">Описание</label>
                <textarea name="description" id="description" class="border w-full px-4 py-2">{{ old('description') ? old('description') : $task->description }}</textarea>
                @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="due_date" class="block mb-2">Срок</label>
                <input type="date" name="due_date" id="due_date" class="border w-full px-4 py-2"
                    value="{{ old('due_date') ? old('due_date') : $task->due_date }}">
                @error('due_date')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <div class="mb-4">
                    <label for="category_id" class="block mb-2">Категория</label>
                    <select name="category_id" id="category_id" class="border w-full px-4 py-2" required>
                        @foreach (Auth::user()->categories as $category)
                            <option value="{{ $category->id }}"
                                @if (!is_null(old('category_id'))) 
                                {{ old('category_id') == $category->id ? 'selected' : '' }}    
                                @else
                                    {{ $category->id == $task->category->id ? "selected" : ""}} 
                                @endif>
                                {{ $category->name }}</option>
                        @endforeach
                        @error('category_id')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Сохранить изменения</button>
        </form>
    </div>
@endsection
