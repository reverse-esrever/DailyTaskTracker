@extends('layouts.dashboard')

@section('dashboardContent')
    <main class="flex-grow p-5 bg-gray-100">
        <h1 class="text-3xl font-bold mb-6">Задачи</h1>

        <div class="grid grid-cols-4 gap-4">
            <div class="bg-green-500 text-white p-5 rounded-lg">
                <h2 class="text-xl">Выполненные задачи</h2>
                <p>{{ $info['completed'] }}</p>
            </div>
            <div class="bg-red-500 text-white p-5 rounded-lg">
                <h2 class="text-xl">Просроченные задачи</h2>
                <p>{{ $info['overdue'] }}</p>
            </div>
            <div class="bg-blue-500 text-white p-5 rounded-lg">
                <h2 class="text-xl">Задачи на сегодня</h2>
                <p>{{ $info['upcoming'] }}</p>
            </div>
            <div class="bg-yellow-500 text-white p-5 rounded-lg">
                <h2 class="text-xl">Все задачи</h2>
                <p>{{ $info['all'] }}</p>
            </div>
        </div>
        <div class="container mx-auto">
            <h1 class="text-xl font-bold mb-4">Список задач</h1>
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Создать новую задачу</a>
            @if (Route::current()->uri() === "tasks")
                <a href="{{ route('tasks.index.upcoming') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Показать
                    только задачи на сегодня</a>
            @else
                <a href="{{ route('tasks.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Показать
                    все задачи</a>
            @endif
            @session('TaskDeleted')
                <div class="text-green-500">Задача успешно удалена!</div>
            @endsession
            @session('TaskStatusChanged')
                <div class="text-green-500">Изменен статус задачи!</div>
            @endsession
            <table class="min-w-full mt-4 h-full">
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
                            <td class="border px-4 py-2">
                                {{ $task->completed_at ? "Выполнена $task->completed_at" : 'Не выполнена' }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('tasks.changeComplition', $task->id) }}" method="post">
                                    @csrf
                                    @if (is_null($task->completed_at))
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Отметить как
                                            "выполнено"</button>
                                    @else
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Отметить как
                                            "не
                                            выполнено"</button>
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
    </main>

@endsection
