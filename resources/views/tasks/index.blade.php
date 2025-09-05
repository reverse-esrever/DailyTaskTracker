@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-xl font-bold mb-4">Список задач</h1>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Создать новую задачу</a>
        @session('TaskDeleted')
            <div class="text-green-500">Задача успешно удалена!</div>
        @endsession
        @session('TaskStatusChanged')
            <div class="text-green-500">Изменен статус задачи!</div>
        @endsession
        <table class="min-w-full mt-4">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Название</th>
                    <th class="border px-4 py-2">Описание</th>
                    {{-- <th class="border px-4 py-2">Категория</th> --}}
                    <th class="border px-4 py-2">Срок</th>
                    <th class="border px-4 py-2">Статус</th>
                    <th class="border px-4 py-2">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="border px-4 py-2">{{ $task->id }}</td>
                        <td class="border px-4 py-2">{{ $task->name }}</td>
                        <td class="border px-4 py-2">{{ $task->description }}</td>
                        {{-- <td class="border px-4 py-2">{{ $task }}</td> --}}
                        <td class="border px-4 py-2">{{ $task->due_date }}</td>
                        <td class="border px-4 py-2">{{ $task->completed_at ? "Выполнена $task->completed_at" : 'Не выполнена' }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('tasks.changeComplition', $task->id) }}" method="post">
                                @csrf
                                @if (is_null($task->completed_at))
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Отметить как "выполнено"</button>
                                @else
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Отметить как "не выполнено"</button>
                                @endif
                            </form>
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
