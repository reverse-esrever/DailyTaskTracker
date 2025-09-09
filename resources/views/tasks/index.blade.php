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
            <div>

                <h1 class="text-xl font-bold mb-4">Список задач</h1>
                <div>

                    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Создать новую
                        задачу</a>
                </div>
                <form action="{{ route('tasks.index') }}" method="GET" class="rounded-lg bg-white p-6 shadow-md">
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Фильтр по категории</label>
                        <select id="category_id" name="category_id"
                            class="mt-1 block w-full rounded-md border border-gray-300 p-2">
                            <option value="">Выберите категорию</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') && old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Диапазон даты</label>
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Начало</label>
                                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                                    class="mt-1 block w-full rounded-md border border-gray-300 p-2" />
                                @error('start_date')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="flex-1">
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Конец</label>
                                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                                    class="mt-1 block w-full rounded-md border border-gray-300 p-2" />
                                @error('end_date')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <legend class="block text-sm font-medium text-gray-700">По статусу</legend>
                        <div class="mt-2">
                            <label class="ml-6 inline-flex items-center">
                                <input type="radio" name="status" value="any" class="mr-2"
                                    {{ old('status') && old('status') == 'any' ? 'checked' : '' }} />
                                <span>Любой</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="completed" class="mr-2"
                                    {{ old('status') && old('status') == 'completed' ? 'checked' : '' }} />
                                <span>Выполнено</span>
                            </label>
                            <label class="ml-6 inline-flex items-center">
                                <input type="radio" name="status" value="not_completed" class="mr-2"
                                    {{ old('status') && old('status') == 'not_completed' ? 'checked' : '' }} />
                                <span>Не выполнено</span>
                            </label>
                        </div>
                        @error('status')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="checkbox" name="upcoming" value="true" class="size-5" {{request()->input('upcoming') ? "checked" : ""}}/>
                        <label for="checkbox" class="flex cursor-pointer items-center">
                          <span class="text-gray-700">Показать только задачи на сегодня</span>
                        </label>
                      </div>
                      
                    <button type="submit"
                        class="mt-4 rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-500">Применить фильтр</button>
                </form>
            </div>
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
                        <th class="border px-4 py-2">Категория</th>
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
                            <td class="border px-4 py-2">{{ $task->category->name }}</td>
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