@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-xl font-bold mb-4">Редактирование задачи</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block mb-2">Название</label>
            <input type="text" name="title" id="title" class="border w-full px-4 py-2" value="{{ $task->title }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block mb-2">Описание</label>
            <textarea name="description" id="description" class="border w-full px-4 py-2">{{ $task->description }}</textarea>
        </div>
        <div class="mb-4">
            <label for="due_date" class="block mb-2">Срок</label>
            <input type="date" name="due_date" id="due_date" class="border w-full px-4 py-2" value="{{ $task->due_date }}">
        </div>
                <div class="mb-4">
            <label for="category_id" class="block mb-2">ID категории</label>
            <input type="number" name="category_id" id="category_id" class="border w-full px-4 py-2" value="{{ $task->category_id }}" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Сохранить изменения</button>
    </form>
</div>
@endsection