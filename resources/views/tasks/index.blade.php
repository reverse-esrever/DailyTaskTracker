@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-xl font-bold mb-4">Список задач</h1>
    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Создать новую задачу</a>
    <table class="min-w-full mt-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Название</th>
                <th class="border px-4 py-2">Описание</th>
                <th class="border px-4 py-2">Срок</th>
                <th class="border px-4 py-2">Статус</th>
                <th class="border px-4 py-2">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td class="border px-4 py-2">{{ $task->id }}</td>
                <td class="border px-4 py-2">{{ $task->title }}</td>
                <td class="border px-4 py-2">{{ $task->description }}</td>
                <td class="border px-4 py-2">{{ $task->due_date }}</td>
                <td class="border px-4 py-2">{{ $task->completed_at ? 'Выполнена' : 'Не выполнена' }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500">Редактировать</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection